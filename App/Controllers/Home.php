<?php

namespace App\Controllers;
use \Core\View;

class Home extends \Core\Controller{
    
    protected function before(){
        //echo "(Before)";
    }
    
    protected function after(){
        //echo "(After)";
    }

    public function indexAction(){
        View::getView('Home/index.html');
    }
}

?>