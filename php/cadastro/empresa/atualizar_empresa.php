<?php 
	//ADD_NOVA_EMPRESA(Cadastros -> EMPRESAS)
	//Validação
	
	error_reporting(0);

	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(126, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						

		if(!isset($_POST['razao_']) || empty($_POST['razao_'])){
			echo 'Variável Razão social está vazia.';
		}else{
			if(!isset($_POST['cnpj_']) || empty($_POST['cnpj_'])){
				echo 'Variável CNPJ está vazia';
			}else{
					
				//Grava no banco
				include('../../classes/bd_oracle.class.php');
				$codigo				= strip_tags($_POST['id']);
				$razao 				= strip_tags($_POST['razao_']);
				$fantasia 			= strip_tags($_POST['fantasia_']);
				$sigla 				= strip_tags($_POST['sigla_']);
				$cidade 			= strip_tags($_POST['cidade_']);
				$cnpj 				= strip_tags($_POST['cnpj_']);
				$ie 				= strip_tags($_POST['ie_']);
				$endereco 			= strip_tags($_POST['endereco_']);
				$bairro 			= strip_tags($_POST['bairro_']);
				$complemento		= strip_tags($_POST['complemento_']);
				$numero 			= strip_tags($_POST['numero_']);
				$cep 				= strip_tags($_POST['cep_']);
				$telefone 			= strip_tags($_POST['telefone_']);
				$email 				= strip_tags($_POST['email_']);
				$site 				= strip_tags($_POST['site_']);
				$indice_venda		= strip_tags($_POST['indice_venda_']);
				
				//SQL
				$sql = "UPDATE EMPRESA E  SET 
						   empnom = '$razao',
						   empnomfan = '$fantasia',
						   empsig = '$sigla',
						   empcnp = '$cnpj',
						   empie = '$ie',
						   empend = '$endereco',
						   empbai = '$bairro',
						   empendcom = '$complemento',
						   empendnum = '$numero',
						   empcep = '$cep',
						   emptel = '$telefone',
						   cidcod = '$cidade',
						   empema = '$email',
						   emphom = '$site',
						   empindvalmin = $indice_venda
						   
						WHERE E.EMPCOD = $codigo";
				
				$result=oci_parse($conecta,$sql);
				
				try{
					if(oci_execute($result)){
						echo '<span class="delivery_span_email">Empresa salva com sucesso</span>';
					}else{
						$erro = oci_error($result);
						//echo '<pre>';print_r($erro);echo '</pre>';
						echo 'Falha ao Salvar';
					}
				}catch(Excpetion $e){
					echo 'Erro inesperado';
				}
			}
		}
	}else{
		echo 'Usuário não tem permissão para alterar';
	}
	?>
