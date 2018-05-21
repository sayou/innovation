<?php

namespace App\Controllers;
use \Core\View;
use App\Models\HomeModel;

class Home extends \Core\Controller{
    
    protected function before(){
        //echo "(Before)";
    }
    
    protected function after(){
        //echo "(After)";
    }

    

    protected function siteWebAction(){

        $result = HomeModel::getProjectAndLeadInfos();
        $count = count($result);
        View::getView('SiteWeb/index.html', ['projectList' => $result, 'nbrProjects' => $count]);
    }

    protected function loginAction(){
        $test = null;
        if(isset($_POST["submit"])){
            $nom = $_POST["nomComplete"];
            $password = $_POST["password"];
            $datas = HomeModel::getByPasswordAndName($nom,$password);
            if(!empty($datas)){
                session_start();
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

?>