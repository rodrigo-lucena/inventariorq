<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="tab-pane" style="padding: 5px 5px 5px 5px">
	<section class="content-header mb-2" >
		<h1><i class="fas fa-user" style="color: black"></i> Usuário</h1>
	</section>

	
	<div id="form">
		
		<form class="row g-3 fs-3 p-4">
			<legend class="fs-3"><i class="far fa-user"></i> Identificação do usuário</legend>
		  
		    <label for="pnome" class="form-label">Nome</label>
		    <input type="text" class="form-control fs-3 m-0" id="pnome" required>
		  
		  
		    <label for="sobrenome" class="form-label">Sobrenome</label>
		    <input type="text" class="form-control fs-3 m-0" id="sobrenome" required>
		  
		  
		    <label for="email" class="form-label">Email</label>
		    <input type="email" class="form-control fs-3 m-0" id="email" required>
		    <div>
		    <input class="form-check-input" type="checkbox" value="" id="admCheck">
		    <label class="form-check-label fs-4" for="admCheck">Acesso de administrador</label>
			</div>

		  
		  <legend class="fs-3"><i class="fas fa-link"></i> Vínculo</legend>
		  <div class="col-md-5">
		    <label for="presponsavel" class="form-label">Professor Responsável</label>
		    <select class="form-select fs-3" id="presponsavel" required>
		      <option selected disabled value="">Escolha...</option>
		      <option>João Vicente</option>
		      <option>Pedro Silva</option>
		    </select>
		  </div>
		  <div class="col-md-5">
		    <label for="lab" class="form-label">Laboratório</label>
		    <select class="form-select fs-3" id="lab" required>
		      <option selected disabled value="">Escolha...</option>
		      <option>Ciências da Terra</option>
		      <option>Química</option>
		    </select>
		  </div>
		  <div class="col-12 fs-3 mt-5">
		    <button class="btn btn-primary fs-3" type="submit">Salvar</button>
		    <a class="btn btn-dark fs-3 mx-2" href="/usuarios">Cancelar</a>
		  </div>
		</form>	
	</div>
</div>



