<!-- TELA RELATORIO -> VENDEDORES -> CARTEIRA DE CLIENTES================================================
             autor: Rafael Marques Criado
             data : 28/02/2013
        alterações: 	
        	siglas: RCC = relatorio_carteira_cliente
            		RCC_F = relatorio_carteira_cliente filtro
     ==================================================================================================== -->
    <?php include('php/classes/bd_oracle.class.php');?>
    
    <script type="text/javascript" src="js/pages/relatorios/vendedores/carteira_cliente.js"></script>
    <link rel="stylesheet" type="text/css" href="css/pages/relatorios/vendedores/carteira_cliente.css">
    
    
    
    <div id="RCC-principal">
    	<div id="RCC-cabecalho">
        	<fieldset>
            	<legend>Filtro: </legend>
                
                Vendedor:
                	<select name="RCC_F-vendedor">
                    	
                        <?php
							//Consulta vendedores
							$sql_vendedores = "SELECT E.ENTCOD AS CODIGO, E.ENTNOM AS NOME  FROM ENTIDADE E, CATEG_ENTIDADE CE WHERE CE.CATENTCODESTR = E.CATENTCODESTR AND CE.CATENTCLA = 'REP'";
							
							$query_vendedores = oci_parse($conecta,$sql_vendedores);
							
							if(oci_execute($query_vendedores)){
								
								while($vendedor = oci_fetch_object($query_vendedores)){
									?>
                                    <option value="<?php echo $vendedor->CODIGO; ?>"><?php echo $vendedor->NOME; ?></option>
                                    <?php
								}
								
							}
						?>
                        
                    </select>
                Previsão de Venda:
                	<select name="RCC_F-previsao">
                    	<option value="curto">Curto</option>
                    	<option value="medio">Médio</option>
                    	<option value="longo">Longo</option>
                    </select>
                    <input type="button" name="RCC_F-bt_consultar" value="Consultar">
            </fieldset>
        
        </div>
    	
        <div id="RCC-corpo">
        </div>
    
    </div>