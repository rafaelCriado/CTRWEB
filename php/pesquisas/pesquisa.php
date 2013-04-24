<?php 
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include('../classes/bd_oracle.class.php');
	include '../functions.php';
	
	$entidade = array();
	if($_POST){
		$numeroPergunta = 1;
		$cliente 		= isset($_POST['cliente'])?$_POST['cliente']: '';
		
		if(!empty($cliente)){
			
			
			$sql = "SELECT PP.PESPERCOD AS PERGUNTA_CODIGO,
						   PP.PESPERDES AS PERGUNTA,
						   PR.PESPERCOD AS CODIGO,
						   PR.ENTCOD    AS CLIENTE,
						   PR.USUCOD    AS USUARIO,
						   PR.PESRESDES AS DESCRICAO
					  FROM PESQUISAS_RESPOSTAS PR, PESQUISAS_PERGUNTAS PP
					 WHERE PP.PESPERCOD = PR.PESPERCOD(+)
					   AND PP.PESPERCOD = " . $numeroPergunta . "
					   AND PR.ENTCOD 	= " . $cliente;
			
			$res = oci_parse($conecta,$sql);
			if(oci_execute($res)){
				$row = oci_fetch_object( $res );
			    
				if(!empty($row->DESCRICAO)){
				
					//Resposta existe
					$retorno = 1;
					$texto	 = $row->DESCRICAO;
					$codigo_pergunta = '';
					
				}else{
					
					//Resposta não existe
					$sql_pergunta = 'SELECT PESPERCOD AS CODIGO, PESPERDES AS DESCRICAO FROM PESQUISAS_PERGUNTAS WHERE PESPERCOD = '.$numeroPergunta;
					
					$query_pergunta = oci_parse($conecta,$sql_pergunta);
					
					if(oci_execute($query_pergunta)){
						
						$pergunta = oci_fetch_object($query_pergunta);
						if(!empty($pergunta->DESCRICAO)){
							
							//Retorna a pergunta
							$retorno = 2;
							$texto = $pergunta->DESCRICAO;
							$codigo_pergunta = $pergunta->CODIGO;					
						}
						
					}else{
						
						//Erro na execução de select
						$retorno = 0;
						$texto	 = 'Erro na consulta!';
					}
					
					
				}
			}else{
			
				//Erro na execução do select
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
