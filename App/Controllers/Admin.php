<?php

namespace App\Controllers;
use \Core\View;
use App\Models\SuperAdminModel;
use App\Models\Projet;
use App\Models\Coachs;

session_start();
class Admin extends \Core\Controller{
	
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
		if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'admin') == 0){
				$datasAdmin = SuperAdminModel::getAdminByID($_SESSION['id']);
				View::getView('SuperAdmin/index.html', [
					'statistiques' => $this->getStatistiques(),
					"datasAdmin"=>$datasAdmin]);
				}else{
					header('Location: https://aracpi.com/innovation/'.$_SESSION['role'].'/index', true, 303);
					exit;
				}
		}else{
			header('Location: https://aracpi.com/innovation/login', true, 303);
			exit;
		}
	}


	protected function listDesProjetsAction(){
		if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'admin') == 0){
				$result = null;
		$listProjets = SuperAdminModel::getListOfProjects();
		$listProjetsSelected = SuperAdminModel::getListOfProjectsSelected();
		$datasAdmin = SuperAdminModel::getAdminByID($_SESSION['id']);
		View::getView('SuperAdmin/listDesProjets.html', [
			'statistiques' => $this->getStatistiques(),
			 'listProjets' => $listProjets,
			 'listProjetsSelected'=>$listProjetsSelected,
			 "datasAdmin"=>$datasAdmin,
			 'result'=>$result]);
			}else{
				header('Location: https://aracpi.com/innovation/'.$_SESSION['role'].'/index', true, 303);
				exit;
			}
	}else{
		header('Location: https://aracpi.com/innovation/login', true, 303);
		exit;
	}
	}

	protected function detailsAction(){
		if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'admin') == 0){
		$datasAdmin = SuperAdminModel::getAdminByID($_SESSION['id']);
		$id = isset($this->route_params['id']) ? $this->route_params['id'] : null;
		$etat = null;
		if (!is_null($id)){
			if(isset($_POST['coachName'])){
				$idcoach = $_POST['coachName'];
				$resultat = Projet::addingCoachToProject($id,$idcoach);
				if($resultat > 0){
					$etat = 'true';
				}else{$etat = 'false';}
			}
			$projetInfos = SuperAdminModel::getFullProjectInfos($id);			
			$membresInfos = SuperAdminModel::getMembresInfos($id);
			$leadInfos = array('testKey' => 'testValue' );
			$dataCoach = SuperAdminModel::getListofCoach($id);
			$countDataCoach = count($dataCoach);
			$coachs = Projet::getAllCoachs();
			if(isset($projetInfos[0]))
				$leadInfos = SuperAdminModel::getLeadInfos($projetInfos[0]['idLead']);

			View::getView('SuperAdmin/details.html', [
				'statistiques' => $this->getStatistiques(),
				'projetInfos' => $projetInfos,
				'leadInfos' => $leadInfos,
				'membresInfos' =>$membresInfos,
				"datasAdmin"=>$datasAdmin,
				"datasCoach"=>$dataCoach,
				"countCaoch"=>$countDataCoach,
				"coachs"=>$coachs,
				"id"=>$id,
				"etat"=>$etat]);
		}
		else{
			header('Location: https://aracpi.com/innovation/admin/listDesProjets', true, 303);
			exit;
		}
	}else{
		header('Location: https://aracpi.com/innovation/'.$_SESSION['role'].'/index', true, 303);
		exit;
	}
}else{
header('Location: https://aracpi.com/innovation/login', true, 303);
exit;
}

	}
	
	protected function coachJuryAction(){	
		if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'admin') == 0){
				if(isset($_POST['id'])){
					$id = (int)$_POST['id'];
					$datas = SuperAdminModel::getListofProjectsByCoach($id);
					$name = Coachs::getCoachById($id);
					if(sizeof($datas)>0){
						echo '<div class="alert alert-success alert-dismissible fade in" role="alert" style="text-align: center;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button> <b>La liste des projets est : '.$name['userName'].'</b><br>';
						foreach($datas as $key => $data){
							echo $data['idee'].' ('.$data['nomPrenom'].') <br> ';
						}
					 	echo '</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissible fade in" role="alert" style="text-align: center;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
						</button> Le coach <b>'.$name['userName'].'</b> ne suit aucun projet pour le moment </div>';
					}
				}else{
				$datasAdmin = SuperAdminModel::getAdminByID($_SESSION['id']);	
				$listCoachJury = SuperAdminModel::getCoachesJurys();
				View::getView('SuperAdmin/coachJury.html', [
					'statistiques' => $this->getStatistiques(),
					'listCoachJury' => $listCoachJury,
					"datasAdmin"=>$datasAdmin
					]);
				}
			}else{
				header('Location: https://aracpi.com/innovation/'.$_SESSION['role'].'/index', true, 303);
				exit;
			}
		}else{
			header('Location: https://aracpi.com/innovation/login', true, 303);
			exit;
		}
	}

	protected function addCoachJuryAction(){
		if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'admin') == 0){
		$etat = '';
		$datasAdmin = SuperAdminModel::getAdminByID($_SESSION['id']);
		if(isset($_POST['username'])){
			$etat = SuperAdminModel::addCoachesJurys($_POST);
		}				
		$listCoachJury = SuperAdminModel::getCoachesJurys();
		View::getView('SuperAdmin/coachJury.html', ['statistiques' => $this->getStatistiques(), 'listCoachJury' => $listCoachJury, 'etat'=> $etat,"datasAdmin"=>$datasAdmin]);
	}else{
		header('Location: https://aracpi.com/innovation/'.$_SESSION['role'].'/index', true, 303);
		exit;
	}
}else{
header('Location: https://aracpi.com/innovation/login', true, 303);
exit;
}

	}

	protected function selectedAction(){
		if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'admin') == 0){
				$id = isset($this->route_params['id']) ? $this->route_params['id'] : null;
				$result = null;
				if(!is_null($id)){
					$datas = SuperAdminModel::editProjetSelected($id);
					if($datas > 0){
						$result = 'yes';
					}else{
						$result = 'no';
					}
				}else{
					$result = 'no';
				}
				$listProjets = SuperAdminModel::getListOfProjects();
				$listProjetsSelected = SuperAdminModel::getListOfProjectsSelected();
				$datasAdmin = SuperAdminModel::getAdminByID($_SESSION['id']);
				View::getView('SuperAdmin/listDesProjets.html', [
					'statistiques' => $this->getStatistiques(),
					'listProjets' => $listProjets,
					'listProjetsSelected'=>$listProjetsSelected,
					"datasAdmin"=>$datasAdmin,
					'result'=>$result]);
			}else{
				header('Location: https://aracpi.com/innovation/'.$_SESSION['role'].'/index', true, 303);
				exit;
			}
		}else{
		header('Location: https://aracpi.com/innovation/login', true, 303);
		exit;
		}
	}

	protected function deleteCoachJuryAction(){
		if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'admin') == 0){
		$etatDelete = '';
		$datasAdmin = SuperAdminModel::getAdminByID($_SESSION['id']);
		if(isset($_GET['idUser'])){
			$etatDelete = SuperAdminModel::DeleteCoachesJurys($_GET['idUser']);
		}				
		$listCoachJury = SuperAdminModel::getCoachesJurys();
		View::getView('SuperAdmin/coachJury.html', ['statistiques' => $this->getStatistiques(), 'listCoachJury' => $listCoachJury, 'etatDelete'=> $etatDelete,"datasAdmin"=>$datasAdmin]);
	}else{
		header('Location: https://aracpi.com/innovation/'.$_SESSION['role'].'/index', true, 303);
		exit;
	}
}else{
header('Location: https://aracpi.com/innovation/login', true, 303);
exit;
}

	}

	protected function winnerAction(){
		if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'admin') == 0){
				$etat = null;
				if(isset($_POST['third'])){
					$id = (int)$_POST['third'];
					if(SuperAdminModel::editProjet3($id) > 0){$etat = 'true';}
					else{$etat = 'false';}
				}

				if(isset($_POST['second'])){
					$id = (int)$_POST['second'];
					if(SuperAdminModel::editProjet2($id) > 0){$etat = 'true';}
					else{$etat = 'false';}
				}

				if(isset($_POST['winner'])){
					$id = (int)$_POST['winner'];
					if(SuperAdminModel::editProjet1($id) > 0){$etat = 'true';}
					else{$etat = 'false';}
				}
				$listProjetsSelected = SuperAdminModel::getListOfProjectsSelected();
				View::getView('SuperAdmin/winners.html',[
					'statistiques' => $this->getStatistiques(),
					'listprojet'=>$listProjetsSelected,
					'etat'=>$etat
				]);
			}else{
				header('Location: https://aracpi.com/innovation/'.$_SESSION['role'].'/index', true, 303);
				exit;
			}
		}else{
		header('Location: https://aracpi.com/innovation/login', true, 303);
		exit;
		}
	}
	
}

?>
