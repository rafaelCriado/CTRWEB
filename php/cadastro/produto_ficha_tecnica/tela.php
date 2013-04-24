<?php
	//Inclui banco de dados
	include('php/classes/bd_oracle.class.php');
	
?>
	<script type="text/javascript" src="../../../js/pages/cadastro/cadastro_produto_ficha_tecnica.js"></script>
	<script type="text/javascript" src="js/pages/cadastro/cadastro_produto_ficha_tecnica.js"></script>
    
    <link rel="stylesheet" href="../../../css/pages/cadastro/cadastro_produto_ficha_tecnica.css" type="text/css">
    <link rel="stylesheet" href="css/pages/cadastro/cadastro_produto_ficha_tecnica.css" type="text/css">
    
    <div id="ficha_tecnica_menu_superior" >
    	<ul id="fc_menu">
        	<li title="Nova Ficha Tecnica">
            	<a href="#" name="ft_bt_novo"><img src="img/novo.png" />Nova</a>
            </li>
        	<li title="Editar Ficha Tecnica">
            	<a href="#" name="ft_bt_editar"><img src="img/editar.png" />Editar</a>
            </li>
        	<li title="Excluir Ficha Tecnica">
            	<a href="#" name="ft_bt_excluir"><img src="img/excluir.png" />Excluir</a>
            </li>
            
        	<li title="Pesquisar Ficha Tecnica">
            	<a href="#" name="ft_bt_pesquisar"><img src="img/pesquisar.png" />Pesquisar</a>
            </li>        	
        	<li title="Salvar Ficha Tecnica">
            	<a href="#" name="ft_bt_salvar"><img src="img/save.png" />Salvar</a>
            </li>        	
        </ul>
    </div>
    
    <div id="tela_total">
        <div id="tabstrip_ficha_tecnica">
            
            <!-- Abas -->
            <ul>
                <li class="k-state-active">
                    Ficha Tecnica
                </li>
                <li>
                    Itens
                </li>
            </ul>
            <!-- Fim Abas -->
            
            <!-- Primeira Aba (NOVA TABELA)-->
            <div>
                <form name="ficha_tecnica_adicionar">	
                    <fieldset>
                        <label class="label" for="ft_codigo">Código: </label>
                        <input type="text" name="ft_codigo"  size="5" />
                        <input type="hidden" name="ft_codigo_selecionado"  size="5" />
                        <input type="image" name="ft_bt_seta" src="img/seta_esquerda.png" />
                    </fieldset>
                    <fieldset>
                        
                        <label class="label" for="ft_produto_codigo">Cód Produto: </label>
                        <input type="text" name="ft_produto_codigo" size="5" disabled="disabled"/>		
                        <input type="hidden" name="ft_produto_codigo_selecionado" value="" size="5" />		
                        <input type="text" name="ft_produto_nome" size="40" disabled="disabled"/>
                        <br />

                        
                        <label class="label" for="ft_produto_grupo_codigo">Grupo: </label>
                        <input type="text" name="ft_produto_grupo_codigo" size="5" disabled="disabled"/>		
                        <input type="text" name="ft_produto_grupo_nome"  size="40" disabled="disabled"/>
                        <br />


                        <label class="label" for="ft_produto_subgrupo_codigo">Sub Grupo: </label>
                        <input type="text" name="ft_produto_subgrupo_codigo"  size="5"disabled="disabled"/>		
                        <input type="text" name="ft_produto_subgrupo_nome" size="40" disabled="disabled"/>
                        <br />

                        <label class="label" for="ft_produto_empresa_codigo">Empresa: </label>
                        <input type="text" name="ft_produto_empresa_codigo" size="5" disabled="disabled"/>		
                        <input type="text" name="ft_produto_empresa_nome" size="40" disabled="disabled"/>
                        <br />
                                             
                        <label class="label" for="ft_observacao">Obs Atualização: </label>
                        <textarea name="ft_observacao" cols="40" disabled="disabled"></textarea>
                        
                        
                    </fieldset>
               	
            </div>
            <!-- Fim Primeira aba-->
            
            
            <!-- Segunda Aba (INCLUIR ITENS)-->
            <div>
            	<div id="itens_ficha_tecnica">
                	<?php include('php/cadastro/produto_ficha_tecnica/tela_itens_ficha_tecnica.php');?>
                </div>
            </div>
            <!-- Fim Segunda aba-->
        </div>
</div>
    
    <div id="tabela_ficha_tecnica"></div>
