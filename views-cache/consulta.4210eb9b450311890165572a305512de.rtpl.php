<?php if(!class_exists('Rain\Tpl')){exit;}?>	
				<div class="content-wrapper" id="consulta" style="padding: 5px 2px 5px 5px">
				
					<section class="content-header">
					  <h1><i class="fas fa-clipboard-list" style="color: black"></i> 
					    Lista de Reagentes
					  </h1>

					</section>
					<!-- início de busca -->

					<section class="content">
						<form action="/consulta" method="post" id="form1">			            	
			            	<div class="row" style="padding: 3px 3px 0px 3px">
						  		<div class="mb-3 fs-4 col-3" >
						    		<label for="Reag" class="form-label">Reagente:</label>
									<input type="text" class="form-control fs-5" id="Reag" placeholder="Nome ou parte do nome do reagente" name="reagente">
									<label for="Resp" class="form-label mt-4">Responsável:</label>
									<input type="text" class="form-control fs-5" id="Resp" placeholder="Nome ou parte do nome do responsável" name="responsavel">
						  		</div>
						  		<div class="mb-3 fs-4 col-3">
						    		<label for="form-check-input" class="form-label">Base:</label>								  	
							  		<div>
								    	<input class="form-check-input" type="radio" name="laboratorio" id="CheckLacite" value="<?php echo htmlspecialchars( $info["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" 
								    	<?php if( $busca['laboratorio']!='' ){ ?>checked<?php } ?> >
								    	<label class="m-0 form-check-label border-0" for="CheckLacite"><?php echo htmlspecialchars( $info["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
									</div>
									<div>
								    	<input class="form-check-input" type="radio" name="laboratorio" id="CheckToda" value=""
								    	<?php if( $busca['laboratorio']=='' ){ ?>checked<?php } ?>>
								    	<label class="form-check-label" for="CheckToda">Toda</label>
									</div>									
									<div class="mt-3">
										<label for="controle" class="form-label" data-bs-toggle="tooltip" data-bs-placement="top" title="PC = Polícia Civil; PF = Polícia Federal; EB = Exército Brasileiro">Controle: (?)</label>
									</div>
									<div>
										<select class="form-select fs-4 col-2" id="controle" name="controle">
								    	<option selected value="">Todos</option>
								    	<?php $counter1=-1;  if( isset($controle) && ( is_array($controle) || $controle instanceof Traversable ) && sizeof($controle) ) foreach( $controle as $key1 => $value1 ){ $counter1++; ?>
								    	<option><?php echo htmlspecialchars( $value1["controle"], ENT_COMPAT, 'UTF-8', FALSE ); ?></option>
								    	<?php } ?>	
										</select>				    
									</div>
								</div>
								<div class="mb-3 fs-4 col-2">
									<label for="form-check-input" class="form-label">Validade:</label>
									<div>
								    	<input class="form-check-input" type="radio" name="validade" id="CheckInd" value="" <?php if( $busca['validade']=='' ){ ?>checked<?php } ?>>
								    	<label class="form-check-label" for="CheckInd" >Indiferente</label>
									</div>
									<div>
								    	<input class="form-check-input" type="radio" name="validade" id="CheckVenc" value=" AND r.validade < curdate()"
								    	<?php if( $busca['validade']==' AND r.validade < curdate()' ){ ?>checked<?php } ?>>
								    	<label class="form-check-label" for="CheckVenc">Vencidos</label>
									</div>
									<div>
								    	<input class="form-check-input" type="radio" name="validade" id="CheckVal" value=" AND r.validade > curdate()"
								    	<?php if( $busca['validade']==' AND r.validade > curdate()' ){ ?>checked<?php } ?>
								    	>
								    	<label class="form-check-label" for="CheckVal">Válidos</label>
									</div>
								</div>
								<div class="mb-3 fs-4 col-2">
									<label for="Reag" class="form-label">Adicionar na busca:</label>		   												  		
								  	<div>
								  		<input type="checkbox" name="cformula" value="1" <?php if( $busca['cformula']=='1' ){ ?> checked <?php } ?>>
										<label class="form-label">Fórmula</label>	
		   							</div>
		   							<div>
		   								<input type="checkbox" name="ccas" value="1" <?php if( $busca['ccas']=='1' ){ ?> checked <?php } ?>>
										<label class="form-label">CAS</label>		
		   							</div>						  
								  	<div>
								  		<input type="checkbox" name="ccontrole" value='1' <?php if( $busca['ccontrole']=='1' ){ ?> checked <?php } ?>>
										<label class="form-label" data-bs-toggle="tooltip" data-bs-placement="top" title="PC = Polícia Civil; PF = Polícia Federal; EB = Exército Brasileiro">Controle (?)</label>
		   							</div>
		   						</div>
		   						<div class="mb-3 fs-4 col-2">
		   							<div>
		   								<input type="checkbox" name="cregistro" value='1' <?php if( $busca['cregistro']=='1' ){ ?> checked <?php } ?>>
										<label class="form-label">Registro</label>	
	   								</div>
						  
								  	<div>
								  		<input type="checkbox" name="clocalizacao" value='1' <?php if( $busca['clocalizacao']=='1' ){ ?> checked <?php } ?>>
										<label class="form-label">Localização</label>			   							
		   							</div>
								  	<div>
								  		<input type="checkbox" name="cresponsavel" value='1' <?php if( $busca['cresponsavel']=='1' ){ ?> checked <?php } ?>>
										<label class="form-label">Responsável</label>	
		   							</div>
		   							<div>
		   								<input type="checkbox" name="cobservacoes" value='1' <?php if( $busca['cobservacoes']=='1' ){ ?> checked <?php } ?>>
										<label class="form-label">Observações</label>	
		   							</div>
		   						</div>
								
						  		</div>
							</div>
						  	<div style="padding: 5px 2px 5px 18px">
						  		<button type="submit" class="btn btn-primary fs-4" name="Buscar"><i class="fas fa-search" ></i> Buscar</button>
						  	</div>
						</form>

						<!-- fim de busca -->
								
					    <div class="box-body px-1 m-3" style="overflow: auto; height: 50vh">
					        <form action="/consulta" method="post" id="form3"> 			
					            <table class="table table-striped fs-4" >
					                <thead>					                	
					                  	<tr style="text-align: left">
						                  	<th ></th>					                  	
						                    <th >Reagente</th>						             		
						             		<?php if( $busca['cformula']=='1' ){ ?><th >Fórmula</th><?php } ?>
						             		<?php if( $busca['ccas']=='1' ){ ?><th >CAS</th><?php } ?>
						                    <?php if( $busca['ccontrole']=='1' ){ ?><th >Controle</th><?php } ?>
						                    <th >Marca</th>
						                    <th >Vol/Massa</th>
						                    <th >Qtd</th>
						                    <?php if( $busca['cregistro']=='1' ){ ?><th >Registro</th><?php } ?>
						                    <th  >Validade</th>					                    
						                    <th >Laboratório</th>
						                    <?php if( $busca['clocalizacao']=='1' ){ ?><th >Localização</th><?php } ?>
						                    <?php if( $busca['cresponsavel']=='1' ){ ?><th >Responsável</th><?php } ?>
						                    <?php if( $busca['cobservacoes']=='1' ){ ?><th >Observações</th><?php } ?>
						                    <th >&nbsp;</th>
					                  	</tr>
					                </thead>					                
					                <tbody >					                	 
					                  	<?php $counter1=-1;  if( isset($reagentes) && ( is_array($reagentes) || $reagentes instanceof Traversable ) && sizeof($reagentes) ) foreach( $reagentes as $key1 => $value1 ){ $counter1++; ?>
					                  	<tr style="text-align: left" >
					                  		<td >
					                  			<?php if( $value1["laboratorio"] == $info["laboratorio"] && $info["tipo"] != '2' or $info["tipo"] == '0' ){ ?>
					                  			<input type="checkbox" name="<?php echo htmlspecialchars( $value1["idreagente"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
					                  			<?php } ?>
					                  		</td>
						                    <td ><?php echo htmlspecialchars( $value1["nome"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["grau"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
						                  	<?php if( $busca['cformula']=='1' ){ ?><td ><?php echo htmlspecialchars( $value1["formula"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td><?php } ?>
						                  	<?php if( $busca['ccontrole']=='1' ){ ?><td><?php echo htmlspecialchars( $value1["controle"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td><?php } ?>						                    
						                  	<?php if( $busca['ccas']=='1' ){ ?><td><?php echo htmlspecialchars( $value1["cas"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/><?php } ?>
						                    <td><?php echo htmlspecialchars( $value1["marca"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
						                    <td><?php echo htmlspecialchars( $value1["volume_massa"], ENT_COMPAT, 'UTF-8', FALSE ); ?> <?php echo htmlspecialchars( $value1["unidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
						                    <td><?php echo htmlspecialchars( $value1["quantidade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
						                    <?php if( $busca['cregistro']=='1' ){ ?><td><?php echo htmlspecialchars( $value1["registro"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td><?php } ?>	   
						                    <td  <?php if( $value1["validade"] < $data ){ ?> style= "color: rgba(255,0,0,1)"<?php } ?>
						                    ><?php echo htmlspecialchars( $value1["validade"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>				                    
						                    <td><?php echo htmlspecialchars( $value1["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/>
						                    <?php if( $busca['clocalizacao']=='1' ){ ?><td><?php echo htmlspecialchars( $value1["localizacao"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td/><?php } ?>
						                    <?php if( $busca['cresponsavel']=='1' ){ ?><td><?php echo htmlspecialchars( $value1["responsavel"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td><?php } ?>
						                    <?php if( $busca['cobservacoes']=='1' ){ ?><td><?php echo htmlspecialchars( $value1["observacoes"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td><?php } ?>
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
					            <?php if( $info["tipo"] != '2' ){ ?>					              
					            <div class="content-wrapper" id="consulta" style="padding: 5px 2px 5px 5px">
					            	<button type="submit" class="btn btn-danger fs-4" name="Excluir"><i class="fa fa-trash"></i>Excluir seleção</button>
					          	</div>
					          	<?php } ?>
					    	</form>
					        <div class="content-wrapper" id="consulta" style="padding: 5px 2px 5px 5px">
					            <form action="/consulta" method="post" id="form2">
					            	<button type="submit" class="btn btn-dark fs-4" name="Exportar"><i class="fas fa-file-export"></i> Exportar resultado</button>
					          	</form>
					        </div>
					    </div>					        

					</section>					
				</div>	
			<!-- fim de Consulta-->