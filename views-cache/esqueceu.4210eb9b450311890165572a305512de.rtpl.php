<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br"> 
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/res/css/login.css">
	<!-- font awesome -->
	<link href="/res/fontawesome/css/all.css" rel="stylesheet">
	<!-- Bootstrap -->
	<link href="/res/bootstrap3/css/bootstrap.min.css" rel="stylesheet">
	<meta charset="UTF-8"/>	<title>Senha esquecida</title>
</head>
<body id="teste">
	<div id="head">
		<h1 id="title">Inventário<b>RQ</b></h1>
	</div>
	<div id="main" style="height: auto">
		<p>Preencha o email de acordo com seu cadastro</p>
		<?php if( $erro != '' ){ ?>
		<div class="alert alert-danger" style="text-align: center">
		    <?php echo htmlspecialchars( $erro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
		</div>
		<?php } ?>	
		<form action="/esqueceu" method="post">
			<div class="form-group has-feedback">
				<label for="email" class="form-label">Email</label>
		    	<input type="email" class="form-control fs-3" maxlength="45" id="email" name="email" required>
			</div>
		<div class="col-12 fs-3 mt-5">
			<button class="btn btn-primary fs-4" type="submit" style="background-color: rgba(1,153,185,1)">Enviar</button>
			<a class="btn btn-warning fs-4" href="/" style="background-color: rgb(251,158,13); color: white">Voltar</a>
		</div>

		</form>
		<p id="info">Informações e dúvidas: rodrigo.lacite@gmail.com</p>		
	</div>
	<script src="/res/bootstrap5/js/bootstrap.bundle.min.js"></script>
	
</body>
</html>