<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br"> 
<html>
<head>
	<meta charset="UTF-8"/>	<title>Esqueceu</title>
</head>
<body>
	<div>
		<h1 style="color: rgb(40,193,223); text-align: center">Inventário<b>RQ</b></h1>
	</div>
	<div style="height: 250px">
		<p>Olá, <?php echo htmlspecialchars( $nome, ENT_COMPAT, 'UTF-8', FALSE ); ?> (usuário: <?php echo htmlspecialchars( $login, ENT_COMPAT, 'UTF-8', FALSE ); ?>), <br><br> Redefina sua senha do InventárioRQ através do link abaixo:</p>
	<div>

			<p style="text-align: center"><?php echo htmlspecialchars( $link, ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
			<a href="/" style="color: rgb(251,158,13); alig: center">Redefinir senha</a>	
		</div>
		<p style="text-align: center">Informações e dúvidas: rodrigo.lacite@gmail.com</p>		
	</div>
	
</body>
</html>