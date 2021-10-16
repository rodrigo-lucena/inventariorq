<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br"> 
<html>
<head>

	<link rel="stylesheet" type="text/css" href="/res/css/login.css">
	<!-- font awesome -->
	<link href="/res/fontawesome/css/all.css" rel="stylesheet">
	<!-- Bootstrap -->
	<link href="/res/bootstrap3/css/bootstrap.min.css" rel="stylesheet">
	<meta charset="UTF-8"/>	<title>Nova senha</title>
</head>
<body id="teste">
	<div id="head">
		<h1 id="title">Inventário<b>RQ</b></h1>
	</div>
	<div id="main" style="height: 250px">
		<p>Olá <?php echo htmlspecialchars( $nome, ENT_COMPAT, 'UTF-8', FALSE ); ?>, redefina sua senha abaixo</p>
		<form action="/esqueceu/reset" method="post">
			<div class="form-group has-feedback">
				<input type="hidden" name="code" value="<?php echo htmlspecialchars( $code, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
				<label for="senha" class="form-label">Nova senha</label>
		    	<input type="password" class="form-control fs-3" maxlength="45" id="senha" name="senha" required>
			</div>
		<div class="col-12 fs-3 mt-5">
			<button class="btn btn-primary fs-4" type="submit" style="background-color: rgba(1,153,185,1)">Enviar</button>	
		</div>
		</form>
		<p id="info">Informações e dúvidas: rodrigo.lacite@gmail.com</p>
		
	</div>
	<script src="/res/bootstrap5/js/bootstrap.bundle.min.js"></script>
	
</body>
</html>