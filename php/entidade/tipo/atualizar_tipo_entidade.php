<?php 
	error_reporting(0);
	
	//UPDATE NA TABELA TIPO_ENT (Cadastros -> Pessoas -> Tipo)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	
	//CONTROLE DE ACESSO
	$acessar = acessaTela(130, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){		
	
	if(!isset($_POST['codigo_']) || empty($_POST['codigo_'])){
		echo 'Variável código está vazia.';
	}else{
		if(!isset($_POST['descricao_']) || empty($_POST['descricao_'])){
			echo 'Variável descrição está vazia';
		}else{
				
			//Grava no banco
			include('../../classes/bd_oracle.class.php');
			$codigo 	 	 = strip_tags($_POST['codigo_']);
			$descricao 	 	 = strip_tags($_POST['descricao_']);
			$classificacao 	 = strip_tags($_POST['classificacao_']);
			
			//SQL
			$sql = "UPDATE CATEG_ENTIDADE SET CATENTCODESTR = '$codigo', CATENTDESC = '$descricao', CATENTCLA = '$classificacao' WHERE CATENTCODESTR = '$codigo' AND EMPCOD = ".$sessao->getNode('empresa_acessada');
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					echo '<span class="delivery_span_email">Tipo de entidade salva com sucesso</span>';
					echo $site;
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
		echo 'Usuário não tem permissão para alterar!';
	}
	?>
