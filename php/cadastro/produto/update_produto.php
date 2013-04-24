<?php 
	error_reporting(0);
	
	//UPDATE NA TABELA PRODUTO (Cadastros -> Produtos -> Produtos)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(135, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		
		//Validação de variaveis obrigatorias
		if(!isset($_POST['descricao']) || empty($_POST['descricao'])){
			$texto = 'Variável descrição está vazia.';
			$retorno = 0;
		}else{
			if(!isset($_POST['estoque']) || empty($_POST['estoque'])){
				$texto = 'Variável estoque está vazia.';
				$retorno = 0;
			}else{
				
				//Grava no banco
				include('../../classes/bd_oracle.class.php'); 
				
				//Recebe as variaveis por POST 
				$var = $_POST;
				
				foreach($var as $campo => $valor){
					
					$$campo = $valor;
					if(empty($$campo)){
						
						$$campo = '';
					}
					//echo $campo .'='. $valor. '<br>';
				}		
				//SQL
				$sql = "UPDATE PRODUTO
						   SET PRODES       = '".$descricao."',
							   PROCODBAR    = '".$codigo_barra."',
							   UNIMEDCOD    = '".$unidade_medida."',
							   PROCONEST    = '".$estoque."',
							   USUCOD       = ".$sessao->getNode('usuario_citrino').",
							   PROGRUCOD    = ".checkInteiro($grupo).",
							   PROSUBGRUCOD = ".checkInteiro($subgrupo).",
							   PRONCM       = '".$ncm."',
							   PROLAR       = ".checkInteiro($largura).",
							   PROALT       = ".checkInteiro($altura).",
							   PROCOM       = ".checkInteiro($comprimento).",
							   PROPESLIQ    = ".checkInteiro($peso_liquido).",
							   PROPESBRU    = ".checkInteiro($peso_bruto).",
							   PROPESBRU    = '".$tipo."',
							   PROCOR		= '".$cor."'
						 WHERE EMPCOD = ".$sessao->getNode('empresa_acessada')."
						   AND PROCOD = ".$codigo;
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						$texto = 'Produto alterado com sucesso';
						$retorno = $codigo;
						
						
					}else{
						$erro = oci_error($result);
						//echo '<pre>';print_r($erro);echo '</pre>';
						$texto = 'Falha ao Gravar';
						$retorno = 0;
					}
				}catch(Excpetion $e){
					$texto =  'Erro inesperado';
					$retorno = 0;
				}
			}
		}
	}else{
		$texto = 'Usuário não tem permissão para alterar';
		$retorno = 0;
	}
	
	$produto = array();
	$produto[] = array(
				'codigo' =>$retorno,
				'texto'	 =>$texto,
		);

	echo( json_encode( $produto ) );

	?>
