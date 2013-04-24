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
		
		
		if($_GET){
			
			$codigo_tabela  = isset($_GET['codigo_tabela']) ?	$_GET['codigo_tabela']:'';
			$codigo_produto = isset($_GET['codigo_produto']) ?	$_GET['codigo_produto']:'';
			$codigo_usuario = $sessao->getNode('usuario_citrino');
			
			
			if(!empty($codigo_tabela)){
				
				$sql = "BEGIN SP_CALCULO_TABELA_PRECO ( :CODIGO_TABELA,  :CODIGO_PRODUTO,  :USUARIO,  :EXECUTADO, :MENSAGEM, :VALOR); END;";
		
				//INTERPRETA
				$sql = oci_parse($conecta, $sql);
				
				//PASSA VARIÁVEIS PHP PARA O ORACLE 
				oci_bind_by_name($sql, ":CODIGO_TABELA", 	$codigo_tabela);
				oci_bind_by_name($sql, ":CODIGO_PRODUTO", 	$codigo_produto);
				oci_bind_by_name($sql, ":USUARIO", 			$codigo_usuario);
				oci_bind_by_name($sql, ":EXECUTADO", 		$ret, 100);
				oci_bind_by_name($sql, ":MENSAGEM", 		$mensagem, 200);
				oci_bind_by_name($sql, ":VALOR", 			$prc, 200);
				
				//EXECUTA
				oci_execute($sql,OCI_DEFAULT);
				oci_commit($conecta);
				
				if($ret == 1){
					
					$msg 	 = $mensagem;
					$retorno = $ret;
					$valor	 = '';
					
				}else if($ret == 0){
					
					$msg 	 = $mensagem;
					$retorno = $ret;
					$valor	 = '';
				}else if($ret == 2){
					$msg 	 = $mensagem;
					$retorno = $ret;
					$valor	 = number_format($prc,2,',','.');
				}
				
			}else{
				
				$msg     = 'Código da tabela está vazio';
				$retorno = 0;
				$valor	 = '';
				
			}
			
			
		}
		
	}else{
		$msg = 'Usuário não tem permissão para alterar';
		$retorno = 0;
		$valor	 = '';
	}
	
	$preco = array();
	$preco = array(
		'msg' => $msg,
		'retorno' => $retorno,
		'valor'	=>  $valor
	);
	
	echo( json_encode( $preco ) );

	?>
