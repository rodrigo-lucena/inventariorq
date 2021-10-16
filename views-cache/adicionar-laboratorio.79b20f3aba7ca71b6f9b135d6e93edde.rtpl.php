<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="tab-pane" style="padding: 5px 5px 5px 5px">
    <section class="content-header" >
		<h1><i class="fas fa-tasks" style="color: black"></i> Editar laboratórios</h1>
	</section>
	<?php $item="laboratorio"; ?>
    <form class="row g-2 fs-4" action="/adicionar/item" method="post" style="margin-top: 10px; padding: 10px 10px 10px 10px">
		<legend> Incluir laboratório</legend>
		<div class="row">
	  		<input class="col form-control fs-4" type="text" name="laboratorio" required>
	  		<span class="col-5 position-relative"><button type="submit" class="btn btn-success btn-xs position-absolute top-50 translate-middle-y"><i class="far fa-check-circle"></i> Incluir</button></span>
		</div>
	</form>

	<div class="col-8" style="padding: 5px 5px 5px 5px"> 
		<legend class="mt-5"> Excluir/Atualizar laboratório</legend>
		<div style="overflow-y: auto; height:60vh">
	    <table class="table table-striped fs-4">			  
			<tbody>  
		    	<?php $counter1=-1;  if( isset($categoria) && ( is_array($categoria) || $categoria instanceof Traversable ) && sizeof($categoria) ) foreach( $categoria as $key1 => $value1 ){ $counter1++; ?>
		    	<form class="row g-2 fs-4" action="/adicionar/<?php echo htmlspecialchars( $item, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idlaboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" style="padding: 10px 10px 10px 10px">
			        <tr  style="text-align: left">
			            <td ><?php echo htmlspecialchars( $value1["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
			            <td style="text-align: right">
			              	<a href="/adicionar/<?php echo htmlspecialchars( $item, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idlaboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
			            </td>
			            <td >
			            	<div class="row">
			              		<input class="col form-control fs-4" type="text" name="atualizacao" required>
			              		<span class="col-4 position-relative"><button type="submit" class="btn btn-primary btn-xs position-absolute top-50 translate-middle-y"><i class="fas fa-undo-alt"></i> Atualizar</button></span>
			             	</div>
		  			    </td >
			        </tr>
		    	</form>
		    	<?php } ?>
			</tbody>		        
		</table>
		</div>
	</div>
	<?php if( $voltar["0"]=='atualizar' ){ ?>
	<div class="fs-3 mt-4"><a class="col-1 btn btn-dark fs-4" href="/consulta/<?php echo htmlspecialchars( $voltar["1"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" role="button">Voltar</a></div>
	<?php } ?>	
	<?php if( $voltar["0"]=='adicionar' ){ ?>
	<div class="fs-3 mt-4"><a class="col-1 btn btn-dark fs-4" href="/adicionar" role="button">Voltar</a></div>
	<?php } ?>	   	
</div>