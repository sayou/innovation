<?php

namespace App\Controllers;
use \Core\View;
use App\Models\InscriptionModel;
use App\Models\ProjectPDF;
session_start();

class Inscription extends \Core\Controller{
	
	protected function before(){
        //echo "(Before)";
    }
	
	protected function after(){
		
	}
    

	protected function indexAction(){
		if(isset($_SESSION['id'])){
			$data = self::findProject($_SESSION['id']);
					View::getView('Home/editInscription.html', [
					"lead" => $data["lead"],
					 "projet" => $data["projet"],
				  "membres" => $data["membres"]
			 		]);
		}else{
			View::getView('Home/index.html');
		}
    }
	

    protected function addNewAction(){
		if(isset($_SESSION['id'])){
			$data = self::findProject($_SESSION['id']);
					View::getView('Home/editInscription.html', [
					"lead" => $data["lead"],
					 "projet" => $data["projet"],
				  "membres" => $data["membres"]
			 		]);
		}
    	else if(isset($_POST['process'])){
	    	try {
	    		$idLead = InscriptionModel::addLeadInfos($_POST);
				$idProjet = InscriptionModel::addProjetInfos($_POST, $idLead);
				InscriptionModel::addMembresInfos($_POST, $idProjet);
				InscriptionModel::addUserInfos($_POST, 'lead');
				$test = 'true';
	    	} catch (Exception $e) {
	    		$test = 'false';
			}  
			View::getView('Home/index.html', ["test" => $test]);
	    }  
	    else{
	    	$test = null;	
			View::getView('Home/index.html', ["test" => $test]);
		}   		
	}
	
	//modification d'inscription
	protected function editAction(){
		if(isset($_SESSION['id'])){
			$data = self::findProject($_SESSION['id']);
					View::getView('Home/editInscription.html', [
					"lead" => $data["lead"],
					 "projet" => $data["projet"],
				  "membres" => $data["membres"]
			 		]);
		}
		else if(isset($_POST['process']) && !isset($_SESSION['id'])){
			try{
				//l'id est recuperé a l'aide d'une session apres auth normalement
				$email = filter_input(INPUT_POST,"email");
				$password = filter_input(INPUT_POST,"password");
				$role = "lead";
				$result = InscriptionModel::getByEmailAndPassword($email,$password,$role);
				if($result){
					$id = $result[0]["id"];
					$_SESSION['id']=$id;
					$data = self::findProject($_SESSION['id']);
					View::getView('Home/editInscription.html', [
					"lead" => $data["lead"],
					 "projet" => $data["projet"],
				  "membres" => $data["membres"]
			 		]);
				}else{
					View::getView('Home/index.html', [
						"test" => "error"
						 ]);
				}
				
			}catch(Exception $e){
			}
		}
		else{
			View::getView('Home/index.html');
		}
		
		
	}

	protected function saveChangesAction(){
		if(isset($_SESSION['id'])){
		$test = 'false';
		if(isset($_POST["process"])){
			try{
				//l'id est recuperé a l'aide d'une session apres auth normalement
				$data = self::findProject($_SESSION['id']);
				extract($data);

				$editedLead = InscriptionModel::editLeadInfos($_POST, $lead["id"]);
				$editedProjet = InscriptionModel::editProjetInfos($_POST, $projet["id"], $lead["id"]);
				$editedMembres = InscriptionModel::editMembresInfos($_POST, $projet["id"]);
				$test = 'true';
				
			}catch(Exception $e){
				$test = null;
			}
		}
		$data = self::findProject($_SESSION['id']);
		View::getView('Home/editInscription.html', [
			"lead" => $data["lead"],
		 	"projet" => $data["projet"],
			"membres" => $data["membres"],
			"test" => $test
		]);
	}else{
		View::getView('Home/index.html');
	}
	}

	protected function findProject($idLead){
		try{
			//recuperé a l'aide d'une session apres auth
			$lead = InscriptionModel::findLeadById($idLead);
			$projet = InscriptionModel::findProjectByLead($lead["id"]);
			$membres = InscriptionModel::findMembresByProject($projet["id"]);

			return ["lead" => $lead, "projet" => $projet, "membres" => $membres];

		}catch(Exception $e){
			return null;
		}
		
	}
	// fin modification d'inscription

	// impression pdf
	protected function printPDFAction(){
		if(!isset($_SESSION['id'])){
			View::getView('Home/index.html');
		}
		else{
			$pdf = new ProjectPDF();
			$titre = 'Projet Innovation Sociale';
			$pdf->SetTitle($titre);
			$pdf->SetAuthor('Hackathon - Innovation Sociale');

			//getting data
			$data = self::findProject($_SESSION['id']);

			unset($data["lead"]["id"], $data["projet"]["id"], $data["projet"]["idLead"]);
			$membres = $data["membres"];
			foreach($membres as $key => $value){
				unset($membres[$key]["id"], $membres[$key]["idProjet"]);
			}

			$pdf->AjouterSection($data["projet"]["idee"], $data["lead"], $membres);
			// $pdf->AjouterSection(2, 'Leader', $data["lead"]);
			// $pdf->AjouterSection(3, 'Membres', $membres);
			$pdf->Output();
		}
	}
	// fin impression pdf

	// etat d'avancement
	protected function progressAction(){
		if(isset($_SESSION['id'])){
			if(isset($_POST["submit"])){
				try{
					$progress = InscriptionModel::addProgress($_SESSION['id'], $_POST);
					$testProgress = 'true';
				}catch(Exception $e){
					$testProgress = 'false';
				}
			}else $testProgress = 'false';

			$data = self::findProject($_SESSION['id']);
			View::getView('Home/editInscription.html', [
				"lead" => $data["lead"],
				"projet" => $data["projet"],
				"membres" => $data["membres"],
				"testProgress" => $testProgress
			]);
		}else{
			View::getView('Home/index.html');
		}
	}

	protected function verifyEmailAction(){
		if(isset($_POST["email"])){
			$email = $_POST["email"];
			$result = InscriptionModel::findLeadByEmail($email);
			if($result == 0){
				echo "yes";
			}else{echo "no";}
		}else{
			$this->indexAction();
		}
	}

	protected function logoutAction(){
		if(isset($_SESSION['id'])){
			unset($_SESSION['id']);
			session_destroy();
			View::getView('Home/index.html');
		}else{
			View::getView('Home/index.html');
		}
	}
	// fin etat d'avancement
}

?>
