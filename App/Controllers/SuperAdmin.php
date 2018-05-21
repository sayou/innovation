<?php

namespace App\Controllers;
use \Core\View;
use App\Models\SuperAdminModel;

class SuperAdmin extends \Core\Controller{
	
	protected function before(){
        //echo "(Before)";
    }
	
	protected function after(){
		
	}
    

	protected function getStatistiques(){
		try {
			$statistiques['nbrProjets'] = SuperAdminModel::getProjectNumber();
			$statistiques['nbrCoaches'] = SuperAdminModel::getCoachesNumber();
			$statistiques['nbrJurys'] = SuperAdminModel::getJurysNumber();
			$statistiques['nbrSuperAdmins'] = SuperAdminModel::getSuperAdminsNumber();
			return $statistiques;    		
		}catch(PDOException $e){echo $e->getMessage(); return null;}
	}


	protected function indexAction(){
		View::getView('SuperAdmin/index.html', ['statistiques' => $this->getStatistiques()]);
	}


	protected function listDesProjetsAction(){
		$listProjets = SuperAdminModel::getListOfProjects();
		View::getView('SuperAdmin/listDesProjets.html', ['statistiques' => $this->getStatistiques(), 'listProjets' => $listProjets]);
	}

	protected function detailsAction(){
		if (isset($_GET['id']) && !empty($_GET['id'])){
			$projetInfos = SuperAdminModel::getFullProjectInfos($_GET['id']);
			$leadInfos = SuperAdminModel::getLeadInfos($projetInfos[0]['idLead']);
			$membresInfos = SuperAdminModel::getMembresInfos($_GET['id']);


			View::getView('SuperAdmin/details.html', ['statistiques' => $this->getStatistiques(), 'projetInfos' => $projetInfos, 'leadInfos' => $leadInfos, 'membresInfos' =>$membresInfos]);
		}
		else{
			$listProjets = SuperAdminModel::getListOfProjects();
			View::getView('SuperAdmin/listDesProjets.html', ['statistiques' => $this->getStatistiques(), 'listProjets' => $listProjets]);
		}

	}
	
}

?>
