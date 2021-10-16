<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="tab-pane" style="padding: 5px 5px 5px 5px">
	<?php if( $info["tipo"] != '2' ){ ?>
    <section class="content-header" >
		<h1><i class="far fa-bell" style="color: black"></i> Solicitações de acesso</h1>
	</section>
	<section class="content">
		<div class="box-body no-padding m-3" style="overflow: auto; height: 70vh">
          	<table class="table table-striped fs-4">
            	<thead>
              		<tr style="text-align: left">
                		<th >Nome</th>
		                <th >Sobrenome</th>
		                <th >Email</th>
		                <th >Laboratorio</th>
		                <th >Vínculo</th>
		                <th style="width: 40px">Conta</th>
		                <th >&nbsp;</th>
              		</tr>
            	</thead>
            	<tbody>
            		<?php $counter1=-1;  if( isset($usuarios) && ( is_array($usuarios) || $usuarios instanceof Traversable ) && sizeof($usuarios) ) foreach( $usuarios as $key1 => $value1 ){ $counter1++; ?>
              		<tr style="text-align: left">
		                <td ><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
		                <td><?php echo htmlspecialchars( $value1["sobrenome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
		                <td><?php echo htmlspecialchars( $value1["email"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
		                <td><?php echo htmlspecialchars( $value1["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
		                <td><?php echo htmlspecialchars( $value1["responsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
		                <td><?php if( $value1["tipo"] == 0 ){ ?>Administrador<?php }else{ ?>Usuário<?php } ?></td>
		                <td style="text-align: right">
                  		<a href="/solicita/<?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/aceito" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Aceitar</a>
                  		<a href="/solicita/<?php echo htmlspecialchars( $value1["idusuario"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este usuário?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
                		</td>
              		</tr>
              		<?php } ?>  
            	</tbody>
          	</table>
		</div>
	</session>
	<?php } ?>				        
</div>