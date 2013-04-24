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
	$acessar = acessaTela(136, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						

		if(!isset($_POST['subgrupo']) || empty($_POST['subgrupo'])){
			echo 'Variável Grupo está vazia.';
		}else{
				
			//Grava no banco
			include('../../classes/bd_oracle.class.php');
			$codigo_subgrupo	= strip_tags($_POST['codigo_subgrupo']);
			$grupo				= strip_tags($_POST['grupo']);
			$subgrupo			= strip_tags($_POST['subgrupo']);

			//SQL
			$sql = "update produto_subgrupo
					   set prosubgruden = '".$subgrupo."',
						   usucod = ".$sessao->getNode('usuario_citrino')."
					 where empcod = ".$sessao->getNode('empresa_acessada')."
					   and prosubgrucod = ".$codigo_subgrupo;
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					echo '<span class="delivery_span_email">Sub-Grupo salvo com sucesso</span>';
				}else{
					$erro = oci_error($result);
					//echo '<pre>';print_r($erro);echo '</pre>';
					echo 'Falha ao Salvar';
				}
			}catch(Excpetion $e){
				echo 'Erro inesperado';
			}

		}
	}else{
		echo 'Usuário não tem permissão para alterar';
	}
	?>
