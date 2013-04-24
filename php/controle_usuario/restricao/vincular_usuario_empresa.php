<input type="hidden" name="vincular_empresa_grupo_usuario">
<?php 
	error_reporting(0);
	//Grava no banco
	include('../../classes/bd_oracle.class.php'); 

	
	if(isset($_REQUEST['usuario']) and !empty($_REQUEST['usuario'])){
		foreach($_REQUEST['empresas'] as $campo=>$valor){
			
			$usuario = $_REQUEST['usuario'];
			
			//Pesquisa se empresa já não está cadastrada
			$query_pesquisa = oci_parse($conecta,
				"SELECT  
					UE.USUCOD USUARIO,
					UE.EMPCOD CODIGO,
					E.EMPNOMFAN FANTASIA
				 FROM 
					USUARIO_EMPRESA UE, EMPRESA E
				 WHERE
					UE.EMPCOD = E.EMPCOD AND
					UE.USUCOD = $usuario AND 
					UE.EMPCOD = $valor");
			
			oci_execute($query_pesquisa);
			$result_pesquisa = oci_fetch_object($query_pesquisa);
			if(!empty($result_pesquisa->CODIGO)){
				echo '<BR>USUARIO JÁ CADASTRADO PARA '.$result_pesquisa->FANTASIA;
			}else{
				
				//CADASTRADO
				
				$sql = "INSERT INTO 
							USUARIO_EMPRESA(USUCOD, EMPCOD)
						VALUES
							(".$usuario.",".$valor.")";
			
				$result=oci_parse($conecta,$sql);
				
				if(oci_execute($result)){
					echo 'EMPRESA VINCULADA.';
				}
			}
		}
	}else if(isset($_GET['grupo']) and !empty($_GET['grupo'])){
				foreach($_REQUEST['empresas'] as $campo=>$valor){
			
			$grupo = $_GET['grupo'];
			
			//Pesquisa se empresa já não está cadastrada
			$query_pesquisa = oci_parse($conecta,
				"SELECT  
					UE.USUGRUCOD USUARIO,
					UE.EMPCOD CODIGO,
					E.EMPNOMFAN FANTASIA
				 FROM 
					USUARIO_GRUPO_EMPRESA UE, EMPRESA E
				 WHERE
					UE.EMPCOD = E.EMPCOD AND
					UE.USUGRUCOD = $grupo AND 
					UE.EMPCOD = $valor");
			
			oci_execute($query_pesquisa);
			$result_pesquisa = oci_fetch_object($query_pesquisa);
			if(!empty($result_pesquisa->CODIGO)){
				echo '<BR>USUARIO JÁ CADASTRADO PARA '.$result_pesquisa->FANTASIA;
			}else{
				
				//CADASTRADO
				
				$sql = "INSERT INTO 
							USUARIO_GRUPO_EMPRESA(USUGRUCOD, EMPCOD)
						VALUES
							(".$grupo.",".$valor.")";
			
				$result=oci_parse($conecta,$sql);
				
				if(oci_execute($result)){
					echo 'EMPRESA VINCULADA.';
					
				}
			}
		}
	}
?>
