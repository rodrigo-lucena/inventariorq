<?php 

session_start();
require_once "vendor/autoload.php";

use \Slim\Slim; 
use \Invent\Page;
use \Invent\Model\User;
use \Invent\Model\Reagents;

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

$app->post('/consulta', function() {
	User::verifyLogin();	
	$reagents = Reagents::search($_POST["Reagente"],$_POST["Responsavel"], $_POST["radioB"], $_POST["radioC"], $_POST["radioV"]);
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta", array("reagents"=>$reagents));
});

$app->get('/consulta', function() {
	User::verifyLogin();
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("consulta");
});

// INÍCIO DO GERENCIAMENTO DA SESSÃO "INCLUIR REAGENTES"
$app->post('/adicionar/item', function() {
	User::verifyLogin();
	switch (array_keys($_POST)[0]) {
		case 'marca':
			Reagents::saveItem("marca_r","marca",$_POST["marca"]);
			break;
		case 'laboratorio':
			Reagents::saveItem("laboratorio_r","laboratorio",$_POST["laboratorio"]);
			break;
		case 'responsavel':
			Reagents::saveItem("responsavel_r","responsavel",$_POST["responsavel"]);
			break;
	}		
	header("Location: /adicionar/".array_keys($_POST)[0]);
	exit;
});

$app->get('/adicionar/:item/:iditem/delete', function($item, $iditem) {
	User::verifyLogin();
	Reagents::deleteItem($item,$iditem);
	header("Location: /adicionar/$item");
	exit;	
});

$app->get('/adicionar/:item', function($item){
	User::verifyLogin();	
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);

	$categoria = Reagents::itens($item."_r");
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("adicionar-".$item, array("categoria"=>$categoria));
});

$app->get('/adicionar', function() {
	User::verifyLogin();	
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$lists = Reagents::lists();
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("adicionar", array("lists"=>$lists));	
});

$app->post('/adicionar', function() {
	User::verifyLogin();
	$reagent = new Reagents();
	$reagent->setData($_POST);
	$reagent->save();
	header("Location: /adicionar");
	exit;	
});
// FINAL DO GERENCIAMENTO DA SESSÃO "INCLUIR REAGENTES"

$app->get('/usuarios/:idusuario/delete', function($idusuario) {
	User::verifyLogin();
});

$app->get('/usuarios/:idusuario', function($idusuario) {
	User::verifyLogin();
	$count = User::countSol()[0];
	$info = array_merge($_SESSION[User::SESSION],$count);
	unset($info['senha']);
	$page = new Page(array("data"=>array("info"=>$info)));
	$page->setTpl("usuario-update");
});

$app->post('/usuarios/:idusuario', function($idusuario) {
	User::verifyLogin();
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