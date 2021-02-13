<?php 

session_start();
require_once "vendor/autoload.php";

use \Slim\Slim; 
use \Invent\Page;
use \Invent\Model\User;

$app = new Slim();
$app->config('debug', true); // Modo debug para visualizar erros. Pode retirá-lo no final.

$app->get('/', function() {

	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("login");

});

$app->post('/', function() {

	User::login($_POST["login"],$_POST["password"]);
	header("Location: /consulta");
	exit;

});

$app->get('/cadastro', function() {
	
	$page = new Page(["header"=>false,"footer"=>false]);
	$page->setTpl("cadastro");


});

$app->get('/consulta', function() {
	User::verifyLogin();
	
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta", array("data"=>array("info"=>$info)));

});

$app->get('/adicionar', function() {
	User::verifyLogin();
	
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("adicionar");
	
});

$app->get('/usuarios', function() {
	User::verifyLogin();
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$users = User::listAll();
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("usuarios", array("users"=>$users));
	
});

$app->get('/solicita', function() {
	User::verifyLogin();
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$users = User::listAll(0);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("solicita", array("users"=>$users));
	
});

$app->get('/documentos', function() {
	User::verifyLogin();
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("documentos");
	
});

$app->get('/logout', function() {

	User::logout();
	header("Location: /");
	exit;
	
});


$app->run();
 
 ?>