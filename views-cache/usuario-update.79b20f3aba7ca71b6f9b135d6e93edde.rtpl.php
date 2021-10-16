<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="tab-pane" style="padding: 5px 5px 5px 5px">
	<section class="content-header mb-2" >
		<h1><i class="fas fa-user" style="color: black"></i> Usuário</h1>
	</section>	
	<div id="form">
		
		<form class="row g-3 fs-3 p-4" action="/usuarios/<?php echo htmlspecialchars( $user["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
			<legend class="fs-3"><i class="far fa-user"></i> Identificação do usuário</legend>
		  
		    <label for="pnome" class="form-label">Nome</label>
		    <input type="text" class="form-control fs-3 m-0" id="pnome" name="nome" value="<?php echo htmlspecialchars( $user["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
		  	  
		    <label for="sobrenome" class="form-label">Sobrenome</label>
		    <input type="text" class="form-control fs-3 m-0" id="sobrenome" name="sobrenome" value="<?php echo htmlspecialchars( $user["sobrenome"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
		  
		  
		    <label for="email" class="form-label">Email</label>
		    <input type="email" class="form-control fs-3 m-0" id="email" name="email" value="<?php echo htmlspecialchars( $user["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" required>
		    
		    <div>
		    <input class="form-check-input" type="checkbox" name="tipo" value="1" id="admCheck" <?php if( $user["tipo"] != 2 ){ ?>checked<?php } ?>>
		    <label class="form-check-label fs-4" for="admCheck">Acesso de administrador</label>
			</div>
			
		  <legend class="fs-3"><i class="fas fa-link"></i> Vínculo</legend>
		  <div class="col-md-5">
		    <label for="presponsavel" class="form-label">Professor Responsável</label>
		    <select class="form-select fs-3" id="presponsavel" name="responsavel" required>
		      <option selected><?php echo htmlspecialchars( $user["responsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
	    	  <?php $counter1=-1;  if( isset($lists["1"]) && ( is_array($lists["1"]) || $lists["1"] instanceof Traversable ) && sizeof($lists["1"]) ) foreach( $lists["1"] as $key1 => $value1 ){ $counter1++; ?>
	    	  <option><?php echo htmlspecialchars( $value1["responsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
	    	  <?php } ?>	
		    </select>
		  </div>
		  <div class="col-md-5">
		    <label for="lab" class="form-label">Laboratório</label>
		    <select class="form-select fs-3" id="lab" name="laboratorio" required>
		      <option selected><?php echo htmlspecialchars( $user["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
	    	  <?php $counter1=-1;  if( isset($lists["0"]) && ( is_array($lists["0"]) || $lists["0"] instanceof Traversable ) && sizeof($lists["0"]) ) foreach( $lists["0"] as $key1 => $value1 ){ $counter1++; ?>
	    	  <?php if( $value1["laboratorio"] == $info["laboratorio"] or $info["tipo"] == '0' ){ ?>
	    	  <option><?php echo htmlspecialchars( $value1["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
	    	  <?php } ?>
	    	  <?php } ?>	
		    </select>
		  </div>
		  <div class="col-12 fs-3 mt-5">
		    <button class="btn btn-primary fs-3" type="submit">Salvar</button>
		    <a class="btn btn-dark fs-3 mx-2" href="/usuarios">Cancelar</a>
		  </div>
		</form>	
	</div>
</div>



