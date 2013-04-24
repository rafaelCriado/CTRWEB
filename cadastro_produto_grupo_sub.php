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
    	<link rel="stylesheet" type="text/css" href="css/pages/cadastro/cadastro_produto_grupo_sub.css">
        <script type="text/javascript">
            //Efeito de Abas ==============================================
            $("#tabstrip_produto_grupo_sub").kendoTabStrip({
                animation:	{
                    open: {
                        
                        effects: "fadeIn"
                    }
                }
            
            });
            // ============================================================
        </script>
    </head>
    
    <body>
        <div id="tabstrip_produto_grupo_sub">
            
            <!-- Abas -->
            <ul>
                <li class="k-state-active">
                    Grupo
                </li>
                <li>
                    Sub-Grupo
                </li>
            </ul>
            <!-- Fim Abas -->
            
    
            <!-- FORM GRUPO -->
            <div id="form_produto_grupo">
                <div id="formulario_produto_grupo" style="width:280px; float:left; height:235px;">
                    <form name="form_produto_grupo">
                        <fieldset class="fieldset">
                            <legend>Cadastro</legend>
                            
                            <br>
                            
                            <label for="produto_grupo_descricao">Grupo: </label>
                            <input type="text" name="produto_grupo_descricao" value="" maxlength="50">
                            
                            <br>
							<br>
                            
                            <input type="button" value="Cadastrar" name="bt_produto_grupo_salvar" class="k-button" style="float:right">			
                            
                            <br>
                            <br>
                            
                            <div class="retorno_produto_grupo"></div>
                        </fieldset>
                    </form>
                </div>
                
                <div id="div_produto_lista_grupos" style="overflow:auto; height:215px">
          
                    <?php include ('php/cadastro/produto_grupo_sub/lista_de_grupos.php'); ?>
                
                </div>
                
                
                <div style="clear:both;"></div>
            </div>
            
            
            <!-- FORM SUBGRUPO-->
            <div id="form_produto_subgrupo">
                <div id="formulario_produto_subgrupo" style="width:280px; float:left;">
                    <form name="form_produto_subgrupo">
            			<fieldset class="fieldset">
                            <legend>Cadastro</legend>
                            
                            <br>
                            
                            <label for="produto_subgrupo_grupo">Grupo: </label>
                            <select name="produto_subgrupo_grupo">
                                <option value="">Escolha um Grupo</option>
                                <?php
									if($sessao->checkNode('empresa_acessada') == TRUE){
										//Consulta grupos cadastrados
										$sql_grupos = 'SELECT EMPCOD    AS CODIGO_EMPRESA,
														   	  PROGRUCOD AS CODIGO_GRUPO,
														      PROGRUDEN AS NOME_GRUPO
													     FROM PRODUTO_GRUPO
													    WHERE EMPCOD = '.$sessao->getNode('empresa_acessada');
												 
										$query_grupos = oci_parse($conecta, $sql_grupos);
										
										oci_execute($query_grupos);
										
										while($rowgrupos = oci_fetch_object($query_grupos)){
											
											echo '<option value="'.$rowgrupos->CODIGO_GRUPO.'">'.$rowgrupos->NOME_GRUPO.'</option>';
										}
									}
								?>
                            </select>
                            
                            <br>
                            <br>
                            
                            <label for="produto_subgrupo_descricao">Sub-Grupo: </label>
                            <input type="text" name="produto_subgrupo_descricao" value="" maxlength="50">
                            
                            <br>
                            <br>
                            <br>
                            
                            <input type="button" value="Cadastrar" name="bt_produto_subgrupo_salvar" class="k-button" style="float:right">			
                            <br>
                            <div class="retorno_produto_subgrupo"></div>
                        </fieldset>
                    </form>
                </div>
                
                <div id="div_produto_lista_sub" style="height:auto; overflow:auto; height:215px">
          
                    <?php include ('php/cadastro/produto_grupo_sub/lista_de_subgrupos.php'); ?>
                
                </div>
                
                
                <div style="clear:both;"></div>
            </div>                    
            
            
        </div>
    
    </body>
</html>
		<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>