<?php

namespace App\Controllers\Admin;

class Users extends \Core\Controller{
    
    protected function before(){
        
    }
    
    public function indexAction(){
        echo "Hello from the index action in Admin\User controller";
    }
    
}

?>