<?php

namespace App\Controllers;
use \Core\View;
use App\Models\HomeModel;
session_start();

class Home extends \Core\Controller{
    
    protected function before(){
        //echo "(Before)";
    }
    
    protected function after(){
        //echo "(After)";
    }

    

    protected function siteWebAction(){

        $result = HomeModel::getProjectAndLeadInfosNonSelected();
        $result1 = HomeModel::getProjectAndLeadInfosSelected();
        $third = empty(HomeModel::getProjectAndLeadInfosThirdOne()) ? null : HomeModel::getProjectAndLeadInfosThirdOne();
        $second = empty(HomeModel::getProjectAndLeadInfosSecondOne()) ? null : HomeModel::getProjectAndLeadInfosSecondOne();
        $winner = empty(HomeModel::getProjectAndLeadInfosWinner()) ? null : HomeModel::getProjectAndLeadInfosWinner();
        $count = count($result);
        $count1 = count($result1);
        View::getView('SiteWeb/index.html', [
            'projectList' => $result,
            'projectListSelected' => $result1,
            'nbrProjects' => $count,
            'nbrprojectListSelected'=>$count1,
            'third'=>$third,
            'second'=>$second,
            'winner'=>$winner]);
    }

    protected function loginAction(){
        if(isset($_SESSION['id']) && isset($_SESSION['role'])){
            if(strcmp($_SESSION['role'],'coach') == 0){
                header('Location: https://aracpi.com/innovation/coach/index', true, 303);
                exit;
            }else if(strcmp($_SESSION['role'],'jury') == 0){
                header('Location: https://aracpi.com/innovation/jury/index', true, 303);
                exit;
            }else if(strcmp($_SESSION['role'],'admin') == 0){
                header('Location: https://aracpi.com/innovation/admin/index', true, 303);
                exit;
            }else{
                header('Location: https://aracpi.com/innovation/inscriptionPlatform', true, 303);
                exit;
            }
        }else{
            $test = null;
        if(isset($_POST["submit"])){
            $nom = $_POST["nomComplete"];
            $password = $_POST["password"];
            $datas = HomeModel::getByPasswordAndName($nom,$password);
            if(!empty($datas)){
                if(strcmp($datas['role'],'coach') == 0){
                    $_SESSION['id'] = $datas['id'];
                    $_SESSION['role'] = $datas['role'];
                    header('Location: https://aracpi.com/innovation/coach/index', true, 303);
                    exit;
                }else if(strcmp($datas['role'],'jury') == 0){
                    $_SESSION['id'] = $datas['id'];
                    $_SESSION['role'] = $datas['role'];
                    header('Location: https://aracpi.com/innovation/jury/index', true, 303);
                    exit;
                }else if(strcmp($datas['role'],'admin') == 0){
                    $_SESSION['id'] = $datas['id'];
                    $_SESSION['role'] = $datas['role'];
                    header('Location: https://aracpi.com/innovation/admin/index', true, 303);
                    exit;
                }else{
                    $test = 'false';
                    View::getView("login.html",['test'=>$test]);
                }
            }else{
                $test = 'false';
                View::getView("login.html",['test'=>$test]);
            }
        }else{View::getView("login.html",['test'=>$test]);}
        }
        
    }
    
}

?>