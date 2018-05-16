<?php

namespace Core;

class Error{
    
    public static function errorHandler($level,$message,$file,$line){
        if(error_reporting() !== 0){
            throw new \ErrorException($message,0,$level,$file,$line);
        }
    }
    
    public static function exceptionHandler($exception){
        
        $code = $exception->getCode();
        if($code != 404){$code = 500;}
        http_response_code($code);
        if(\App\Config::SHOW_ERRORS){
            echo "<h1>Ooops Error</h1>";
            echo "<p>Uncaught Exception : '".get_class($exception)."'</p>";
            echo "<p>Message : '".$exception->getMessage()."'</p>";
            echo "<p>Stack Trace : '".$exception->getTraceAsString()."'</p>";
            echo "<p>Error in : '".$exception->getFile()."' Line : '".$exception->getLine()."'</p>";
        }else{
            $log = dirname(__DIR__).'/logs/'.date("Y-m-d").'.txt';
            ini_set('error_log',$log);
            
            $message = "Error ";
            $message .= "Uncaught Exception : '".get_class($exception)."'</p>";
            $message .= "\nMessage : '".$exception->getMessage()."'";
            $message .= "\nStack Trace : '".$exception->getTraceAsString()."'";
            $message .= "\nError in : '".$exception->getFile()."' Line : '".$exception->getLine()."'\n";
            
            error_log($message);
            /*if($code == 404){echo " Page not found ";}
            else{echo "<h1>Ooops !! something wrong</h2>";}*/
            View::getView("$code.html");
        }
    }
}

?>