<?PHP 

	/* TELA DE CADASTRO DE PRODUTO ******************************************************************************
	
			    autor: RAFAEL MARQUES CRIADO
			     data: 28/01/2012 
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
	$acessar = acessaTela(135, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
		include('php/cadastro/produto/tela.php');
	}else{
		echo "<h4>Acesso negado para usuário</h4>";	
	}
?>