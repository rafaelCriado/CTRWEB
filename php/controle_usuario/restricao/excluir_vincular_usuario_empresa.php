<?php 
	error_reporting(0);
	//Inclui o banco de dados
	include('../../classes/bd_oracle.class.php'); 

	if(isset($_POST['usuario']) and !empty($_POST['usuario'])){
		// Exclui caso for USUARIO
		//Variaveis
		$empresa 	= $_POST['empresa'];
		$usuario	= $_POST['usuario'];
		
		//Verifica se existe empresa cadastrada para aquele usuario
		$sql = 'SELECT USUCOD AS CODIGO FROM USUARIO_EMPRESA WHERE USUCOD = '.$usuario.' AND EMPCOD = '.$empresa;
		
		$query_empresa = oci_parse($conecta,$sql);
		
		oci_execute($query_empresa);
		
		$result = oci_fetch_object($query_empresa);
		
		if($result->CODIGO == $usuario ){
			
			//Deleta empresa por usuario
			$sql_delete = 'DELETE FROM USUARIO_EMPRESA WHERE USUCOD = '.$usuario.' AND EMPCOD = '.$empresa;
			
			$query_delete = oci_parse($conecta,$sql_delete);
			
			if(oci_execute($query_delete)){
				echo 'Empresa excluída com sucesso';
			}else{
				echo 'Falha ao excluir';
			}
		}else{
			echo 'Registro não existe'; 	
		}
	}else if(isset($_POST['grupo']) and !empty($_POST['grupo'])){
		
		//Exclui caso for GRUPO
		//Variaveis
		$empresa 	= $_POST['empresa'];
		$grupo		= $_POST['grupo'];
		
		//Verifica se existe empresa cadastrada para aquele usuario
		$sql = 'SELECT USUGRUCOD AS CODIGO FROM USUARIO_GRUPO_EMPRESA WHERE USUGRUCOD = '.$grupo.' AND EMPCOD = '.$empresa;
		
		$query_empresa = oci_parse($conecta,$sql);
		
		oci_execute($query_empresa);
		
		$result = oci_fetch_object($query_empresa);
		
		if($result->CODIGO == $grupo ){
			
			//Deleta empresa por usuario
			$sql_delete = 'DELETE FROM USUARIO_GRUPO_EMPRESA WHERE USUGRUCOD = '.$grupo.' AND EMPCOD = '.$empresa;
			
			$query_delete = oci_parse($conecta,$sql_delete);
			
			if(oci_execute($query_delete)){
				echo 'Empresa excluída com sucesso';
			}else{
				echo 'Falha ao excluir';
			}
		}else{
			echo 'Registro não existe'; 	
		}
	}else{
		echo 'Falha de requisição!';
	}
?>