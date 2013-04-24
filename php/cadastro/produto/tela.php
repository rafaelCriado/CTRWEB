<html>
	<head>
    	<link rel="stylesheet" type="text/css" href="css/pages/cadastro/cadastro_produto.css">
    	<script type="text/javascript" src="js/pages/cadastro/cadastro_produto.js"></script>

    </head>
    
	<body>
        <div id="tabstrip_produto">
            <!-- Abas -->
            <ul>
                <li class="k-state-active">
                    Produto
                </li>
                <li>
                    Preço
                </li>
                <li>
                    Imagem
                </li>
                <li>
                    Pesquisa
                </li>
            </ul>
            <!-- Fim Abas -->

            <!-- Conteudo da Aba PRODUTO -->
            <div id="form_produto">
            	<?php
					error_reporting(0);
					if(isset($_REQUEST['produto_codigo']) and !empty($_REQUEST['produto_codigo'])){
						//Pesquisa dados
						$sql = 'SELECT P.EMPCOD       AS EMPRESA,
									   P.PROCOD       AS CODIGO,
									   P.PRODES       AS DESCRICAO,
									   P.PROCODBAR    AS CODIGO_BARRA,
									   P.UNIMEDCOD    AS UNIDADE_MEDIDA,
									   P.PROCONEST    AS CONTROLA_ESTOQUE,
									   P.PROGRUCOD    AS CODIGO_GRUPO,
									   P.PROSUBGRUCOD AS CODIGO_SUBGRUPO,
									   P.PRONCM       AS NCM,
									   P.PROLAR       AS LARGURA,
									   P.PROALT       AS ALTURA,
									   P.PROCOM       AS COMPRIMENTO,
									   P.PROPESLIQ    AS PESO_LIQUIDO,
									   P.PROPESBRU    AS PESO_BRUTO,
									   P.PROTIP		  AS TIPO,
									   P.PROCOR		  AS COR,
									   P.PROVALCUS    AS PRECO_CUSTO,
									   E.EMPINDVALMIN AS INDICE_CUSTO
								  FROM PRODUTO P, EMPRESA E
								 WHERE P.EMPCOD = E.EMPCOD 
								   AND P.PROCOD = '.$_REQUEST['produto_codigo'];
								  
						$query_produtos = oci_parse($conecta,$sql);
						
						oci_execute($query_produtos);
						
						$produto = oci_fetch_object($query_produtos);
						
					}
				?>
                
                <fieldset>
                    <legend>Cadastro</legend>
                    
                    <form name="add_produto" method="post">
                        <div style="float:left;">
                            <label for="codigo_produto">Código:</label>
                            <input type="text"   name="codigo_produto1" 
                            	value="<?php echo (isset($produto->CODIGO))? $produto->CODIGO:'';?>"  size="10" disabled>
                            <input type="hidden" name="codigo_produto"  value="<?php echo (isset($produto->CODIGO))? $produto->CODIGO:'0';?>" size="10" >
                                
                            <br>
                            
                            <label for="produto_descricao">Descrição :</label>
                            <input name="produto_descricao" maxlength="100" size="35"
                            	value="<?php echo (isset($produto->DESCRICAO))? $produto->DESCRICAO:'';?>">
                            <br>
    
                            <label for="produto_codigo_barra">Cód. de Barra: </label>
                            <input name="produto_codigo_barra" maxlength="30" size="35"
                            	value="<?php echo (isset($produto->CODIGO_BARRA))? $produto->CODIGO_BARRA:'';?>">
                            
                            <br>
    
                            <label for="produto_ncm" title="Código NCM(Nomenclatura Comum do MERCOSUL)">NCM: </label>
                            <input name="produto_ncm" maxlength="10" size="35"
                            	value="<?php echo (isset($produto->NCM))? $produto->NCM:'';?>">
                            
                            <br>
                            
                            <label for="produto_unidade_medida">Uni. Medida: </label>
                            <select name="produto_unidade_medida">
                            		<option value="">Selecione.. </option>
                                <?php
                                    //Pesquisa as unidades de Medida
                                    $sql_medida = "SELECT UNIMEDCOD AS CODIGO, 
                                                          UNIMEDDES AS DESCRICAO 
                                                     FROM UNIDADE_MEDIDA";
                                                     
                                    //Prepara query
                                    $query_medidas = oci_parse($conecta, $sql_medida);
                                    
                                    //Executa
                                    if(oci_execute($query_medidas)){
                                        
                                        //Recebe informações e apresenta na tela
                                        while($unidade_medida = oci_fetch_object($query_medidas)){
                                            
                                            echo '<option value="'.$unidade_medida->CODIGO.'">'.$unidade_medida->DESCRICAO.'</option>';
                                            
                                        }
                                    }
                                ?>
                            </select> 
                            <br>
                            
                            <label for="produto_seleciona_grupo">Grupo: </label>
                            <select name="produto_seleciona_grupo">
                            	<option value="">Selecione um grupo..</option>
                                <?php
                                    //Pesquisa os grupos
                                    $sql_grupo = "SELECT PG.PROGRUCOD AS CODIGO, PG.PROGRUDEN AS DESCRICAO FROM PRODUTO_GRUPO PG WHERE PG.EMPCOD = ".$sessao->getNode('empresa_acessada');
                                                     
                                    //Prepara query
                                    $query_grupos = oci_parse($conecta, $sql_grupo);
                                    
                                    //Executa
                                    if(oci_execute($query_grupos)){
                                        
                                        //Recebe informações e apresenta na tela
                                        while($grupo = oci_fetch_object($query_grupos)){
                                            
                                            echo '<option value="'.$grupo->CODIGO.'">'.$grupo->DESCRICAO.'</option>';
                              
                                        }
                                    }
                                ?>
                            </select> 
                            <br>
							
                            <label for="produto_seleciona_subgrupo">Subgrupo: </label>
                            <select name="produto_seleciona_subgrupo">
                            	<option value="">Escolha um grupo.. </option>
                                <?php
									if(isset($produto->CODIGO_SUBGRUPO)){
										//Pesquisa os grupos
										$sql_subgrupo = "SELECT PS.PROSUBGRUCOD AS CODIGO, PS.PROSUBGRUDEN AS DESCRICAO
														   FROM PRODUTO_SUBGRUPO PS
														  WHERE PS.EMPCOD = ".$sessao->getNode('empresa_acessada')."
														    AND PS.PROGRUCOD =".$produto->CODIGO_GRUPO;
														 
										//Prepara query
										$query_subgrupos = oci_parse($conecta, $sql_subgrupo);
										
										//Executa
										if(oci_execute($query_subgrupos)){
											
											//Recebe informações e apresenta na tela
											while($subgrupo = oci_fetch_object($query_subgrupos)){
												
												echo '<option value="'.$subgrupo->CODIGO.'">'.$subgrupo->DESCRICAO.'</option>';
								  
											}
										}
									}
								?>
                            </select>
                            
                            <br>

                            <label for="produto_cor">Cor: </label>
                            <input type="text" name="produto_cor" 
                            	value="<?php echo (isset($produto->COR))? $produto->COR:'';?>">
                            <br>

                            <fieldset>
                            	<legend>Tipo de Produto</legend>
                            	<input type="radio" name="produto_tipo" value="A" checked> Acabado Final 
                            	<input type="radio" name="produto_tipo" value="B"> Beneficiado 
                            	<input type="radio" name="produto_tipo" value="F"> Fantasma
                                <br>
                            	<input type="radio" name="produto_tipo" value="C"> Comprado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            	<input type="radio" name="produto_tipo" value="P"> Produzido 
                            </fieldset>
                            
                            <script>
								$('input[name="produto_tipo"]').each(function() {
									
                                    if($(this).val() == '<?php echo (isset($produto->TIPO))? $produto->TIPO:'';?>'){
										
										$(this).attr('checked',true);

									}
                                });
                            </script>

                        </div>
                        <div style="width:310px; float:right">
                            <span style="float:right">
                                Controla Estoque:
                                <select name="produto_estoque">
                                    <option value="S">SIM</option>
                                    <option value="N">NÃO</option>
                                </select>
                            </span>
							<script>
								$('select[name="produto_unidade_medida"]').val('<?php echo (isset($produto->UNIDADE_MEDIDA))? $produto->UNIDADE_MEDIDA:'';?>');
								
								$('select[name="produto_seleciona_grupo"]').val('<?php echo (isset($produto->CODIGO_GRUPO))? $produto->CODIGO_GRUPO:'';?>');
								
								$('select[name="produto_seleciona_subgrupo"]').val('<?php echo (isset($produto->CODIGO_SUBGRUPO))? $produto->CODIGO_SUBGRUPO:'';?>');
                            	
								$('select[name="produto_estoque"]').val('<?php echo (isset($produto->CONTROLA_ESTOQUE))? $produto->CONTROLA_ESTOQUE:'';?>');
                            </script>

                            <fieldset>
                                <legend>Dimensões</legend>
                                
                                
    
                              <label for="produto_largura">Largura(cm): </label>
                                <input name="produto_largura" 
                                	value="<?php echo (isset($produto->LARGURA))? $produto->LARGURA:'';?>">
                                <br>
    
                                <label for="produto_altura">Altura(cm): </label>
                                <input name="produto_altura" 
                                	value="<?php echo (isset($produto->ALTURA))? $produto->ALTURA:'';?>">
                                <br>
    
                               
                                <label for="produto_comprimento" title="comprimento">Compr.(cm): </label>
                                <input name="produto_comprimento" 
                                	value="<?php echo (isset($produto->COMPRIMENTO))? $produto->COMPRIMENTO:'';?>">
                                <br>
    
                                <label for="produto_peso_liquido" title="Peso Liquido">Peso Liq.(g): </label>
                                <input name="produto_peso_liquido" 
                                	value="<?php echo (isset($produto->PESO_LIQUIDO))? $produto->PESO_LIQUIDO:'';?>">
                                <br>
    
                                <label for="produto_peso_bruto">Peso Bruto(g): </label>
                                <input name="produto_peso_bruto" 
                                	value="<?php echo (isset($produto->PESO_BRUTO))? $produto->PESO_BRUTO:'';?>">
                                
                            </fieldset>
							<br>
                            
                            <a href="#" style="float:right" class="k-button" name="bt_produto_cadastrar" >Salvar</a>
                            <a href="#" style="float:right" class="k-button" name="bt_produto_novo" >Novo</a>
                            <span class="retorno_cadastro_produto" style="float:right"></span>
                        </div>
                        <!-- FIM BOTÕES INFERIORES-->

                </fieldset>
            </div>
            <!-- Fim do conteudo da aba pessoa-->

            <style>
				#produto_precos_cadastros{ margin:0 0 0 10px; height:240px}
				#produto_precos_cadastros table { width:100%;}
            </style>
            
            
            
            <!-- CONTEUDO DA ABA PREÇO -->
            <div id="tabela_preco">

                
                <div id="produto_precos_cadastros">
                	
                    
                    
                    
                    <h3>Incluir Preços</h3>
                    <fieldset>
                    Custo(Produto): <input type="text" name="produto_preco_custo"
                    					value="<?php echo (isset($produto->PRECO_CUSTO))? number_format($produto->PRECO_CUSTO,2,',',''):'';?>">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    Valor minimo de venda(Produto): <input type="text" name="produto_preco_minimo" disabled
                    									value="<?php echo (isset($produto->INDICE_CUSTO))? number_format($produto->INDICE_CUSTO*$produto->PRECO_CUSTO,2,',',''):'';?>"	>
                    </fieldset>
                	<table>
                    	<tr>
                        	<td class="k-header">Tabela</td>
                            <td class="k-header">Preço</td>
                            <td class="k-header"></td>
                        </tr>
                        
                        <?php
							if(isset($produto->CODIGO) and !empty($produto->CODIGO)){
								$codigo_produto = $produto->CODIGO;
							}else{
								$codigo_produto = 0;
							}
							//Consulta os valor
							$sql = 'SELECT
										 TP.TABPRECOD AS CODIGO, 
										 TP.TABPREDEN AS NOME,
										 (SELECT TPI.TABPREITEVAL FROM TABELA_PRECO_ITEM TPI WHERE TPI.TABPRECOD = TP.TABPRECOD AND TPI.PROCOD = '.$produto->CODIGO.') AS VALOR
									 FROM 
										  TABELA_PRECO TP 
									 WHERE
									 	  TP.EMPCOD = '.$sessao->getNode('empresa_acessada');
									   
							$query_precos = oci_parse($conecta,$sql);
							oci_execute($query_precos);
							
							function valorPreco($valor){
								
								$tamanho =strlen($valor);
								$retorno = '';
								
								for($x = 0; $x<= $tamanho; $x++){
									$retorno .= $valor[$x];
									if(($tamanho - $x) == 6 ){
										$retorno .= '.';
									}
									if(($tamanho - $x) == 3 ){
										$retorno .= ',';
									}
								}
								
								return $retorno;
								
							}
							
							
							while($tabela = oci_fetch_object($query_precos)){
								echo '<tr>';
								echo 	'<td>'.textoFORMAT($tabela->NOME,8).'</td>';
								echo 	'<td id="'.$tabela->CODIGO.'">'.number_format($tabela->VALOR,2,',','.').'</td>';
								echo 	'<td><a href="#" id="'.$tabela->CODIGO.'" name="tab_prec_inc_bt_alterar">Alterar</a>&nbsp;&nbsp;<a href="#" id="'.$tabela->CODIGO.'" name="tab_prec_inc_bt_aplicar">Aplicar Índice da Tabela</a></td>';
								
								echo '</tr>';
							}
						?>
                        <tr>
                        	
                        </tr>
                        
                    </table>	
                </div>
                
                
                
                <div style="clear:both"></div>
            </div>
            <!-- FIM PREÇO-->
            
            <div id="produto_imagem">
            	Imagem
                <input type="file">
            </div>
            
            
            
            <!-- CONTEUDO ABA PESQUISA -->
            <div id="produto_pesquisa" style="overflow:auto; height:253px">
            	<fieldset>
                <legend>Produtos</legend>
                Pesquisa por: 
                <select name="produto_tipo_pesquisa">
                	<option value="0">DESCRIÇÃO	</option>
                	<option value="1">CÓDIGO	</option>
                	<option value="2">GRUPO	</option>
                </select>
                <input type="text" name="produto_texto_pesquisa" value="" placeholder="Escreva sua pesquisa">
                
                <table id="produto_pesquisa_aba_dois_table">
                	<tr class="k-header">
                    	<td>Código</td>
                    	<td>Descrição</td>
                    	<td>Grupo</td>
                    	<td>Sub-Grupo</td>
                    	<td>NCM</td>
                        <td></td>
                    </tr>
                    
                    <?php 
						//Pesquisa de produtos
						$sql = "SELECT P.PROCOD        AS CODIGO,
									   P.PRODES        AS DESCRICAO,
									   PG.PROGRUDEN    AS GRUPO,
									   PS.PROSUBGRUDEN AS SUBGRUPO,
									   P.PRONCM        AS NCM
								  FROM PRODUTO P
						     LEFT JOIN PRODUTO_GRUPO PG
									ON P.PROGRUCOD = PG.PROGRUCOD
							 LEFT JOIN PRODUTO_SUBGRUPO PS
									ON P.PROSUBGRUCOD = PS.PROSUBGRUCOD
								 WHERE P.EMPCOD = ".$sessao->getNode('empresa_acessada');
						
						$query_prod = oci_parse($conecta,$sql);
						
						oci_execute($query_prod);
						
						while($prod = oci_fetch_object($query_prod)){
							?>
                            <tr id="<?php echo $prod->CODIGO;?>">
                                <td><?php echo $prod->CODIGO;			?></td>
                                <td title="<?php echo $prod->DESCRICAO;?>">
									<?php echo textoFORMAT($prod->DESCRICAO,20);?>
                               	</td>
                                <td><?php echo $prod->GRUPO; 			?></td>
                                <td><?php echo $prod->SUBGRUPO;			?></td>
                                <td><?php echo $prod->NCM;	?></td>
                                <td>
                                	<a href="#" id="<?php echo $prod->CODIGO;?>" name="prod_bt_editar">Visualizar/Editar</a> 
                                    	&nbsp;&nbsp;						
                                    <a href="#" id="<?php echo $prod->CODIGO;?>" name="prod_bt_excluir">Excluir</a>
                              	</td>
                            </tr>
                    		<?php
						}
					?>
                </table>
                </div>
                </fieldset>
            </div>
            <!-- FIM CONTEUDO ABA PESQUISA -->
            
         </div>   
	</body>
</html>