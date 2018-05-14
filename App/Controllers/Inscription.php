<?php

namespace App\Controllers;
use \Core\View;
use App\Models\InscriptionModel;
use App\Models\ProjectPDF;

class Inscription extends \Core\Controller{
	
	protected function before(){
        //echo "(Before)";
    }
    
    protected function after(){

		if(isset($_SESSION['id'])){
			editAction($_SESSION['id']);
			exit();
		}
    }

    protected function addNewAction(){
		$this->after();
    	if(isset($_POST['process'])){
	    	try {
	    		$idLead = InscriptionModel::addLeadInfos($_POST);
				$idProjet = InscriptionModel::addProjetInfos($_POST, $idLead);
				InscriptionModel::addMembresInfos($_POST, $idProjet);
				InscriptionModel::addUserInfos($_POST, 'lead');
				$test = 'true';
	    	} catch (Exception $e) {
	    		$test = 'false';
	    	}  
	    }  
	    else
	    	$test = null;

        View::getView('Home/index.html', ["test" => $test]);   		
	}
	
	//modification d'inscription
	protected function editAction($id = 0){
		if(isset($_POST['process']) && $id == 0){
			try{
				//l'id est recuperé a l'aide d'une session apres auth normalement
				$email = filter_input(INPUT_POST,"email");
				$password = filter_input(INPUT_POST,"password");
				$role = "user";
				$result = InscriptionModel::getByEmailAndPassword($email,"123",$role);
				if($result){
					//echo $result[0];
					$id = $result[0]["id"];
					session_start();
					$_SESSION['id']=$id;
					$data = self::findProject($id);
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
		}else if($id != 0){
			$data = self::findProject($id);
					View::getView('Home/editInscription.html', [
					"lead" => $data["lead"],
					 "projet" => $data["projet"],
				  "membres" => $data["membres"]
			 		]);
		}
		else{
			$this->after();
			View::getView('Home/index.html');
		}
		
		
		/**/
	}

	protected function saveChangesAction(){
		$test = 'false';
		if(isset($_POST["process"])){
			try{
				//l'id est recuperé a l'aide d'une session apres auth normalement
				$data = self::findProject(5);
				extract($data);

				$editedLead = InscriptionModel::editLeadInfos($_POST, $lead["id"]);
				$editedProjet = InscriptionModel::editProjetInfos($_POST, $projet["id"], $lead["id"]);
				$editedMembres = InscriptionModel::editMembresInfos($_POST, $projet["id"]);
				$test = 'true';
				
			}catch(Exception $e){
				$test = null;
			}
		}
		$data = self::findProject(5);
		View::getView('Home/editInscription.html', [
			"lead" => $data["lead"],
		 	"projet" => $data["projet"],
			"membres" => $data["membres"],
			"test" => $test
		]);
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
		$pdf = new ProjectPDF();
		$titre = 'Projet Innovation Sociale';
		$pdf->SetTitle($titre);
		$pdf->SetAuthor('Hackathon - Innovation Sociale');

		//getting data
		$data = self::findProject(5);

		unset($data["lead"]["id"], $data["projet"]["id"], $data["projet"]["idLead"]);
		$membres = $data["membres"];
		foreach($membres as $key => $value){
			unset($membres[$key]["id"], $membres[$key]["idProjet"]);
		}

		$pdf->AjouterSection(1, 'Projet', $data["projet"]);
		$pdf->AjouterSection(2, 'Leader', $data["lead"]);
		$pdf->AjouterSection(3, 'Membres', $membres);
		$pdf->Output();
	}
	// fin impression pdf

	// etat d'avancement
	protected function progressAction(){
		if(isset($_POST["etat"])){
			try{
				$progress = InscriptionModel::addProgress(5, $_POST["etat"]);
				$testProgress = 'true';
			}catch(Exception $e){
				$testProgress = 'false';
			}
		}else $testProgress = 'false';

		$data = self::findProject(5);
		View::getView('Home/editInscription.html', [
			"lead" => $data["lead"],
		 	"projet" => $data["projet"],
			"membres" => $data["membres"],
			"testProgress" => $testProgress
		]);
	}
	// fin etat d'avancement
}

?>
