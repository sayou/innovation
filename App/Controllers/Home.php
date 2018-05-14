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

    protected function indexAction(){
        View::getView('Home/index.html');
    }

    protected function siteWebAction(){

        $result = HomeModel::getProjectAndLeadInfos();
        $count = count($result);

        View::getView('SiteWeb/index.html', ['projectList' => $result, 'nbrProjects' => $count]);
    }
}

?>