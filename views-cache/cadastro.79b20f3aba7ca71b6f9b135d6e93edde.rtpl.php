<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br"> 
<html>
<head>
	<link rel="stylesheet" type="text/css" href="res/css/cadastro.css">
	<!--glyphicon-->
	<link href="res/bootstrap3/css/bootstrap.min.css" rel="stylesheet">
	<!-- font awesome -->
	<link href="res/fontawesome/css/all.css" rel="stylesheet">
	<!-- Bootstrap -->
	<link href="res/bootstrap5/css/bootstrap.min.css" rel="stylesheet">
	<meta charset="UTF-8"/>	
	<title>Cadastro</title>
</head>
<body id="body">

	<div id="head">
		<h1 id="title"><b>Cadastro</b></h1>
	</div>
	
	<div id="form">
		<legend class="fs-3"><i class="far fa-user"></i> Identificação do usuário</legend>
		<form class="row g-3 fs-3">
		  <div class="col-md-4">
		    <label for="pnome" class="form-label">Nome</label>
		    <input type="text" class="form-control fs-3" id="pnome" required>
		  </div>
		  <div class="col-md-4">
		    <label for="sobrenome" class="form-label">Sobrenome</label>
		    <input type="text" class="form-control fs-3" id="sobrenome" required>
		  </div>
		  <div class="col-md-4">
		    <label for="email" class="form-label">Email</label>
		    <input type="email" class="form-control fs-3" id="email" required>
		  </div>
		  <div class="col-md-4">
		    <label for="user" class="form-label">Usuário</label>
		    <input type="text" class="form-control fs-3" id="user" required>
		  </div>
		  <div class="col-md-4">
		    <label for="senha" class="form-label">Senha</label>
		    <input type="password" class="form-control fs-3" id="senha" required>
		  </div>
		  <div class="col-md-4">
		    <label for="csenha" class="form-label">Confirmação de senha</label>
		    <input type="password" class="form-control fs-3" id="csenha" required>
		  </div>
		  <legend class="fs-3"><i class="fas fa-link"></i> Vínculo</legend>
		  <div class="col-md-5">
		    <label for="presponsavel" class="form-label">Professor Responsável</label>
		    <select class="form-select fs-3" id="presponsavel" required>
		      <option selected disabled value="">Escolha...</option>
		      <option>João Vicente</option>
		      <option>Pedro Silva</option>
		    </select>
		  </div>
		  <div class="col-md-5">
		    <label for="lab" class="form-label">Laboratório</label>
		    <select class="form-select fs-3" id="lab" required>
		      <option selected disabled value="">Escolha...</option>
		      <option>Ciências da Terra</option>
		      <option>Química</option>
		    </select>
		  </div>
		  <div class="col-12 fs-3 mt-5">
		    <button class="btn btn-primary fs-3" type="submit">Enviar</button>
		    <a class="btn btn-dark fs-3 mx-2" href="/">Voltar</a>
		  </div>
		</form>	
	</div>





<!-- scripts associados ao javascript -->
	<script src="res/bootstrap5/js/bootstrap.bundle.min.js"></script>
</body>
</html>