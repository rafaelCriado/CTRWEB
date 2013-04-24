<?php 
	error_reporting(0);
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	

	//Sessão
	include('../../../classes/session.class.php');
	
	//Inclui banco da dados e funções
	include('../../../classes/bd_oracle.class.php');
	include '../../../functions.php';
	
	//Inicia Sessão
	$sessao = new Session();
	
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(297, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						

		//Recebe informações
		if($_GET){
			//Recebe as variaveis por POST 
			$var = $_GET;
			
			foreach($var as $campo => $valor){
				
				$$campo = $valor;
				if(empty($$campo)){
					
					$$campo = '';
				}
				//echo $campo .'='. $valor. '<br>';
			}
			
			if(empty($valor_max)){
				$valor_max = 'NULL';
			}
			if(empty($parcela_max)){
				$parcela_max = 'NULL';
			}
			
			$fp = array();
			
				
			$sql_fp = "INSERT INTO CARTAO_CREDITO
						  (EMPCOD,
						   USUCOD,
						   CARCRERED,
						   CARCREDES,
						   CARCRETIP,
						   CARCREREP,
						   CARCREFEC,
						   FORNUMPAG,
						   CARCRENUMMAXPAR,
						   CARCREPAR)
						VALUES
						  (".$sessao->getNode('empresa_acessada').",
						   ".$sessao->getNode('usuario_citrino').",
						   '".$rede."',
						   '".$descricao."',
						   '".$transacao."',
						   ".$repasse.",
						   '".$fechamento."',
						   ".$recebimento.",
						   ".$maximo_parcela.",
						   ".$parcelamento.")";

			
			
			$insert_fp = oci_parse($conecta,$sql_fp);
			
			if(oci_execute($insert_fp)){
				
				$texto = 'Incluído com sucesso';
				$retorno = 1;
				
				
			}else{
				$texto = 'Falha ao gravar';
				$retorno = 0;
								
			}
				
		}else{
				$texto = 'Falha na requisição das informações';
				$retorno = 0;
		}
	}else{
		
		$texto = 'Usuario não tem permissão para incluir';	
		$retorno = 0;
	}
	
	$fp[] = array(
				'codigo_retorno' 	=>$retorno,
				'texto'				=>$texto,
		);

	echo( json_encode( $fp ) );

?>
