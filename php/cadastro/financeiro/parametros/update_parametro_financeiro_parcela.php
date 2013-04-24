<?php 
	error_reporting(0);
	//UPDATE (CADASTRO ->FINANCEIRO -> PARAMETROS FINANCEIRO)
	//Sessão
	include('../../../classes/session.class.php');
	$sessao = new Session();
	
	//Banco	
	include('../../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../../functions.php");
	
	//Controle de Acesso
	$acessar = acessaTela(258, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		if(!isset($_POST['valor']) || empty($_POST['valor'])){
			echo 'Valor Vazio não pode ser salvo.';
		}else{
			
			//Grava no banco
			include('../../../classes/bd_oracle.class.php'); 
			
			//Recebe variaveis
			$parametro  = explode('|',$_POST['parametro']);
			$valor	    = $_POST['valor'];
			
			
			//Sql
			$sql = "UPDATE FINANCEIRAS_PARCELAS
					   SET FINPARIND = ".$valor.",
						   USUCOD = ".$sessao->getNode('usuario_citrino')."
					 WHERE FINCOD = ".$parametro[3]."
					   AND FINPARNUM = ".$parametro[0]."
					   AND FINPARCAR = ".$parametro[2]."
					   AND FINPARTOTPAR = ".$parametro[1];
			
			$result=oci_parse($conecta,$sql);
			
			try{
				if(oci_execute($result)){
					echo 'Alteração salva com sucesso';
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
		echo 'Usuário não tem permissão para alterar!';
	}
	?>
