<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-br"> 
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/res/css/main.css">
	<!--glyphicon-->
	<link href="/res/bootstrap3/css/bootstrap.min.css" rel="stylesheet">
	<!-- font awesome -->
	<link href="/res/fontawesome/css/all.css" rel="stylesheet">
	<!-- Bootstrap -->
	<link href="/res/bootstrap5/css/bootstrap.min.css" rel="stylesheet">
	<title>InventárioRQ</title>
</head>
	<body>
		<!-- cabeçalho superior -->
		<div style="border-bottom: 3px rgb(251,158,13) solid;">
		<div class="row m-0 px-5" id="header" >
			<div class="col-6 position-relative" id="headerL">
				<div class="position-absolute top-50 start-0 translate-middle-y" >
					<img src="/res/imgs/logo.png" width="30">
					<h4 id="h3">Inventário<b>RQ</b></h3>			
				</div>	
			</div>
		
			<div class="col-6 position-relative" id="headerR">
				<div class="position-absolute top-50 end-0 translate-middle-y">
			      	<div class="dropdown">
			  			<button class="btn btn-secondary dropdown-toggle fs-4" style="background-color: rgba(1,153,185,1); color: rgb(251,158,13)" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo htmlspecialchars( $info["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></button>
			  			<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
			    			<li><a class="dropdown-item" href="/logout">Sair</a></li>
			  			</ul>
					</div>
				</div>   
			</div>
		</div>
		</div>	
		<!-- fim do cabeçalho superior -->
		
		<div class="row m-0 px-1" style="background-color: black">
		<div class="d-flex align-items-start">
		  <!-- Barra de navegação lateral esquerda -->
		  <div class="nav flex-column nav-pills me-3 col-2 fs-4 text-left"  id="v-pills-tab" role="tablist" aria-orientation="vertical">
		  	<h1 class="fs-3" id="h1"><?php echo htmlspecialchars( $info["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h1>
		    <a class="nav-link active btn-primary" href="/consulta" style="background-color: black; margin: 5px 0px 5px 0px"><i class="fas fa-clipboard-list" style="color: blue"></i> &nbsp Consulta</a>
		    <?php if( $info["tipo"] != '2' ){ ?>
		    <a class="nav-link btn-primary" href="/adicionar"  style="background-color: black; margin: 5px 0px 5px 0px"><i class="far fa-plus-square" style="color: blue"></i> &nbsp Incluir Reagente</a>
		    
		    <a class="nav-link btn-primary" href="/usuarios" style="background-color: black; margin: 5px 0px 5px 0px"><i class="fas fa-users" style="color: blue"></i> &nbspUsuários</a>

		    <a class="nav-link btn-primary" href="/solicita" style="background-color: black; margin: 5px 0px 5px 0px"><i class="far fa-bell" style="color: blue"></i> &nbsp Solicitações <sup><span class="badge rounded-pill bg-warning" style="color: black"><?php echo htmlspecialchars( $info["contador"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span></sup></a>
		    <?php } ?>
		    <a class="nav-link btn-primary" href="/documentos" style="background-color: black; margin: 5px 0px 5px 0px"><i class="fas fa-file-alt" style="color: blue"></i> &nbsp Documentos</a>
		    <?php if( $info["tipo"] != '2' ){ ?>
		    <a class="nav-link btn-primary" href="/backup" style="background-color: black; margin: 5px 0px 5px 0px"><i class="far fa-save" style="color: blue"></i> &nbsp Backup</a>
		    <?php } ?>
		  </div>
	
		  <!-- fim da barra de navegação lateral esquerda -->
		  
		  <!-- início do conteúdo principal à direita-->

		  <div class="col-10" style="background-color: rgb(200,200,200); height: 86vh">
