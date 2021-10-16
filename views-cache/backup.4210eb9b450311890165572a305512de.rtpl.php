<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="tab-pane" style="padding: 5px 5px 5px 5px">
	<?php if( $info["tipo"] != '2' ){ ?>
	<section class="content-header" >
		<h1><i class="far fa-plus-square mb-3" style="color: black"></i> Backup</h1>
	</section>
	




		<section class="content-header mt-4">
			<h2><i class="fas fa-file-export" style="color: black"></i> Realizar backup:</h1>
		</section>

		<form class="mt-3" action="/backup" method="post" enctype="multipart/form-data">		
			<div class="col-md-12 mb-3">
				<button type="submit" class="btn btn-success fs-4" name="ReagentesDownload"><i class="fas fa-file-export"></i> Registros de Reagentes</button>
			</div>



			<div class="col-md-12 mb-5">
				<button type="submit" class="btn btn-success fs-4" name="BibliotecaDownload" ><i class="fas fa-file-export"></i> Lista de bibliotecas</button>
			</div>    
		</form>

	
		<section class="content-header">
			<h2><i class="fas fa-file-upload mt-5" style="color: black"></i> Restaurar backup:</h1>
			<?php if( $erro != '' ){ ?>
			<div class="alert alert-danger fs-3" style="text-align: center">
				<?php echo htmlspecialchars( $erro, ENT_COMPAT, 'UTF-8', FALSE ); ?>
			</div>
			<?php } ?>
		</section>				
	  	
	  	<form class="mt-3" action="/backup" method="post" enctype="multipart/form-data">	
	  		<div style="padding: 5px 5px 5px 10px">

	  		<h4><i class="fas fas fa-file-csv" style="color: black"></i> Restaurar biblioteca:</h4>	
			<div class="col-md-12">
				<input class="fs-4 mb-3" type="file" name="BibliotecaUpload" id="BibliotecaUpload" accept=".csv">
				<button type="submit" class="btn btn-primary fs-4" name="BibliotecaUpload"><i class="fas fa-file-import"></i> Importar arquivo </button>
			</div>
			<h4><i class="fas fas fa-file-csv mt-4" style="color: black"></i> Restaurar registros de reagentes:</h4>
			<div class="col-md-12 mt-1">
				<input class="fs-4 mb-3" type="file" name="ReagentesUpload" id="ReagentesUpload" accept=".csv">
				<button type="submit" class="btn btn-primary fs-4" name="ReagentesUpload"><i class="fas fa-file-import"></i> Importar arquivo </button>
			</div> 
			</div>   
		</form>
		


			
						
	<?php } ?>			
</div>