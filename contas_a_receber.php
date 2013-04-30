<?php
	/* TELA DE CONTAS A RECEBER *********************************************************************
	
			    autor: RAUL BUNICENHA
			     data: 30/04/2013 
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
	$acessar = acessaTela(358, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
		include('php/financeiro/contas_a_receber/tela.php');
	}else{
		echo "<h4>Acesso negado para usuário</h4>";	
	}
?>