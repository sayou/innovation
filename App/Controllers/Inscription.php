<?php

namespace App\Controllers;
use \Core\View;
use App\Models\InscriptionModel;

class Inscription extends \Core\Controller{
    

    public function addNewAction(){

    	if(isset($_POST['process'])){
	    	try {
	    		$idLead = InscriptionModel::addLeadInfos($_POST);
				$idProjet = InscriptionModel::addProjetInfos($_POST, $idLead);
				InscriptionModel::addMembresInfos($_POST, $idProjet);
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
	public function editAction(){
		try{
			//l'id est recuperé a l'aide d'une session apres auth normalement
			$data = self::findProject(3);

		}catch(Exception $e){

		}
		View::getView('Home/editInscription.html', [
			"lead" => $data["lead"],
		 	"projet" => $data["projet"],
		 	"membres" => $data["membres"]
		]);
	}

	public function saveChangesAction(){
		try{
			//l'id est recuperé a l'aide d'une session apres auth normalement
			$data = self::findProject(3);
			extract($data);

			$editedLead = InscriptionModel::editLeadInfos($_POST, $lead["id"]);
			$editedProjet = InscriptionModel::editProjetInfos($_POST, $projet["id"], $lead["id"]);
			$editedMembres = InscriptionModel::editMembresInfos($_POST, $projet["id"]);
			$test = 'true';
			$data = self::findProject(3);
		}catch(Exception $e){
			$test = null;
		}
		View::getView('Home/editInscription.html', [
			"lead" => $data["lead"],
		 	"projet" => $data["projet"],
			"membres" => $data["membres"],
			"test" => $test
		]);
	}

	public function findProject($idLead){
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
}

?>
