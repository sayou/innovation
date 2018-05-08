<?php

namespace Core;

class View{
    
    public static function getView($template,$args=[]){
        static $twig = null;
        if($twig === null){
            try{
            $loader = new \Twig_Loader_Filesystem('../App/Views');
            $twig = new \Twig_Environment($loader);
                }catch(Exception $e){}
        }
        echo $twig->render($template,$args);
    }
}

?>