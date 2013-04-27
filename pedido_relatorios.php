<?php
	/* TELA DE CADASTRO DE PEDIDO RELATÓRIO *********************************************************************
	
			    autor: RAFAEL MARQUES CRIADO
			     data: 27/04/2013 
		 modificações:
		 
	   **********************************************************************************************************/
	
	//Caso não exista sessão faça (Necessário devido efeito de alteração)
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
	$acessar = acessaTela(357, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
		include('php/pedidos/relatorio/tela.php');
	}else{
		echo "<h4>Acesso negado para usuário</h4>";	
	}
?>