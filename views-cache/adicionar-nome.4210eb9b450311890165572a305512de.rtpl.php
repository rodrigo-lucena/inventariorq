<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="tab-pane" style="padding: 5px 5px 5px 5px">
  <section class="content-header">
		<h1><i class="fas fa-tasks" style="color: black"></i> Editar nome</h1>
	</section>
	<?php $item="nome"; ?>
  


		<div class="col-8" style="padding: 5px 5px 5px 5px"> 
			<legend> Incluir nome</legend>
			
	    <table class="table table-striped fs-4">
	    	<thead>
              <tr style="text-align: left">
                <th >Nome</th>
                <th >Fórmula</th>
                <th >CAS</th>
                <th data-bs-toggle="tooltip" data-bs-placement="top" title="PC = Polícia Civil; PF = Polícia Federal; EB = Exército Brasileiro">Controle (?)</th>
              </tr>
        </thead>
				<tbody>
					<form class="row g-2 fs-4" action="/adicionar/item" method="post" style="margin-top: 10px; padding: 10px 10px 10px 10px">  
			        <tr  style="text-align: left">		            	
              	<td ><input class="col form-control fs-4" type="text" name="nome" required></td>

              	<td ><input class="col form-control fs-4" type="text" name="formula"></td>

              	<td ><input class="col form-control fs-4" type="text" name="cas"></td>
              	
              	<td >		
            			<select class="form-select fs-4" id="lab" name="controle">
										<?php $counter1=-1;  if( isset($categoria["1"]) && ( is_array($categoria["1"]) || $categoria["1"] instanceof Traversable ) && sizeof($categoria["1"]) ) foreach( $categoria["1"] as $key1 => $value1 ){ $counter1++; ?>
										<option><?php echo htmlspecialchars( $value1["controle"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>	
										<?php } ?>	
									</select>
              	</td>
              	<td>
              			<span class="col-12 position-relative"><button type="submit" class="btn btn-success btn-xs"><i class="far fa-check-circle"></i> Incluir</button></span>
              	</td>  
			        </tr> 
			    </form> 	
				</tbody>		        
			</table>
		</div>

	<div class="col-12" style="padding: 5px 5px 5px 5px"> 
		<legend class="mt-5"> Excluir/Atualizar nome</legend>
		<div style="overflow-y: auto; height:50vh">
	    <table class="table table-striped fs-4">
	    	<thead>
              <tr style="text-align: left">
                <th >Nome</th>
                <th >Fórmula</th>
                <th >CAS</th>
                <th data-bs-toggle="tooltip" data-bs-placement="top" title="PC = Polícia Civil; PF = Polícia Federal; EB = Exército Brasileiro">Controle (?)</th>
                 <th ></th>
                <th >Nome</th>
                <th >Fórmula</th>
                <th >CAS</th>
                <th data-bs-toggle="tooltip" data-bs-placement="top" title="PC = Polícia Civil; PF = Polícia Federal; EB = Exército Brasileiro">Controle (?)</th>
              </tr>
        </thead>
				<tbody>  
		    	<?php $counter1=-1;  if( isset($categoria["0"]) && ( is_array($categoria["0"]) || $categoria["0"] instanceof Traversable ) && sizeof($categoria["0"]) ) foreach( $categoria["0"] as $key1 => $value1 ){ $counter1++; ?>
		    	<form class="row g-2 fs-4" action="/adicionar/<?php echo htmlspecialchars( $item, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idnome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" style="padding: 10px 10px 10px 10px">
			        <tr  style="text-align: left">
			            <td ><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
			            
			            <td ><?php echo htmlspecialchars( $value1["formula"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>

			            <td ><?php echo htmlspecialchars( $value1["cas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
			            
			            <td ><?php echo htmlspecialchars( $value1["controle"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
			            
			            <td style="text-align: right">
			              	<a href="/adicionar/<?php echo htmlspecialchars( $item, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $value1["idnome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
			            </td>
			            
		            	
		              	<td ><input class="col form-control fs-4" type="text" name="nome" value="<?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required></td>

		              	<td ><input class="col form-control fs-4" type="text" name="formula" value="<?php echo htmlspecialchars( $value1["formula"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></td>

		              	<td ><input class="col form-control fs-4" type="text" name="cas" value="<?php echo htmlspecialchars( $value1["cas"], ENT_COMPAT, 'UTF-8', FALSE ); ?>"></td>
		              	
		              	<td >		
	              			<select class="form-select fs-4" id="lab" name="controle">
												<?php $controle = $value1["controle"]; ?>
												<?php $counter2=-1;  if( isset($categoria["1"]) && ( is_array($categoria["1"]) || $categoria["1"] instanceof Traversable ) && sizeof($categoria["1"]) ) foreach( $categoria["1"] as $key2 => $value2 ){ $counter2++; ?>
												<?php if( $value2["controle"]==$controle ){ ?>
												<option selected ><?php echo htmlspecialchars( $value2["controle"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
												<?php } ?>
												<option><?php echo htmlspecialchars( $value2["controle"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>	
												<?php } ?>	
											</select>
		              	</td>
		              	<td>
		              			<span class="col-12 position-relative"><button type="submit" 
		              			onclick="return confirm('Deseja realmente modificar este registro? A lista de reagentes poderá ser afetada com essa mudança.')"	class="btn btn-primary btn-xs"><i class="fas fa-undo-alt"></i> Atualizar</button></span>
		              		
		              	</td>
		             	
		  			    
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