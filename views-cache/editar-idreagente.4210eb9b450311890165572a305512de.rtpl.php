<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="tab-pane" style="padding: 5px 5px 5px 5px">
	<section class="content-header" >
		<h1><i class="fas fa-tasks" style="color: black"></i> Editar reagente</h1>
	</section>
	<form class="row g-3 fs-4" action="/consulta/<?php echo htmlspecialchars( $reagente["idreagente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" style="margin-top: 10px; padding: 10px 10px 10px 10px">
	
	
	<div class="col-md-4">
			<label for="nome" class="form-label">Nome</label>
			<?php $item0="nome"; ?>
			<a href="/adicionar/<?php echo htmlspecialchars( $item0, ENT_COMPAT, 'UTF-8', FALSE ); ?>" ><span data-bs-toggle="tooltip" title="Editar nome"><i class="fas fa-edit fs-2" ></i></span></a>		
			<select class="form-select fs-4" id="nome" name="nome" required="">
			    <option selected><?php echo htmlspecialchars( $reagente["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			    <?php $counter1=-1;  if( isset($lista["0"]) && ( is_array($lista["0"]) || $lista["0"] instanceof Traversable ) && sizeof($lista["0"]) ) foreach( $lista["0"] as $key1 => $value1 ){ $counter1++; ?>
			    <option><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			    <?php } ?>	
			</select>				    
	</div>
	
	<div class="col-md-2">
			<label for="grau" class="form-label">Grau</label>
			<?php $item5="grau"; ?>
			<a href="/adicionar/<?php echo htmlspecialchars( $item5, ENT_COMPAT, 'UTF-8', FALSE ); ?>" ><span data-bs-toggle="tooltip" title="Editar grau"><i class="fas fa-edit fs-2" ></i></span></a>		
			<select class="form-select fs-4" id="grau" name="grau" required="">
			    <option selected ><?php echo htmlspecialchars( $reagente["grau"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			    <?php $counter1=-1;  if( isset($lista["6"]) && ( is_array($lista["6"]) || $lista["6"] instanceof Traversable ) && sizeof($lista["6"]) ) foreach( $lista["6"] as $key1 => $value1 ){ $counter1++; ?>
			    <option><?php echo htmlspecialchars( $value1["grau"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			    <?php } ?>	
			</select>				    
	</div>



	<div class="col-md-2">
		<label for="marca" class="form-label">Marca </label>
		<?php $item1="marca"; ?>
		<a href="/adicionar/<?php echo htmlspecialchars( $item1, ENT_COMPAT, 'UTF-8', FALSE ); ?>" ><span data-bs-toggle="tooltip" title="Editar marca"><i class="fas fa-edit fs-2" ></i></span></a>				
		<select class="form-select fs-4" id="marca" name="marca" required>
			<option selected><?php echo htmlspecialchars( $reagente["marca"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			<?php $counter1=-1;  if( isset($lista["1"]) && ( is_array($lista["1"]) || $lista["1"] instanceof Traversable ) && sizeof($lista["1"]) ) foreach( $lista["1"] as $key1 => $value1 ){ $counter1++; ?>
			<option><?php echo htmlspecialchars( $value1["marca"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			<?php } ?>	
		</select>				    
	</div>
	
	<div class="col-md-2">
			<label for="massa" class="form-label">Volume/Massa</label>
			<input type="number" class="form-control fs-4" id="medida" name="volume_massa" value="<?php echo htmlspecialchars( $reagente["volume_massa"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" step ="25" required>
		</div>


		<div class="col-md-2">
			<label for="marca" class="form-label">Unidade</label>		
			<select class="form-select fs-4" id="unidade" name="unidade" required="">
			    <option selected><?php echo htmlspecialchars( $reagente["unidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			    <?php $counter1=-1;  if( isset($lista["5"]) && ( is_array($lista["5"]) || $lista["5"] instanceof Traversable ) && sizeof($lista["5"]) ) foreach( $lista["5"] as $key1 => $value1 ){ $counter1++; ?>
			    <option><?php echo htmlspecialchars( $value1["unidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			    <?php } ?>	
			</select>				    
	</div>

	<div class="col-md-1">
		<label for="quantidade" class="form-label">Quantidade</label>
		<input type="number" class="form-control fs-4" id="quantidade" min="0" max="200" step="1" name="quantidade" value="<?php echo htmlspecialchars( $reagente["quantidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
	</div>
		
	<div class="col-md-2">
		<label for="compra" class="form-label">Compra/registro</label>
		<input type="date" class="form-control fs-4" id="registro" name="registro" value="<?php echo htmlspecialchars( $reagente["registro"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
	</div>
	
	<div class="col-md-2">
		<label for="validade" class="form-label">Validade</label>
		<input type="date" class="form-control fs-4" id="validade" name="validade" value="<?php echo htmlspecialchars( $reagente["validade"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
	</div>	

	<div class="col-md-3">
		<?php $item2="laboratorio"; ?>
		<label for="lab" class="form-label">Laboratório</label>
		<?php if( $info["tipo"] == '0' ){ ?>
		<a href="/adicionar/<?php echo htmlspecialchars( $item2, ENT_COMPAT, 'UTF-8', FALSE ); ?>" ><span data-bs-toggle="tooltip" title="Editar laboratório"><i class="fas fa-edit fs-2" ></i></span></a>
		<?php } ?>		    
		<select class="form-select fs-4" id="lab" name="laboratorio">
			<option selected><?php echo htmlspecialchars( $reagente["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			<?php $counter1=-1;  if( isset($lista["2"]) && ( is_array($lista["2"]) || $lista["2"] instanceof Traversable ) && sizeof($lista["2"]) ) foreach( $lista["2"] as $key1 => $value1 ){ $counter1++; ?>
			<?php if( $value1["laboratorio"] == $info["laboratorio"] or $info["tipo"] == '0' ){ ?>
			<option><?php echo htmlspecialchars( $value1["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			<?php } ?>
			<?php } ?>	
		</select>
	</div>
	
	<div class="col-md-4">
		<?php $item4="localizacao"; ?>
		<label for="lab" class="form-label">Localização</label>
		<a href="/adicionar/<?php echo htmlspecialchars( $item4, ENT_COMPAT, 'UTF-8', FALSE ); ?>" ><span data-bs-toggle="tooltip" title="Editar localização"><i class="fas fa-edit fs-2" ></i></span></a>
		<select class="form-select fs-4" id="loc" name="localizacao" required="">
			<option selected><?php echo htmlspecialchars( $reagente["localizacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			<?php $counter1=-1;  if( isset($lista["4"]) && ( is_array($lista["4"]) || $lista["4"] instanceof Traversable ) && sizeof($lista["4"]) ) foreach( $lista["4"] as $key1 => $value1 ){ $counter1++; ?>
			<option><?php echo htmlspecialchars( $value1["localizacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			<?php } ?>	
		</select>
	</div>	
	
	<div class="col-md-4">
		<?php $item3="responsavel"; ?>
		<label for="resp" class="form-label">Responsável</label>
		<a href="/adicionar/<?php echo htmlspecialchars( $item3, ENT_COMPAT, 'UTF-8', FALSE ); ?>"><span data-bs-toggle="tooltip" title="Editar responsável"><i class="fas fa-edit fs-2" ></i></span></a>
		<select class="form-select fs-4" id="resp" name="responsavel" required="">
			<option selected><?php echo htmlspecialchars( $reagente["responsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			<?php $counter1=-1;  if( isset($lista["3"]) && ( is_array($lista["3"]) || $lista["3"] instanceof Traversable ) && sizeof($lista["3"]) ) foreach( $lista["3"] as $key1 => $value1 ){ $counter1++; ?>
			<option><?php echo htmlspecialchars( $value1["responsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			<?php } ?>	
		</select>				   
	</div>

	<div class="col-md-7">
	    <label for="observacoes" class="form-label">Observações (opcional)</label>
	    <input type="text" class="form-control fs-3" maxlength="45" id="observacoes" name="observacoes" value="<?php echo htmlspecialchars( $reagente["observacoes"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
    </div>

	
	<div class="col-12">
		<button class="btn btn-primary fs-4" type="submit"><i class="far fa-save"></i> Salvar</button>
	</div>

	</form>

	<div class="fs-3 mt-4"><a class="col-1 btn btn-dark fs-4" href="/consulta/voltar" role="button">Voltar</a></div>
</div>