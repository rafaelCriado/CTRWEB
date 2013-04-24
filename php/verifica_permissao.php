<?php 
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	//Sessao
	include 'classes/session.class.php';
	$sessao = new Session();
	
	//Banco de Dados
	include 'classes/bd_oracle.class.php';
	
	
	//Funções
	include 'functions.php';
	
	if($_GET){
		
		$tela 	= $_GET['tela'];
		$codigo = $_GET['codigo'];
		
		$permissao = array();
		
		
		//CONSULTA A PERMISSAO DO USUARIO
		$acessar = acessaTela($codigo, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
		
		if(validaAcesso($acessar)){
			$valor = 1;
		}else{
			$valor = 0;
		}

		$permissao = array(
			'permissao' => $valor
		);
		
		echo( json_encode( $permissao ) );
	}
?>
