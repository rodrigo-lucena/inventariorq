<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="tab-pane" style="padding: 5px 5px 5px 5px">
    <section class="content-header" >
		<h1><i class="fas fa-tasks" style="color: black"></i> Editar marcas</h1>
	</section>
	<?php $item="marca"; ?>
    <form class="row g-2 fs-4" action="/adicionar/item" method="post" style="margin-top: 10px; padding: 10px 10px 10px 10px">
	  <legend> Incluir Marca</legend>
	  <div class="row">
	  	<input class="col form-control fs-4" type="text" name="marca" required>
	  	<span class="col-5 position-relative"><button class="btn btn-success btn-xs position-absolute top-50 translate-middle-y" type="submit"><i class="far fa-check-circle"></i> Incluir</button></span>
	  </div>
	  <legend class="mt-5"> Excluir Marca</legend>
	  <div class="col-4"> 
		  <table class="table table-striped fs-4">			  
			  <tbody>
			  	  
		          <?php $counter1=-1;  if( isset($categoria) && ( is_array($categoria) || $categoria instanceof Traversable ) && sizeof($categoria) ) foreach( $categoria as $key1 => $value1 ){ $counter1++; ?>
		          <tr  style="text-align: left">
		            <td ><?php echo htmlspecialchars( $value1["marca"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
		            <td style="text-align: right">
		              <a href="/adicionar/<?php echo htmlspecialchars( $item, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idmarca"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
		            </td>
		          </tr>
		          <?php } ?>
		         
		        </tbody>		        
		   </table>
	   </div>
	   <div class="fs-3 mt-4"><a class="col-1 btn btn-dark fs-4" href="/adicionar" role="button">Voltar</a></div>	   
	 </form>	
	</div>


