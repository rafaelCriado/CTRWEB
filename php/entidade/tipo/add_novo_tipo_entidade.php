<?php 
	error_reporting(0);
	
	//DELETE NA TABELA TIPO_ENT (Cadastros -> Pessoas -> Tipo)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(130, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){		
	
		
		if(!isset($_POST['descricao_']) || empty($_POST['descricao_'])){
			echo 'Variável descricao está vazia';
		}else{
			if(!isset($_POST['classificacao_']) || empty($_POST['classificacao_'])){
				echo 'Variável classificação esta vazia';
			}else{
					
					//Grava no banco
					include('../../classes/bd_oracle.class.php'); 
					
					$descricao = strip_tags($_POST['descricao_']);
					$classificacao = strip_tags($_POST['classificacao_']);
			
					//SQL
					$sql = "INSERT INTO 
								CATEG_ENTIDADE (CATENTDESC, CATENTCLA, USUCOD, EMPCOD )
							VALUES
								('".$descricao."','".$classificacao."',".$sessao->getNode('usuario_citrino').",".$sessao->getNode('empresa_acessada').")";
					
					$result=oci_parse($conecta,$sql);
					
					try{
						if(oci_execute($result)){
							echo '<span class="delivery_span_email">Categoria incluída com sucesso</span>';
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
		echo 'Usuário não tem permissão para incluir!';
	}
	?>
