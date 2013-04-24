<?php 
	//ADD_NOVO_ESTADO (Cadastros -> Localidade -> Estados)
	//Validação
	
	error_reporting(0);
	
	if(!isset($_POST['nome_']) || empty($_POST['nome_'])){
		echo 'Variável descrição está vazia.';
	}else{
		if(!isset($_POST['abreviatura_']) || empty($_POST['abreviatura_'])){
			echo 'Variável abreviatura está vazia';
		}else{
			if(!isset($_POST['codigo_pais_']) || empty($_POST['codigo_pais_'])){
				echo 'Variável Código do País';
			}else{
				
				//Grava no banco
				include('../../classes/bd_oracle.class.php'); 
				$nome = strip_tags($_POST['nome_']);
				$abreviatura = strip_tags($_POST['abreviatura_']);
				$codigo_pais = strip_tags($_POST['codigo_pais_']);
		
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
			}
		}
	}
	?>
