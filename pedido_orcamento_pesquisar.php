<?php 
	/* TELA DE PESQUISA ****************************************************************************************
	
			    autor: RAFAEL MARQUES CRIADO
			     data: 21/02/2012
		   	   
		 modificações:
		 
	   **********************************************************************************************************/
	
	//Caso não exista sessão faça (Necessário devido efeito do botão de alteração)
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

	//pesquisar pedidos e orçamentos
	$acessar = acessaTela(217, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						

		//Tela
		include 'php/pedidos/pesquisar/pesquisar.php';

	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}	
?>	