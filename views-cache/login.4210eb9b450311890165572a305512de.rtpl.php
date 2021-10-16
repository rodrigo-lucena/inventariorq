<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br"> 
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/res/css/login.css">
	<!-- font awesome -->
	<link href="res/fontawesome/css/all.css" rel="stylesheet">
	<!-- Bootstrap -->
	<link href="res/bootstrap3/css/bootstrap.min.css" rel="stylesheet">
	<meta charset="UTF-8"/>	<title>Acesso</title>
</head>
<body id="teste">
	<div id="head">
		<h1 id="title">Inventário<b>RQ</b></h1>
	</div>	
	<div id="main" style="height: auto">
		<?php if( $erro != '' ){ ?>
		<div class="alert alert-danger" style="text-align: center">
		    <?php echo htmlspecialchars( $erro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
		</div>
		<?php } ?>		
		<p>Preencha seus dados para iniciar a sessão</p>	
		<form action="/" method="post">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Email" name="email">
				<span class="glyphicon glyphicon-envelope"></span>
			</div>
			<div class="form-group has-feedback">
			  	<input type="password" class="form-control" placeholder="Senha" name="senha">
			  	<span class="glyphicon glyphicon-lock"></span>
			</div>
			<div class="col-12 fs-3">
				<button class="btn btn-primary fs-4" type="submit" style="background-color: rgba(1,153,185,1)">Entrar</button>
				<a class="btn btn-warning fs-4 mb-3" href="/cadastro" style="background-color: rgb(251,158,13); color: white">Novo usuário</a>	
			</div>
			<a href="/esqueceu" >Esqueceu a senha?</a>
		</form>
		<p id="info">Informações e dúvidas: rodrigo.lacite@gmail.com</p>		
	</div>
	<script src="res/bootstrap5/js/bootstrap.bundle.min.js"></script>
</body>
</html>