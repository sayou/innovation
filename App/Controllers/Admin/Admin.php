<?php

namespace App\Controllers\Admin;
use \Core\View;
use \App\Models\Projet;

class Admin extends \Core\Controller{
    
    protected function before(){
        
    }
    
    public function indexAction(){
        View::getView('Admin/index.html');
    }

    public function projetAction(){
        $allproject = Projet::getAllProjects();
        $data = sizeof($allproject);
        View::getView('Admin/projets.html',["projects"=>$allproject,"data"=>$data]);
    }
    
}

?>