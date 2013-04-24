<?php 
	//Inclui banco de dados
	include('php/classes/bd_oracle.class.php');
?>
<html>
	<head>
    	<script>
			
			//EFEITO DE ABAS ============================================================
			$("#tabstrip_tabela_preco").kendoTabStrip({
				animation:	{
					open: {
						
						effects: "fadeIn"
					}
				}
			
			});
			// ==========================================================================
			
			

        </script>
        <style>
        	#tabstrip_tabela_preco{ height:99%}
			#tabela_preco_novo{ height:235px; display:block; border:0px solid #ddd;}
			#tabela_preco_incluir_produto{ height:235px; display:block; border:0px solid #ddd;}
        </style>
    </head>
    
    <body>
    	<div id="tabstrip_tabela_preco">
        	<!-- Abas -->
            <ul>
                <li class="k-state-active">
                    Nova Tabela
                </li>
                <li>
                	Incluir Produtos
                </li>
            </ul>
            <!-- Fim Abas -->

        	<!-- Primeira Aba (NOVA TABELA)-->
            <div id="primeira_aba">
                <div id="tabela_preco_novo">
                	<?php include('php/cadastro/produto_tabela_preco/tela_nova_tabela.php'); ?>
                </div>
            </div>
            <!-- Fim Primeira aba-->
            
            
        	<!-- Segunda Aba (INCLUIR PREÇO)-->
            <div id="segunda_aba">
                <div id="tabela_preco_incluir_produto">
                	<?php include('php/cadastro/produto_tabela_preco/tela_incluir_preco.php'); ?>
                </div>
            </div>
            <!-- Fim Segunda aba-->
        
    		
		</div>
    </body>
</html>