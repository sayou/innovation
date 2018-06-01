<?php

namespace App\Controllers;
use \Core\View;
use App\Models\Projet;
use App\Models\Coachs;

session_start();
class Jury extends \Core\Controller{

    protected function indexAction(){
        if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'jury') == 0){
        $id = isset($this->route_params['id']) ? $this->route_params['id'] : null;
        $commentaire = null;
        $test = null;
        $projet = null;
        if(!is_null($id)){
            $projet = Projet::getProjetByID($id);
            if(isset($_POST["commentaire"])){
                $commentaire = "yes";
                $comm = $_POST["commentaire"];
                $result = Projet::addNewCommentsJury($_SESSION['id'],$id,$comm);
                if($result > 0){
                    $test = "true";
                }else{$test = "false";}

            }else{
                $commentaire = "yes";
            }
        }
        $allproject = Projet::getAllProjects();
        $datasJury = Coachs::getCoachById($_SESSION['id']);
        View::getView('Jury/projets.html',[
            "projects"=>$allproject,
            "commentaire"=>$commentaire,
            "test"=>$test,
            "id"=>$id,
            "projet"=>$projet,
            "datasJury"=>$datasJury
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

    protected function commentsAction(){
        if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'jury') == 0){
        $id = isset($this->route_params['id']) ? $this->route_params['id'] : null;
        $commentaire = null;
        $test = null;
        $comms = null;
        $projet = null;
        if(!is_null($id)){
            $commentaire = "yes2";
            $comms = Projet::getJuryCommentsByID($id,$_SESSION['id']);
            $projet = Projet::getProjetByID($id);
        }
        $allproject = Projet::getAllProjects();
        $datasJury = Coachs::getCoachById($_SESSION['id']);
        View::getView('Jury/projets.html',[
            "projects"=>$allproject,
            "commentaire"=>$commentaire,
            "test"=>$test,
            "id"=>$id,
            "comms"=>$comms,
            "projet"=>$projet,
            "datasJury"=>$datasJury
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

    protected function moncompteAction(){
        if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'jury') == 0){
                $test = null;

                if(isset($_POST['password'])){
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
                $datasJury = Coachs::getCoachById($_SESSION['id']);
                View::getView("Jury/moncompte.html",['test'=>$test,"datasJury"=>$datasJury]);
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