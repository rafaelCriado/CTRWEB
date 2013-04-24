<?php 
	error_reporting(0);
	
	//ADICIONAR NA TABELA FINANCEIRAS (Cadastros -> FINANCEIRO -> FINANCEIRAS)
	//Sessão
	include('../../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(277, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['nome_']) || empty($_POST['nome_'])){
			echo 'Variável descrição está vazia.';
		}else{
				
				
			include('../../../classes/bd_oracle.class.php'); 
			
			
			$nome = strip_tags($_POST['nome_']);

			//SQL
			$sql = "INSERT INTO TIPO_PAGAMENTO
					  ( TIPPAGDES, USUCOD, EMPCOD)
					VALUES
					  ( '".$nome."', ".$sessao->getNode('usuario_citrino').", ".$sessao->getNode('empresa_acessada').")";
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					echo '<span class="delivery_span_email">Tipo de Pagamento incluído com sucesso</span>';
				}else{
					$erro = oci_error($result);
					//echo '<pre>';print_r($erro);echo '</pre>';
					echo 'Falha ao Gravar';
				}
			}catch(Excpetion $e){
				echo 'Erro inesperado';
			}
		}
	}else{
		echo 'Usuário não tem permissão para incluir';
	}
	?>
