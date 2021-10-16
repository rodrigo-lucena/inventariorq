<?php if(!class_exists('Rain\Tpl')){exit;}?>	
				<div class="content-wrapper" id="consulta" style="padding: 5px 2px 5px 5px">
				
					<section class="content-header">
					  <h1><i class="fas fa-clipboard-list" style="color: black"></i> 
					    Lista de Reagentes
					  </h1>

					</section>
					<!-- início de busca -->
					<section class="content">
					  <div class="row">
					  	<div class="col-md-12">
					  		<div class="box box-primary">
					            <form action="/consulta" method="post" id="form1">
						            <div class="row" style="padding: 3px 3px 0px 3px">
									  <div class="mb-3 fs-4 col-6" >
									    <label for="Reag" class="form-label">Reagente</label>
		   								<input type="text" class="form-control fs-5" id="Reag" placeholder="Nome ou parte do nome do reagente" name="Reagente">
									  </div>
									  <div class="mb-3 fs-4 col-6">
									    <label for="Resp" class="form-label">Responsável</label>
		   								<input type="text" class="form-control fs-5" id="Resp" placeholder="Nome ou parte do nome do responsável" name="Responsavel">
									  </div>
									</div>
								 
								  <div class="mb-3 mx-0 row fs-4 no-padding">
									  	<div class="col-1 no-padding"><label for="form-check-input" class="form-label">Base:</label></div>
									  	<div class="col-3 no-padding mx-0 no-padding border-0">
										  	
										  	<div class="form-check col-6 no-padding border-0">
											    <input class="form-check-input" type="radio" name="radioB" id="CheckLacite" value="<?php echo htmlspecialchars( $info["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" 
											    <?php if( $busca["2"]!='' ){ ?>checked<?php } ?> >
											    <label class="m-0 form-check-label border-0" for="CheckLacite"><?php echo htmlspecialchars( $info["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
											</div>
											<div class="mx-0 form-check col-6 no-padding border-0">
											    <input class="form-check-input" type="radio" name="radioB" id="CheckToda" value=""
											    <?php if( $busca["2"]=='' ){ ?>checked<?php } ?>>
											    <label class="form-check-label" for="CheckToda">Toda</label>
											</div>
										</div>

										<div class="col-1"><label for="form-check-input" class="form-label">Validade:</label></div>
										<div class="col-3">	
											<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioV" id="CheckInd" value="" <?php if( $busca["4"]=='' ){ ?>checked<?php } ?>>
											    <label class="form-check-label" for="CheckInd" >Indiferente</label>
											</div>
										  	<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioV" id="CheckVenc" value=" AND r.validade < curdate()"
											    <?php if( $busca["4"]==' AND r.validade < curdate()' ){ ?>checked<?php } ?>>
											    <label class="form-check-label" for="CheckVenc">Vencidos</label>
											</div>
											<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioV" id="CheckVal" value=" AND r.validade > curdate()"
											    <?php if( $busca["4"]==' AND r.validade > curdate()' ){ ?>checked<?php } ?>
											    >
											    <label class="form-check-label" for="CheckVal">Válidos</label>
											</div>
										</div>
										<div class="col-1"><label for="form-check-input" class="form-label">Controle:</label></div>
										<div class="col-2">
											<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioC" id="CheckTod" value=">= 1" <?php if( $busca["3"]=='>= 1' ){ ?>checked<?php } ?>>
											    <label class="form-check-label" for="CheckTod" >Todos</label>
											</div>
										  	<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioC" id="CheckContr" value="> 1" <?php if( $busca["3"]=='> 1' ){ ?>checked<?php } ?>>
											    <label class="form-check-label" for="CheckContr">Controlados</label>
											</div>
											<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioC" id="CheckNao" value="= 1" <?php if( $busca["3"]=='= 1' ){ ?>checked<?php } ?>>
											    <label class="form-check-label" for="CheckNao">Não controlados</label>
											</div>
										</div>
								  </div>
								  <button type="submit" class="btn btn-primary fs-4" name="Buscar"><i class="fas fa-search"></i> Buscar</button>
								</form>
								<!-- fim de busca -->
								
					            <div class="box-body px-1 m-3" style="overflow: auto; height: 50vh">
					              <form action="/consulta" method="post" id="form3"> 
					              <table class="table table-striped fs-4" >
					                <thead>
					                  <tr style="text-align: left">
					                  	<th ></th>
					                    <th >Reagente</th>
					                    <th >Fórmula</th>
					                    <th >Marca</th>
					                    <th >Vol/Massa</th>
					                    <th >Qtd</th>
					                    <th >Validade</th>
					                    <th >Controle</th>
					                    <th >Laboratório</th>
					                    <th >Localização</th>
					                    <th style="width: 40px">Responsável</th>
					                    <th >&nbsp;</th>
					                  </tr>
					                </thead>					                
					                <tbody >
					                	 
					                  <?php $counter1=-1;  if( isset($reagents) && ( is_array($reagents) || $reagents instanceof Traversable ) && sizeof($reagents) ) foreach( $reagents as $key1 => $value1 ){ $counter1++; ?>
					                  
					                  <tr style="text-align: left" >
					                  	<th >
					                  		<?php if( $value1["laboratorio"] == $info["laboratorio"] && $info["tipo"] != '2' or $info["tipo"] == '0' ){ ?>
					                  		<input type="checkbox" name="<?php echo htmlspecialchars( $value1["idreagente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
					                  		<?php } ?>
					                  	</th>
					                    <td ><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					                    <td><?php echo htmlspecialchars( $value1["formula"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					                    <td><?php echo htmlspecialchars( $value1["marca"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					                    <td><?php echo htmlspecialchars( $value1["volume_massa"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					                    <td><?php echo htmlspecialchars( $value1["quantidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					                    <td><?php echo htmlspecialchars( $value1["validade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					                    <td><?php echo htmlspecialchars( $value1["controle"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					                    <td><?php echo htmlspecialchars( $value1["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
					                    <td><?php echo htmlspecialchars( $value1["localizacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
					                    <td><?php echo htmlspecialchars( $value1["responsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
					                    <td style="text-align: right">
					                    <?php if( $value1["laboratorio"] == $info["laboratorio"] && $info["tipo"] != '2' or $info["tipo"] == '0' ){ ?>
					                      <a href="/consulta/<?php echo htmlspecialchars( $value1["idreagente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
					                      <a href="/consulta/<?php echo htmlspecialchars( $value1["idreagente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
					                      <?php } ?>
					                    </td>
					                  </tr>

					                  <?php } ?>

					                   
					              	  	
					          	  	




					                </tbody>
					                
					              </table>
					              <div class="content-wrapper" id="consulta" style="padding: 5px 2px 5px 5px">
					              	<button type="submit" class="btn btn-danger fs-4" name="Excluir"><i class="fa fa-trash"></i>Excluir seleção</button>
					          	  
					          	  </div>
					          	  </form>

					          	  <div class="content-wrapper" id="consulta" style="padding: 5px 2px 5px 5px">
					              <form action="/consulta" method="post" id="form2">
					              	<button type="submit" class="btn btn-dark fs-4" name="Exportar"><i class="fas fa-file-export"></i> Exportar resultado</button>
					          	  </form>
					          	  </div>
					            </div>					        
					  	</div>
					  </div>
					</section>
					
				</div>		    
			<!-- fim de Consulta-->