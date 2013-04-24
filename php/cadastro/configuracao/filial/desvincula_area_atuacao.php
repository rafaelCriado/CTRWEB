<?php 
	error_reporting(0);
	
	//INSERT NA TABELA EMPRESA (Cadastros -> CONFIGURAÇÃO -> FILIAL)
	//Sessão
	include('../../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../functions.php");
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(297, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
		
		$cidade = isset($_POST['cidade'])?$_POST['cidade']:'';
		$filial	= isset($_POST['filial'])?$_POST['filial']:'';
		
		$sql = 'DELETE FROM EMPRESA_ATUACAO  WHERE EMPCOD = '.$filial.' AND CIDCOD = '.$cidade;
					  
		$insert = oci_parse($conecta,$sql);
		
		
		if(oci_execute($insert)){
			$texto = 'Desvinculado com sucesso';
			$retorno = 0;
		}else{
			$texto = 'Falha ao incluir';
			$retorno = 0;			
		}
		
	}else{
		$texto = 'Usuário não tem permissão para incluir';
		$retorno = 0;
	}
	
	$pergunta = array();
	$pergunta[] = array(
				'codigo' =>$retorno,
				'mensagem'	 =>$texto,
		);

	echo( json_encode( $pergunta ) );

	?>
