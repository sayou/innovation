<?php

require_once '../vendor/autoload.php';

set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$router = new Core\Router();

//Routes

$router->add('',['controller'=>'Home','action'=>'siteWeb']);
$router->add('inscriptionPlatform',['controller'=>'Inscription','action'=>'index']);
//$router->add('',['controller'=>'Home','action'=>'index']);
$router->add('nouvelleInscription',['controller'=>'Inscription','action'=>'addNew']);
$router->add('editInscription',['controller'=>'Inscription','action'=>'edit']);
$router->add('saveInscription',['controller'=>'Inscription','action'=>'saveChanges']);
$router->add('progress',['controller'=>'Inscription','action'=>'progress']);
$router->add('imprimerPDF',['controller'=>'Inscription','action'=>'printPDF']);
$router->add('logout',['controller'=>'Inscription','action'=>'logout']);
$router->add('posts',['controller'=>'Posts','action'=>'index']);
$router->add('verifyEmail',['controller'=>'Inscription','action'=>'verifyEmail']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

//Route of private image
//$router->add('private_images/{filename:[\w\.-]+}', ['controller' => 'Images', 'action' => 'show']); 

//Route of admin
//$router->add('admin/{controller}/{action}',['namespace' => 'Admin']);

//Route of coach
$router->add('coach/{controller}/{action}',['namespace' => 'Coach']);
$router->add('{controller}/{action}',['namespace' => 'Coach']);
$router->add('{controller}/{id:\d+}/{action}',['namespace' => 'Coach']);
//$router->add('coach/{controller}/{id:\d+}/{action}',['namespace' => 'Coach']);
$url = "";
if(isset($_SERVER['QUERY_STRING'])){
$url = $_SERVER['QUERY_STRING'];
}
$router->dispatch($url);


?>