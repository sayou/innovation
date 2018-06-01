<?php

namespace App\Controllers\Coach;
use \Core\View;
use \App\Models\Projet;
use \App\Models\Coachs;

session_start();

class Coach extends \Core\Controller{
    
    protected function before(){
        
    }
    
    protected function mesprojetsAction(){
        if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'coach') == 0){
                $datas = null;
                $countdata = null;
                $id = isset($this->route_params['id']) ? $this->route_params['id'] : null; 
        
        
                if(!is_null($id)){
                  $result = "yes";
                  $datas = Projet::getEtatAvancement($id);
                  $countdata = sizeof($datas);
                  }else{$result = "no";}
                $datasCoach = Coachs::getCoachById($_SESSION['id']);
                $allproject = Projet::getProjetDataByCoach($_SESSION['id']);
                View::getView('Coach/mesprojets.html',[
                    "projects"=>$allproject,
                    "datas"=>$datas,
                    "countdata"=>$countdata,
                    "result"=>$result,
                    "datasCoach"=>$datasCoach
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

    protected function indexAction(){
        if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'coach') == 0){
                $test = null;
                $dataoneprojet = null;
                $id_route = isset($this->route_params['id']) ? $this->route_params['id'] : null;
                if(!is_null($id_route)){
                    $test = 'true';
                    $dataoneprojet = Projet::getProjetInformationByID($id_route);
                if($id = filter_input(INPUT_POST,'id')){
                    $type = filter_input(INPUT_POST,'type');
                    if($type === 'true'){
                        
                        $res = Projet::addingCoachToProject($id,$_SESSION['id']);
                        if($res > 0){
                            echo "<script>new PNotify({
                                    title: 'Super',
                                    text: 'Vous êtes maintenant le coach de ce projet, vous permet le suivre maintenant',
                                    type: 'success',
                                    styling: 'bootstrap3'
                            });</script>";
                        }else{echo "<script>new PNotify({
                                title: 'Une erreur s'est produite',
                                text: 'Oop! Une erreur s'est produite veuillez réessayer après',
                                type: 'error',
                                styling: 'bootstrap3'
                            });</script>";
                        }
                        
                    }else{
                        $result = Projet::deleteCoachFromProject($id,$_SESSION['id']);
                        if($result > 0){
                            echo "<script>new PNotify({
                                title: 'Super',
                                text: 'Le projet est supprimé de votre listes des projets que vous suivez',
                                type: 'success',
                                styling: 'bootstrap3'
                            });</script>";
                        }else{echo "<script>new PNotify({
                            title: 'Une erreur s'est produite',
                            text: 'Oop! Une erreur s'est produite veuillez réessayer après',
                            type: 'error',
                            styling: 'bootstrap3'
                        });</script>";}
                    }
                    
                }else{
                $allprojectofcoach = Projet::getProjetByCoach($_SESSION['id']);
                $allproject = Projet::getAllProjects();
                $coachs = Projet::getAllCoachs();
                $datasCoach = Coachs::getCoachById($_SESSION['id']);
                View::getView('Coach/projets.html',[
                    "projects"=>$allproject,
                    "projectsofcoach"=>$allprojectofcoach,
                    "coachs"=>$coachs,
                    "datasCoach"=>$datasCoach,
                    "test" => $test,
                    "dataoneprojet"=>$dataoneprojet
                    ]);
            }
        }else{
            if($id = filter_input(INPUT_POST,'id')){
                $type = filter_input(INPUT_POST,'type');
                if($type === 'true'){
                    
                    $res = Projet::addingCoachToProject($id,$_SESSION['id']);
                    if($res > 0){
                        echo "<script>new PNotify({
                                title: 'Super',
                                text: 'Vous êtes maintenant le coach de ce projet, vous permet le suivre maintenant',
                                type: 'success',
                                styling: 'bootstrap3'
                        });</script>";
                    }else{echo "<script>new PNotify({
                            title: 'Une erreur s'est produite',
                            text: 'Oop! Une erreur s'est produite veuillez réessayer après',
                            type: 'error',
                            styling: 'bootstrap3'
                        });</script>";
                    }
                    
                }else{
                    $result = Projet::deleteCoachFromProject($id,$_SESSION['id']);
                    if($result > 0){
                        echo "<script>new PNotify({
                            title: 'Super',
                            text: 'Le projet est supprimé de votre listes des projets que vous suivez',
                            type: 'success',
                            styling: 'bootstrap3'
                        });</script>";
                    }else{echo "<script>new PNotify({
                        title: 'Une erreur s'est produite',
                        text: 'Oop! Une erreur s'est produite veuillez réessayer après',
                        type: 'error',
                        styling: 'bootstrap3'
                    });</script>";}
                }
                
            }else{
            $allprojectofcoach = Projet::getProjetByCoach($_SESSION['id']);
            $allproject = Projet::getAllProjects();
            $coachs = Projet::getAllCoachs();
            $datasCoach = Coachs::getCoachById($_SESSION['id']);
            View::getView('Coach/projets.html',[
                "projects"=>$allproject,
                "projectsofcoach"=>$allprojectofcoach,
                "coachs"=>$coachs,
                "datasCoach"=>$datasCoach,
                "test" => $test,
                "dataoneprojet"=>$dataoneprojet
                ]);
        }
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

    protected function moncompteAction(){
        if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'coach') == 0){
            $test = null;
            if(isset($_POST["password"])){
                $password = $_POST["password"];
                $password2 = $_POST["password2"];
                if(strcmp($password,$password2) == 0){
                    $result = Coachs::updateCoach($password,$_SESSION['id']);
                    if($result > 0){
                        $test = "true";
                    }else{$test = "false";}
                }else{
                    $test = "erreur";
                } 
            }
            $datasCoach = Coachs::getCoachById($_SESSION['id']);
            View::getView('Coach/moncompte.html',[
                "datasCoach"=>$datasCoach,
                "test"=>$test
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