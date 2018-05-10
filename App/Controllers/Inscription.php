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
}

?>
