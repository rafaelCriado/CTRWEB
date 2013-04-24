<?PHP 
	//Caso não exista sessão faça (Necessário devido efeito de alteração
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

	//CONTROLE DE ACESSO
	$acessar = acessaTela(136, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
		?>
<html>
    <head>
    	<link rel="stylesheet" type="text/css" href="css/pages/cadastro/cadastro_configuracao_empresa.css">
        <script type="text/javascript" src="js/pages/cadastro/cadastro_configuracao_empresa.js"></script>
        
    </head>
    
    <body>
        <div id="tabstrip_configuracao_loja">
            
            <!-- Abas -->
            <ul>
                <li class="k-state-active">
                    Loja
                </li>
                
            </ul>
            <!-- Fim Abas -->
            
    
            <!-- FORM GRUPO -->
            <div id="form_config_loja">
                <div style=" height:250px;">
                <form name="config_loja">
                	<label for="tabela_preco">Tabela de Preço a usar: </label>
                    <select name="tabela_preco">
                    	<option value="">Selecione...</option>
						<?php 
                            //Tabelas de preço cadastradas
                            $sql_tabela_preco = 'SELECT EMPCOD, TABPRECOD AS CODIGO, TABPREDEN AS DESCRICAO, USUCOD FROM TABELA_PRECO WHERE EMPCOD = '.$sessao->getNode('empresa_acessada');
                            
                            //Prepara
                            $query_tabela_preco = oci_parse($conecta,$sql_tabela_preco);
                            
                            //Executa
                            oci_execute($query_tabela_preco);
                            
                            
                            while($tabela_preço = oci_fetch_object($query_tabela_preco)){
                                ?>
                                
                                <option value="<?php echo $tabela_preço->CODIGO ?>" ><?php echo $tabela_preço->DESCRICAO; ?></option>
                                    
                                <?php
                            }
                        ?>
                    </select>
                    
                    
                    <?php
						//Configurações atuais
						$sql_config_empresa = "SELECT CE.ORC_TABPRE AS TABELA_PRECO_ORCAMENTO,
													   TP.TABPREDEN  AS TABELA_PRECO_DESCRICAO,
													   CP.CONPAGDEN||' - '||F.FINNOM   AS CONDICAO
												  FROM CONFIG_EMPRESA CE, TABELA_PRECO TP, COND_PAG CP, FINANCEIRAS F
												 WHERE TP.TABPRECOD = CE.ORC_TABPRE 
												   AND CE.CONPAGCOD = CP.CONPAGCOD(+)
												   AND CP.FINCOD = F.FINCOD(+)
												   AND CE.EMPCOD = ".$sessao->getNode('empresa_acessada');
												 
						//Prepara
						$query_config_empresa = oci_parse($conecta,$sql_config_empresa);
						
						//executa
						oci_execute($query_config_empresa);
						
						
						$config_empresa = oci_fetch_object($query_config_empresa);
						
					?>
                    
                    
                     <span>Configurada: <?php echo ($config_empresa->TABELA_PRECO_ORCAMENTO?$config_empresa->TABELA_PRECO_DESCRICAO:'');?></span>
                     
                     
                     
                     
                     <br>

					<fieldset>
                    	<legend>Start</legend>
                        <label for="start_cp">Condição de Pagamento Configurada:  </label>
                        <input name="start_bt_cp" type="button" value="Configurar">
                        <input type="hidden" name="start_cp" value="">
                        <span><input type="text" disabled name="start_cp_nome" value="<?php echo ($config_empresa->CONDICAO?$config_empresa->CONDICAO:'');?>"><a href="#" name="ex_cp_start">Excluir</a></span>
					</fieldset>
                    
                    
					<input type="button" name="bt_config_loja_salvar" class="k-button" value="Salvar"> 
                </form>
                
                </div>
            </div>
            
            
        </div>
    
    </body>
</html>
		<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>