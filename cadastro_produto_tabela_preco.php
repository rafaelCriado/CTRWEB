<?PHP 
	/* TELA DE CADASTRO DE TABELAS DE PREÇO ******************************************************************************
	
			    autor: RAFAEL MARQUES CRIADO
			     data: 23/01/2012 
		 modificações:
		 
	   **********************************************************************************************************/

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
	$acessar = acessaTela(158, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
		?>
    	<link rel="stylesheet" type="text/css" href="css/pages/cadastro/cadastro_produto_grupo_sub.css">
        <script type="text/javascript" src="js/pages/cadastro/cadastro_produto_tabela_preco.js"></script>
        
        <div id="tabstrip_tabela_preco">
            
            <!-- Abas -->
            <ul>
                <li class="k-state-active">
                    Nova Tabela
                </li>
            </ul>
            <!-- Fim Abas -->
            
    
            <!-- FORM GRUPO -->
            <div id="primeira-aba">
            	<div id="tabela_preco_nova">
                	<?php include('php/cadastro/produto_tabela_preco/tela_nova_tabela.php');?>
                </div>
            </div>
            
            
            
        </div>
    

		<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>