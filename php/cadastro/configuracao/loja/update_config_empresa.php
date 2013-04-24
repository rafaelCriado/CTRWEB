<?php 
	//ADD_NOVA_EMPRESA(Cadastros -> EMPRESAS)
	//Validação
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	//error_reporting(0);

	//Sessão
	include('../../../classes/session.class.php');
	$sessao = new Session();
		
	include('../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../functions.php");
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(136, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
		
		
		$tabela_preco   		= isset($_POST['tabela_preco'])?$_POST['tabela_preco']:'';
		$condicao_pagamento   	= isset($_POST['condicao_pagamento'])?$_POST['condicao_pagamento']:'';
		$empresa 				= $sessao->getNode('empresa_acessada');	 
		
		if(empty($tabela_preco)){
			$codigo_retorno = 0;
			$texto = 'Escolha uma tabela de preço';
		}else{
			$set = '';
			if(!empty($condicao_pagamento)){
				$set .= ', conpagcod = '. $condicao_pagamento;
			}
			
			
			//SQL
			$sql = "UPDATE CONFIG_EMPRESA
					   SET ORC_TABPRE = " . $tabela_preco . $set ."
					 WHERE EMPCOD = " . $empresa ;
			
			$result = oci_parse($conecta, $sql);
			
			try{
				if(oci_execute($result)){
					$codigo_retorno = 1;
					$texto = 'Configuração salva com sucesso';
				}else{
					$erro = oci_error($result);
					$codigo_retorno = 0;
					$texto = 'Erro ao salvar';
				}
			}catch(Excpetion $e){
					$codigo_retorno = 0;
					$texto = 'Erro inesperado';
			}
		}
	}else{
					$codigo_retorno = 0;
					$texto = 'Usuario não tem permissão';
	}
	
	$retorno[] = array(
		'mensagem'	=> $texto,
		'codigo'	=> $codigo_retorno
	);
	
	echo (json_encode( $retorno ));
	?>
