<?php 
	/* TELA DE ORÇAMENTO ****************************************************************************************
	
			    autor: RAFAEL MARQUES CRIADO
			     data: 23/01/2012
		   	   modulo: RIOLAX
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

	//CONTROLE DE ACESSO
	$acessar = acessaTela(177, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						

		//Tela
		include 'modulos/riolax/pedido/orcamento/PHP/tela.php';

	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}	
?>	