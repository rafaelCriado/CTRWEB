<div id="configuracao_filial">

	<div id="abas_configuracao_filial">
    
            <ul>
                <li class="k-state-active">
                    ÁREA DE ATUAÇÃO
                </li>	
                
                <li>
                	MENSAGENS
                </li>					
            </ul>    	
    
    
    		<div id="area_atuacao">
            
            	<div id="ffa_left">
                    <form name="filial_area_atuacao">
                        <fieldset>	
                        <legend>Filial:</legend>
                        <select name="faa_empresa">
                            <option value="">Escolha...</option>
                            <?php
                                $sql_empresas = 'SELECT EMPCOD AS CODIGO, EMPNOM AS DESCRICAO, EMPNOMFAN AS FANTASIA FROM EMPRESA';
                                
                                $query_empresa = oci_parse($conecta,$sql_empresas);
                                
                                if(oci_execute($query_empresa)){
                                    while($empresa = oci_fetch_object($query_empresa)){
                                        
                                        echo '<option value="'.$empresa->CODIGO.'" title="'.$empresa->DESCRICAO.'">'.textoFORMAT($empresa->DESCRICAO,17).'</option>';
                                        
                                    }
                                }
                            ?>
                        </select>
                        </fieldset>
                    </form>
                    <div id="ffa_vinculados">
                    	<fieldset>
                        	<legend>Vinculadas</legend>
                            <div id="recebe_vinculados"></div>
                        </fieldset>
                    </div>
                </div>
                <div id="ffa_right">
                	<fieldset>
                    	<legend>Vincular</legend>
                        
                        Estado:
                        <select name="fav_estado">
                         	<option value=""></option>
							<?php
                        
                                //Consulta de Cidades Cadastrados
                                $query_estado = oci_parse($conecta, 'SELECT UFCOD AS CODIGO, UFABREV AS ESTADO FROM UF');
                                    
                                oci_execute($query_estado);
                           
                                while ($estado = oci_fetch_object($query_estado)) {
                                    echo '<option value="'.$estado->CODIGO.'">'.textoFORMAT($estado->ESTADO,15).'</option>';
                                }
                            ?>
                        </select>
                        
                        <br />
        
                        Cidade:	
                        <select name="fav_cidade">
                            <option value="">Escolha um estado</option>
                        </select>
                        <br>
                        
                       	<input type="button" name="fav_button" value="Salvar" />
                        
                    </fieldset>
                </div>
                
                <div style="clear:both"></div>
            </div>
    		
            
            <div id="config_filial_aba_mensagem">
            
            	<?php include('php/cadastro/configuracao/filial/aba_mensagem/tela.php')?>
            
            </div>
            
    </div>





	
</div>