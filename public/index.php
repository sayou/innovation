<?php

require_once '../vendor/autoload.php';

set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$router = new Core\Router();

//Routes

$router->add('',['controller'=>'Home','action'=>'siteWeb']);
$router->add('login',['controller'=>'Home','action'=>'login']);
$router->add('inscriptionPlatform',['controller'=>'Inscription','action'=>'index']);

// begin super admin
$router->add('admin/index',['controller'=>'Admin','action'=>'index']);
$router->add('admin/listDesProjets',['controller'=>'Admin','action'=>'listDesProjets']);
$router->add('admin/details',['controller'=>'Admin','action'=>'details']);
$router->add('admin/coachJury',['controller'=>'Admin','action'=>'coachJury']);
$router->add('admin/addCoachJury',['controller'=>'Admin','action'=>'addCoachJury']);
$router->add('admin/deleteCoachJury',['controller'=>'Admin','action'=>'deleteCoachJury']);
$router->add('admin/winner',['controller'=>'Admin','action'=>'winner']);
$router->add('admin/{id:\d+}/selected',['controller'=>'Admin','action'=>'selected']);
$router->add('admin/{id:\d+}/details',['controller'=>'Admin','action'=>'details']);
// end super admin

//Begin route Jury
$router->add('jury/index',['controller'=>'Jury','action'=>'index']);
$router->add('jury/{id:\d+}/index',['controller'=>'Jury','action'=>'index']);
$router->add('jury/comments',['controller'=>'Jury','action'=>'comments']);
$router->add('jury/{id:\d+}/comments',['controller'=>'Jury','action'=>'comments']);
$router->add('jury/moncompte',['controller'=>'Jury','action'=>'moncompte']);
//End route Jury

//$router->add('',['controller'=>'Home','action'=>'index']);
//$router->add('nouvelleInscription',['controller'=>'Inscription','action'=>'addNew']);
$router->add('editInscription',['controller'=>'Inscription','action'=>'edit']);
$router->add('saveInscription',['controller'=>'Inscription','action'=>'saveChanges']);
$router->add('progress',['controller'=>'Inscription','action'=>'progress']);
$router->add('imprimerPDF',['controller'=>'Inscription','action'=>'printPDF']);
$router->add('logout',['controller'=>'Inscription','action'=>'logout']);
$router->add('posts',['controller'=>'Posts','action'=>'index']);
$router->add('verifyEmail',['controller'=>'Inscription','action'=>'verifyEmail']);
$router->add('verifyEditEmail',['controller'=>'Inscription','action'=>'verifyEditEmail']);
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
$router->add('coach/{controller}/{id:\d+}/{action}',['namespace' => 'Coach']);
$url = "";
if(isset($_SERVER['QUERY_STRING'])){
$url = $_SERVER['QUERY_STRING'];
}
$router->dispatch($url);


?>