<?php

namespace App\Controllers;
use \Core\View;

class Images extends \Core\Controller{

    protected function showAction() { 
        // Get the filename from the URL and prepend the directory 
        $filename = "../images/" . $this->route_params['filename']; 
        // Check if the file exists, throw a 404 if not found 
        if (file_exists($filename)) { 
            header("Content-type: image/png");               
            readfile($filename); 
        } 
        else 
        { throw new \Exception('File not found.', 404); } 
    }
    
}
?>