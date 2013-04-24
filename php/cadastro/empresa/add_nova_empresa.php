<?php 
	error_reporting(0);
	
	//INSERT NA TABELA EMPRESA (Cadastros -> EMPRESAS)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(126, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
	
		
		
		if(!isset($_POST['razao_']) || empty($_POST['razao_'])){
			echo 'Variável Razão social está vazia.';
		}else{
			if(!isset($_POST['cnpj_']) || empty($_POST['cnpj_'])){
				echo 'Variável CNPJ está vazia';
			}else{
						
				//Grava no banco
				include('../../classes/bd_oracle.class.php'); 
				$razao 				= strip_tags($_POST['razao_']);
				$fantasia 			= strip_tags($_POST['fantasia_']);
				$sigla 				= strip_tags($_POST['sigla_']);
				$cnpj 				= strip_tags($_POST['cnpj_']);
				$ie 				= strip_tags($_POST['ie_']);
				$endereco 			= strip_tags($_POST['endereco_']);
				$bairro 			= strip_tags($_POST['bairro_']);
				$complemento		= strip_tags($_POST['complemento_']);
				$numero 			= strip_tags($_POST['numero_']);
				$cep 				= strip_tags($_POST['cep_']);
				$telefone 			= strip_tags($_POST['telefone_']);
				$cidade 			= strip_tags($_POST['cidade_']);
				$email 				= strip_tags($_POST['email_']);
				$site 				= strip_tags($_POST['site']);
				$indice_venda		= strip_tags($_POST['indice_venda_']);
				
				
				//Consulta empresa
				
				
				//SQL
				$sql = "INSERT INTO 
							EMPRESA(EMPNOM,EMPNOMFAN, EMPDATCAD,EMPSIG,EMPCNP,EMPIE,EMPEND,EMPBAI,EMPENDCOM,
				   EMPENDNUM,EMPCEP,EMPTEL,CIDCOD,EMPEMA,EMPHOM, EMPINDVALMIN) 
						VALUES 
							('$razao','$fantasia',TRUNC(SYSDATE), '$sigla', '$cnpj', '$ie', '$endereco', 
							'$bairro', '$complemento', '$numero', '$cep', '$telefone', $cidade, '$email', '$site', $indice_venda)";
				echo $sql;
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						echo '<span class="delivery_span_email">Empresa incluída com sucesso</span>';
					}else{
						$erro = oci_error($result);
						//echo '<pre>';print_r($erro);echo '</pre>';
						echo 'Falha ao Gravar';
					}
				}catch(Excpetion $e){
					echo 'Erro inesperado';
				}
			}
		}
	}else{
		echo 'Usuário não tem permissão para incluir';
	}

	?>
