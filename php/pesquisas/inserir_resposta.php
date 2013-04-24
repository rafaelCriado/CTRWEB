<?php 
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include('../classes/bd_oracle.class.php');
	include('../classes/session.class.php');
	$sessao = new Session();
	
	include '../functions.php';
	
	$entidade = array();
	if($_POST){
		$numeroPergunta = isset($_POST['pergunta'])?$_POST['pergunta']: '';
		$texto 			= isset($_POST['texto'])? $_POST['texto']: '';
		$cliente    	= isset($_POST['cliente'])? $_POST['cliente']: '';
		
		if(!empty($numeroPergunta)){
					//Resposta não existe
					$sql_pergunta = "INSERT INTO PESQUISAS_RESPOSTAS
											  (PESPERCOD, ENTCOD, USUCOD, PESRESDES)
											VALUES
											  (".$numeroPergunta.", ".$cliente.", ".$sessao->getNode('usuario_citrino').", '".$texto."')";
					
					$query_pergunta = oci_parse($conecta,$sql_pergunta);
					
					if(oci_execute($query_pergunta)){
						
						//Retorna a pergunta
						$retorno = 1;
						$texto = 'Salvo com sucesso';
						$codigo_pergunta = '';					
					
						
					}else{
						
						//Erro na execução de select
						$retorno = 0;
						$texto	 = 'Erro na consulta!';
						$codigo_pergunta = '';
					}
					
			
		}else{
			
			//Variavel cliente 
			$retorno = 0;
			$texto	 = 'Variavel cliente esta vazia!';
			$codigo_pergunta = '';
			
		}
	}else{
			//Variavel cliente 
			$retorno = 0;
			$texto	 = 'Erro de chamada';
			$codigo_pergunta = '';
	}
	
	
	$entidade[] = array(
		'codigo' => $retorno,
		'mensagem' => $texto,
		'pergunta' => $codigo_pergunta
	);
	
	
	echo( json_encode( $entidade ) );
?>
