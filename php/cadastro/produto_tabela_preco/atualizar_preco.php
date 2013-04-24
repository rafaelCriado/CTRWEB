<?php 
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	//error_reporting(0);

	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(136, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						

		if(!isset($_GET['valor']) || empty($_GET['valor'])){
			$msg = 'Variável valor está vazia.';
			$retorno = 0;
		}else{
				
			//Grava no banco
			include('../../classes/bd_oracle.class.php');
			$produto	= strip_tags($_GET['produto']);
			$tabela		= strip_tags($_GET['tabela']);
			$valor		= strip_tags($_GET['valor']);
			
			
			//Verifica se existe
			
			$sql_consulta = "SELECT COUNT(*) AS CODIGO
							   FROM TABELA_PRECO_ITEM 
							  WHERE EMPCOD = ".$sessao->getNode('empresa_acessada')." 
							    AND TABPRECOD = ".$tabela." 
								AND PROCOD = ".$produto;
								
			$consulta_valor_produto = oci_parse($conecta,$sql_consulta);
			
			oci_execute($consulta_valor_produto);
			
			$result_consulta_produto = oci_fetch_object($consulta_valor_produto);
			
			if($result_consulta_produto->CODIGO == 0){
				//inserir VALOR
				$sql = "INSERT INTO TABELA_PRECO_ITEM
							  	(EMPCOD, TABPRECOD, PROCOD, TABPREITEVAL, USUCOD)
							VALUES
							  	(".$sessao->getNode('empresa_acessada').", ".$tabela.", ".$produto.", ".$valor.", ".$sessao->getNode('usuario_citrino').")";
				
				$resultado=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($resultado)){
						$msg = 'Preço alterado com sucesso';
						$retorno = 1;
					}else{
						$erro = oci_error($resultado);

						$msg = 'Falha ao Gravar';
						$retorno = 0;
					}
				}catch(Excpetion $e){
					$msg = 'Erro inesperado';
					$retorno = 0;
				}				
			}else{
				
				//SQL
				$sql = "UPDATE TABELA_PRECO_ITEM
						   SET TABPREITEVAL = ".$valor."
						 WHERE EMPCOD = ".$sessao->getNode('empresa_acessada')." 
						   AND TABPRECOD = ".$tabela."
						   AND PROCOD = ".$produto;
				
				$result = oci_parse($conecta,$sql);
				
				
				
				try{
					if(oci_execute($result)){
						$msg = 'Preço Atualizado';
						$retorno = 1;
					}else{
						$erro = oci_error($result);
						
						$msg = 'Falha ao Salvar';
						$retorno = 0;
						
					}
				}catch(Excpetion $e){
					$msg = 'Erro inesperado';
					$retorno = 0;
				}
				
			}
		}
	}else{
		$msg = 'Usuário não tem permissão para alterar';
		$retorno = 0;
	}
	
	$preco = array();
	$preco = array(
		'msg' => $msg,
		'retorno' => $retorno,
	);
	
	echo( json_encode( $preco ) );

	?>
