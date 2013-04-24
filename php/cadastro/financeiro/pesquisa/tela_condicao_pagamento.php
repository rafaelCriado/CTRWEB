<?php
	if(!isset($sessao)){
		//Inclui classe de sessão
		include('php/classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('php/functions.php');
		
		//Inclui banco de dados
		include('php/classes/bd_oracle.class.php');
	}
?>
<div style="height:100%">
    <form>
        <fieldset style="height:100%">
            <legend>Pesquisa: <strong><span id="tipo_pesquisa"></span>Condições de Pagamento Cadastradas</strong></legend>
            
            <div id="mostra_pequisa">
                <?php 
					
					$condicao = isset($_POST['parametro'])?$_POST['parametro']:'';
	
	
					if(!empty($condicao)){
						
						if(!isset($sessao)){
							//Inclui classe de sessão
							include('php/classes/session.class.php');
							
							//Inicia sessão
							$sessao = new Session();
							
							//Inclui funções
							include('php/functions.php');
							
							//Inclui banco de dados
							include('php/classes/bd_oracle.class.php');
						}
						
						
						//inclui banco de dados
						include('php/classes/bd_oracle.class.php');
						
						switch($condicao){
							case 1:
								$sql = 'SELECT C.CONPAGCOD       AS CODIGO,
											   C.CONPAGDEN       AS NOME,
											   C.CONPAGQTDPAR    AS "QUANTIDADE DE PARCELAS",
											   C.CONPAGDIAPRIPAR AS "PRIMEIRA PARCELA",
											   F.FINNOM          AS FINANCEIRA
										  FROM COND_PAG C, FINANCEIRAS F
										 WHERE C.EMPCOD = '.$sessao->getNode('empresa_acessada').' AND F.FINCOD(+) = C.FINCOD';
										
								
								$campo[0] = 'CODIGO';
								$campo[1] = 'NOME';
								$campo[2] = 'QUANTIDADE DE PARCELAS';
								$campo[3] = 'PRIMEIRA PARCELA';		
								$campo[4] = 'FINANCEIRA';
								?>
									<!-- Filtros -->
									<fieldset>
                                    	<legend>Filtros</legend>
                                        
                                        <div style="float:left">
                                        	<label>Qtde. de Parcelas</label><br />
											<select name="filtro_cp_qtde_parcela">
                                            	<option value="">Escolha...</option>
                                                <?php
													//Quantidade de parcelas
													$sql_parcelas = 'SELECT CONPAGQTDPAR AS NUMERO FROM COND_PAG WHERE EMPCOD = '.$sessao->getNode('empresa_acessada').' GROUP BY CONPAGQTDPAR
';
													$query_parcelas = oci_parse($conecta,$sql_parcelas);
													if(oci_execute($query_parcelas)){
														while($parcelas = oci_fetch_object($query_parcelas)){
															
															echo '<option value="'.$parcelas->NUMERO.'">'.$parcelas->NUMERO.'</option>';
															
															
														}
													}
												?>
                                            </select>
                                        </div>

                                        <div style="float:left; margin-left:5px;">
                                        	<label>Carência:</label><br />
											<select name="filtro_cp_carencia">
                                            	<option value="">Escolha...</option>
                                                <?php
													//Quantidade de parcelas
													$sql_carencia = 'SELECT CONPAGDIAPRIPAR AS NUMERO FROM COND_PAG WHERE EMPCOD = '.$sessao->getNode('empresa_acessada').' GROUP BY CONPAGDIAPRIPAR';
													$query_carencia = oci_parse($conecta,$sql_carencia);
													if(oci_execute($query_carencia)){
														while($carencia = oci_fetch_object($query_carencia)){
															
															echo '<option value="'.$carencia->NUMERO.'">'.$carencia->NUMERO.'</option>';
															
															
														}
													}
												?>
                                            </select>
                                        </div>
                                        
                                        <div style="float:left; margin-left:5px;">
                                        	<label>Financeira:</label><br />
											<select name="filtro_cp_financeira">
                                            	<option value="">Escolha...</option>
                                                <option value="0">Sem Financeira</option>
                                                <?php
													//Quantidade de parcelas
													$sql_financeira = 'SELECT CP.FINCOD AS CODIGO, F.FINNOM AS NOME FROM COND_PAG CP, FINANCEIRAS F WHERE CP.FINCOD = F.FINCOD AND CP.EMPCOD = '.$sessao->getNode('empresa_acessada').' GROUP BY CP.FINCOD, F.FINNOM';
													$query_financeira = oci_parse($conecta,$sql_financeira);
													if(oci_execute($query_financeira)){
														while($financeira = oci_fetch_object($query_financeira)){
															
															echo '<option value="'.$financeira->CODIGO.'">'.$financeira->NOME.'</option>';
															
															
														}
													}
												?>
                                            </select>
                                        </div>
                                        
                                    </fieldset>
								
								<?php		
								break;
						}
						
						$query = oci_parse($conecta,$sql);
						
						if(oci_execute($query)){
							
							
							echo '<div id="pcp_table"><table cellpadding="1" cellspacing="1" width="100%" class="pesquisa_condicao_pagamento">';
							
							
							echo '<tr>';
							for($x = 0; $x < count($campo); $x++ ){
								
								echo '<td><strong>'.$campo[$x].'</strong></td>';
								
								
							}
							echo '</tr>';
							
							while($row = oci_fetch_object($query)){
								echo '<tr id="'.$row->$campo[0].'">';
								
									for($x = 0; $x < count($campo); $x++ ){
										echo '<td>'.str_replace('|','',$row->$campo[$x]).'</td>';
									}
								
								echo '</tr>';
							}
							
							echo '</table></div>';
							
						}
						
					
					}else{
					
						echo 'Aguarde...';
					
					}
				
				
				 ?>
            </div>
            
            <input type="button" value="Sair">
        </fieldset>
        
        
        <input type="hidden" name="pesquisa_condicao_pagamento_tela_retorno" value="0">
    </form>
</div>