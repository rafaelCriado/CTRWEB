<?php 
	error_reporting(0);
	
	//ADICIONAR NA TABELA ESTADO (Cadastros -> LOCALIDADE -> ESTADOS)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(127, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['nome_']) || empty($_POST['nome_'])){
			echo 'Variável descrição está vazia.';
		}else{
			if(!isset($_POST['abreviatura_']) || empty($_POST['abreviatura_'])){
				echo 'Variável abreviatura está vazia';
			}else{
				if(!isset($_POST['codigo_pais_']) || empty($_POST['codigo_pais_'])){
					echo 'Variável Código do País';
				}else{
					
					include('../../classes/bd_oracle.class.php'); 
					
					
					$nome = strip_tags($_POST['nome_']);
					$abreviatura = strip_tags($_POST['abreviatura_']);
					$codigo_pais = strip_tags($_POST['codigo_pais_']);

					//Verifica se já não está cadastrado
					$sql_estado = "SELECT COUNT(*) AS CADASTROS FROM UF WHERE UFNOM = '".$nome."' OR UFABREV = '".$abreviatura."'";
					
					$query_estado = oci_parse($conecta, $sql_estado);
					
					oci_execute($query_estado);
					
					$estado = oci_fetch_object($query_estado);

					if($estado->CADASTRADOS > 0){

						//SQL
						$sql = "INSERT INTO 
									UF (UFNOM, UFCODPAIS, UFABREV )
								VALUES
									('".$nome."', '".$codigo_pais."','".$abreviatura."')";
						
						$result=oci_parse($conecta,$sql);
						
						try{
							if(oci_execute($result)){
								echo '<span class="delivery_span_email">Estado incluído com sucesso</span>';
							}else{
								$erro = oci_error($result);
								//echo '<pre>';print_r($erro);echo '</pre>';
								echo 'Falha ao Gravar';
							}
						}catch(Excpetion $e){
							echo 'Erro inesperado';
						}
						
					}else{
						
						echo 'Estado já existe!';
						
					}
				}
			}
		}
	}else{
		echo 'Usuário não tem permissão para incluir';
	}
	?>
