<?php if(!class_exists('Rain\Tpl')){exit;}?>			
				<div class="content-wrapper" style="padding: 5px 2px 5px 5px">
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
					            
					            <form>
						            <div class="row" style="padding: 3px 3px 0px 3px">
									  <div class="mb-3 fs-4 col-6" >
									    <label for="Reag" class="form-label">Reagente</label>
		   								<input type="text" class="form-control fs-5" id="Reag" placeholder="Nome ou parte do nome do reagente">
									  </div>
									  <div class="mb-3 fs-4 col-6">
									    <label for="Resp" class="form-label">Responsável</label>
		   								<input type="text" class="form-control fs-5" id="Resp" placeholder="Nome ou parte do nome do responsável">
									  </div>
									</div>
								 
								  <div class="mb-3 mx-0 row fs-4 no-padding">
									  	<div class="col-1 no-padding"><label for="form-check-input" class="form-label">Base:</label></div>
									  	<div class="col-3 no-padding mx-0 no-padding border-0">
										  	
										  	<div class="form-check col-6 no-padding border-0">
											    <input class="form-check-input" type="radio" name="radioB" id="CheckLacite" value="Lacite" checked>
											    <label class="m-0 form-check-label border-0" for="CheckLacite"><?php echo htmlspecialchars( $info["laboratorio"], ENT_COMPAT, 'UTF-8', FALSE ); ?></label>
											</div>
											<div class="mx-0 form-check col-6 no-padding border-0">
											    <input class="form-check-input" type="radio" name="radioB" id="CheckToda" value="Toda">
											    <label class="form-check-label" for="CheckToda">Toda</label>
											</div>
										</div>

										<div class="col-1"><label for="form-check-input" class="form-label">Validade:</label></div>
										<div class="col-3">	
											<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioV" id="CheckInd" value="Válido" checked>
											    <label class="form-check-label" for="CheckInd" >Indiferente</label>
											</div>
										  	<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioV" id="CheckVenc" value="Vencido">
											    <label class="form-check-label" for="CheckVenc">Vencidos</label>
											</div>
											<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioV" id="CheckVal" value="Válido">
											    <label class="form-check-label" for="CheckVal">Válidos</label>
											</div>
										</div>
										<div class="col-1"><label for="form-check-input" class="form-label">Controle:</label></div>
										<div class="col-2">
											<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioC" id="CheckTod" value="Válido" checked>
											    <label class="form-check-label" for="CheckTod" >Todos</label>
											</div>
										  	<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioC" id="CheckContr" value="Vencido">
											    <label class="form-check-label" for="CheckContr">Controlados</label>
											</div>
											<div class="form-check col-4">
											    <input class="form-check-input" type="radio" name="radioC" id="CheckNao" value="Válido">
											    <label class="form-check-label" for="CheckNao">Não controlados</label>
											</div>
										</div>
								  </div>
								  <button type="submit" class="btn btn-primary fs-4"><i class="fas fa-search"></i> Buscar</button>
								</form>
								<!-- fim de busca -->
					            <div class="box-body px-1">
					              <table class="table table-striped fs-4">
					                <thead>
					                  <tr style="text-align: left">
					                    <th >Reagente</th>
					                    <th >Fórmula</th>
					                    <th >Vol/Massa</th>
					                    <th >Qtd</th>
					                    <th >Laboratório</th>
					                    <th >Localização</th>
					                    <th >Validade</th>
					                    <th style="width: 40px">Responsável</th>
					                    <th >&nbsp;</th>
					                  </tr>
					                </thead>
					                <tbody>
					                  
					                  <tr style="text-align: left">
					                    <td >Álcool Etílico</td>
					                    <td>HHH2HH5H</td>
					                    <td>2L</td>
					                    <td>5</td>
					                    <td>Lacite</td>
					                    <td>C2</td>
					                    <td>01/02/2021</td/>
					                    <td>João Silva</td>
					                    <td style="text-align: right">
					                      <a href="" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i> Editar</a>
					                      <a href="" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Excluir</a>
					                    </td>
					                  </tr>
					                  
					                </tbody>
					              </table>
					            </div>
					            <button type="button" class="btn btn-dark fs-4" data-bs-toggle="modal" data-bs-target="#Modal" data-bs-whatever="@mdo"><i class="fas fa-file-export"></i> Exportar...</button>
					        	<!-- início do modal -->
								<div class="modal" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
								  <div class="modal-dialog">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="ModalLabel">Exportar resultado como...</h5>
								        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								      </div>
								      <div class="modal-body">
								        <form>
								          <div class="mb-3">
								            <label for="recipient-name" class="col-form-label">Nome do arquivo (sem extensão):</label>
								            <input type="text" class="form-control" id="recipient-name">
								          </div>
								        </form>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
								        <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Exportar</button>
								      </div>
								    </div>
								  </div>
								</div>
								<!-- fim do modal -->
					        </div>
					  	</div>
					  </div>
					</section>
					
				</div>
			
		    
			<!-- fim de Consulta-->