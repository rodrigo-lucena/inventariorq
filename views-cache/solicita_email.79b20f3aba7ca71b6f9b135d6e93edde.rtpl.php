<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br"> 
<html>
<head>
	<meta charset="UTF-8"/>	<title>Aceite de cadastro</title>
</head>
<body>
	<div>
		<h1 style="color: rgb(40,193,223); text-align: center">Inventário<b>RQ</b></h1>
	</div>
	<div style="height: 250px">
		<p>Olá, <?php echo htmlspecialchars( $nome, ENT_COMPAT, 'UTF-8', FALSE ); ?>, <br><br> Seu cadastro acabou de ser aprovado. Entre na tela de login (www.inventariorq.com.br) e acesse o inventário de reagentes dos laboratórios.</p>
		<p style="text-align: center">Informações e dúvidas: rodrigo.lacite@gmail.com</p>		
	</div>
	
</body>
</html>