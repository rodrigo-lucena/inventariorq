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
	
	<div id="form" style="height: auto">
		<?php if( $error != '' ){ ?>
		<div class="alert alert-danger" style="text-align: center; font-size: 12pt">
		    <?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
		</div>
		<?php } ?>	
		<legend class="fs-3"><i class="far fa-user"></i> Identificação do usuário</legend>
		<form class="row g-3 fs-3 needs-validation" action="/cadastro" method="post">
		  <div class="col-md-4">
		    <label for="pnome" class="form-label">Nome</label>
		    <input type="text" class="form-control fs-3" maxlength="20" id="pnome" name="nome" required>
		    <div class="valid-feedback">
      		Please enter a message in the textarea.
    		</div>
		  </div>
		  <div class="col-md-4">
		    <label for="sobrenome" class="form-label">Sobrenome</label>
		    <input type="text" class="form-control fs-3" maxlength="25" id="sobrenome" name="sobrenome" required>
		  </div>
		  <div class="col-md-4">
		    <label for="email" class="form-label">Email</label>
		    <input type="email" class="form-control fs-3" maxlength="45" id="email" name="email" required>
		  </div>
		  <div class="col-md-4">
		    <label for="user" class="form-label">Usuário</label>
		    <input type="text" class="form-control fs-3" minlength="6" maxlength="20" id="user" name="login" placeholder="6 a 20 caracteres" required>
		  </div>
		  <div class="col-md-4">
		    <label for="senha" class="form-label">Senha</label>
		    <input type="password" class="form-control fs-3" minlength="6" maxlength="10" id="senha" name="senha" placeholder="6 a 10 caracteres" required>
		  </div>
		  <div class="col-md-4">
		    <label for="csenha" class="form-label">Confirmação de senha</label>
		    <input type="password" minlength="6" maxlength="10" class="form-control fs-3" maxlength="10" id="csenha" placeholder="6 a 10 caracteres" required>
		  </div>
		  <legend class="fs-3"><i class="fas fa-link"></i> Vínculo</legend>
		  <div class="col-md-5">
		    <label for="presponsavel" class="form-label">Professor Responsável</label>
		    <select class="form-select fs-3" id="presponsavel" name="responsavel" required>
		      <option selected disabled value="">Escolha...</option>
		      <?php $counter1=-1;  if( isset($lists["1"]) && ( is_array($lists["1"]) || $lists["1"] instanceof Traversable ) && sizeof($lists["1"]) ) foreach( $lists["1"] as $key1 => $value1 ){ $counter1++; ?>
	    	  <option><?php echo htmlspecialchars( $value1["responsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
	    	  <?php } ?>	
		    </select>
		  </div>
		  <div class="col-md-5">
		    <label for="lab" class="form-label">Laboratório</label>
		    <select class="form-select fs-3" id="lab" name="laboratorio" required>
		      <option selected disabled value="">Escolha...</option>
		      <?php $counter1=-1;  if( isset($lists["0"]) && ( is_array($lists["0"]) || $lists["0"] instanceof Traversable ) && sizeof($lists["0"]) ) foreach( $lists["0"] as $key1 => $value1 ){ $counter1++; ?>
	    	  <option><?php echo htmlspecialchars( $value1["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
		      <?php } ?>	
		    </select>
		  </div>
		  <div class="col-12 fs-3 mt-5">
		    <button class="btn btn-primary fs-3" type="submit">Enviar</button>
		    <a class="btn btn-dark fs-3 mx-2" href="/">Voltar</a>
		  </div>
		</form>
	</div>

<!-- scripts associados ao javascript -->
	<script>
		var password = document.getElementById("senha");
		var	confirm_password = document.getElementById("csenha");
		function validatePassword(){
  			if(password.value != confirm_password.value) {
    			confirm_password.setCustomValidity("Senhas diferentes!");
  			} else {
    			confirm_password.setCustomValidity('');
  			}
		}
		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;

	</script>
	<script src="res/bootstrap5/js/bootstrap.bundle.min.js"></script>
</body>
</html>