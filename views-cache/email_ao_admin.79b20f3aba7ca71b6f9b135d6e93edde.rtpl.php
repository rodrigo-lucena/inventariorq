<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br"> 
<html>
<head>
	<meta charset="UTF-8"/>	<title>Nova solicitação de cadastro</title>
</head>
<body>
	<div>
		<h1 style="color: rgb(40,193,223); text-align: center">Inventário<b>RQ</b></h1>
	</div>
	<div style="height: 250px">
		<p>O usuário <?php echo htmlspecialchars( $nome, ENT_COMPAT, 'UTF-8', FALSE ); ?> está solicitando acesso à plataforma InventárioRQ. Para aceitar ou recusar o acesso, entre na aplicação e em "Solicitações" clique em "Aceitar" ou "Recusar".</p>
		<p style="text-align: center">Informações e dúvidas: rodrigo.lacite@gmail.com</p>		
	</div>
	
</body>
</html>