<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="tab-pane" style="padding: 5px 5px 5px 5px">
	<?php if( $info["tipo"] != '2' ){ ?>
	<section class="content-header" >
		<h1><i class="far fa-plus-square mb-3" style="color: black"></i> Entrada de reagentes</h1>
	</section>
	<section class="content-header mt-4">
		<h2><i class="fas fas fa-wine-bottle" style="color: black"></i> Entrada individual:</h1>
	</section>
	<form class="row g-3 fs-4" action="/adicionar" method="post" style="padding: 1px 10px 10px 10px">
		<div class="col-md-5">
			<label for="nomeR" class="form-label">Nome</label>
				<input type="text" class="form-control fs-4" id="nomeR" name="nome" required>
		</div>
		<div class="col-md-3">
			<label for="formula" class="form-label">Fórmula</label>
				<input type="text" class="form-control fs-4" id="formula" name="formula" >
		</div>
		<div class="col-md-4">
			<label for="marca" class="form-label">Marca </label>
			<?php $item1="marca"; ?>
			<a href="/adicionar/<?php echo htmlspecialchars( $item1, ENT_COMPAT, 'UTF-8', FALSE ); ?>" ><span data-bs-toggle="tooltip" title="Editar marca"><i class="fas fa-edit fs-2" ></i></span></a>		
			<select class="form-select fs-4" id="marca" name="marca" required="">
			    <option selected disabled value="">Escolha...</option>
			    <?php $counter1=-1;  if( isset($lists["0"]) && ( is_array($lists["0"]) || $lists["0"] instanceof Traversable ) && sizeof($lists["0"]) ) foreach( $lists["0"] as $key1 => $value1 ){ $counter1++; ?>
			    <option><?php echo htmlspecialchars( $value1["marca"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
			    <?php } ?>	
			</select>				    
		</div>
		<div class="col-md-3">
			<input class="form-check-input" type="radio" name="unidade" value=" mL" id="volume" checked="">
			<label for="volume" class="form-check-label">Volume(mL)</label>
			<input class="form-check-input" type="radio" name="unidade" value=" g" id="massa" >
			<label for="massa" class="form-label">Massa(g)</label>
			<input type="number" class="form-control fs-4" id="medida" name="volume_massa" value="1000" step ="25" required>
		</div>
		<div class="col-md-2">
			<label for="quantidade" class="form-label">Quantidade</label>
			<input type="number" class="form-control fs-4" id="quantidade" min="0" max="200" step="1" name="quantidade" value="1" required>
		</div>
		<div class="col-md-2">
			<label for="validade" class="form-label">Validade</label>
			<input type="date" class="form-control fs-4" id="validade" name="validade"  required>
		</div>
		<div class="col-md-5">
			<label for="controle" class="form-label">Controle</label>
			<select class="form-select fs-4" id="controle" name="controle" required="">
				<option selected disabled value="">Escolha...</option>
				<?php $counter1=-1;  if( isset($lists["1"]) && ( is_array($lists["1"]) || $lists["1"] instanceof Traversable ) && sizeof($lists["1"]) ) foreach( $lists["1"] as $key1 => $value1 ){ $counter1++; ?>
				<option><?php echo htmlspecialchars( $value1["controle"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
				<?php } ?>	    		
			</select>
		</div>
		<div class="col-md-3">
			<label for="compra" class="form-label">Data de compra/registro</label>
			<input type="date" class="form-control fs-4" id="compra" name="compra" value="<?php echo htmlspecialchars( $data, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
		</div>
		<div class="col-md-4">
			<?php $item2="laboratorio"; ?>
			<label for="lab" class="form-label">Laboratório</label>
			<?php if( $info["tipo"] == '0' ){ ?>
			<a href="/adicionar/<?php echo htmlspecialchars( $item2, ENT_COMPAT, 'UTF-8', FALSE ); ?>" ><span data-bs-toggle="tooltip" title="Editar laboratório"><i class="fas fa-edit fs-2" ></i></span></a>
			<?php } ?>
			<select class="form-select fs-4" id="lab" name="laboratorio">
				
				<?php $counter1=-1;  if( isset($lists["2"]) && ( is_array($lists["2"]) || $lists["2"] instanceof Traversable ) && sizeof($lists["2"]) ) foreach( $lists["2"] as $key1 => $value1 ){ $counter1++; ?>
				<?php if( $value1["laboratorio"] == $info["laboratorio"] or $info["tipo"] == '0' ){ ?>
				<option selected><?php echo htmlspecialchars( $value1["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
				<?php } ?>
				<?php } ?>	
			</select>
		</div>

	  	<div class="col-md-5">
	  		<?php $item4="localizacao"; ?>
	    	<label for="lab" class="form-label">Localização</label>
	    	<a href="/adicionar/<?php echo htmlspecialchars( $item4, ENT_COMPAT, 'UTF-8', FALSE ); ?>" ><span data-bs-toggle="tooltip" title="Editar localização"><i class="fas fa-edit fs-2" ></i></span></a>
	    	<select class="form-select fs-4" id="loc" name="localizacao" required="">
	    		<option selected disabled value="">Escolha...</option>
	    		<?php $counter1=-1;  if( isset($lists["4"]) && ( is_array($lists["4"]) || $lists["4"] instanceof Traversable ) && sizeof($lists["4"]) ) foreach( $lists["4"] as $key1 => $value1 ){ $counter1++; ?>
	    		<option><?php echo htmlspecialchars( $value1["localizacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
	    		<?php } ?>	
	    	</select>
	  	</div>			  

		<div class="col-md-5">
			<?php $item3="responsavel"; ?>
			<label for="resp" class="form-label">Responsável </label>
			<a href="/adicionar/<?php echo htmlspecialchars( $item3, ENT_COMPAT, 'UTF-8', FALSE ); ?>" ><span data-bs-toggle="tooltip" title="Editar responsável"><i class="fas fa-edit fs-2" ></i></span></a>
			<select class="form-select fs-4" id="resp" name="responsavel" required="">
				<option selected disabled value="">Escolha...</option>
				<?php $counter1=-1;  if( isset($lists["3"]) && ( is_array($lists["3"]) || $lists["3"] instanceof Traversable ) && sizeof($lists["3"]) ) foreach( $lists["3"] as $key1 => $value1 ){ $counter1++; ?>
				<option><?php echo htmlspecialchars( $value1["responsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
				<?php } ?>	
			</select>				   
		</div>
		<div class="col-12">
			<button class="btn btn-primary fs-4" type="submit" name="Salvar"><i class="far fa-save" ></i> Salvar</button>
		</div>
	</form>

	<section class="content-header mt-5" >
		<h2><i class="fas fas fa-file-csv" style="color: black"></i> Importar lista:</h1>
		<?php if( $error != '' ){ ?>
		<div class="alert alert-danger fs-3" style="text-align: center">
			<?php echo htmlspecialchars( $error, ENT_COMPAT, 'UTF-8', FALSE ); ?>
		</div>
		<?php } ?>
	</section>				
  	<form class="mt-3" action="/adicionar" method="post" enctype="multipart/form-data">		
		<div class="col-md-12">
			<input class="fs-4 mb-3" type="file" name="Lista" id="Lista" accept=".csv" required>
			<button type="submit" class="btn btn-primary fs-4" name="Importar"><i class="fas fa-file-import"></i> Enviar arquivo </button>
		</div>  
	</form>

	<section class="content-header mt-3" >
		<h2><i class="fa fa-trash mt-5" style="color: black"></i> Excluir todos os registros de reagentes do laboratório:</h1>
	</section>				
  	<form class="mt-3" action="/adicionar" method="post" enctype="multipart/form-data">		
		<div class="col-md-12">
			<button type="submit" class="btn btn-danger fs-4" name="Excluir" onclick="return confirm('Deseja realmente excluir toda a lista de reagentes de seu laboratório?')"><i class="far fa-trash-alt"></i> Excluir reagentes</button>
		</div>  
	</form>							
	<?php } ?>			
</div>