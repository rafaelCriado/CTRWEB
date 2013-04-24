<?php 
	error_reporting(0);

	//UPDATE NA TABELA USUARIO_RESTRICAO (Cadastros -> Controle de Usuario -> Restrições)
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
		
	include('../../classes/bd_oracle.class.php'); 

	//Inclui funções
	include("../../functions.php");
	//CONTROLE DE ACESSO
	$acessar = acessaTela(133, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar) or 1==1){						

		if(isset($_POST['usuario']) and !empty($_POST['usuario'])){
			//var_dump($_POST['array']);
		foreach($_POST['array'] as $campo=>$valor){
			
			$permissao = explode("_",$valor);
			$campos_sql = '';
			$campos = '';
			//echo $permissao[1].' - '.$permissao[2].' - '.$permissao[3].'<br>';
			$checado = $permissao[3];
			switch($permissao[2]){
				case "ACE":
					if(isset($checado) and $checado == "1"){
						$campos_sql = "USURESACE = 1";
					}else{
						$campos_sql = "USURESACE = 2";
					}
					break;
				case "ALT":
					if(isset($checado) and $checado == "1"){
						$campos_sql = "USURESALT = 1";
					}else {
						$campos_sql = "USURESALT = 2";
					}
					break;
				case "INC":
					if(isset($checado) and $checado == "1"){
						$campos_sql = "USURESINC = 1";
					}else {
						$campos_sql = "USURESINC = 2";
					}
					break;
				case "EXC":
					if(isset($checado) and $checado== "1"){
						$campos_sql = "USURESEXC = 1";
					}else {
						$campos_sql = "USURESEXC = 2";
					}
					break;
			}
			// Insert into several tables, rolling back the changes if an error occurs
	
			$stid = oci_parse($conecta, "UPDATE USUARIO_RESTRICAO SET ".$campos_sql." WHERE USUCOD = ".$_POST['usuario']." AND USUACECOD = $permissao[1]");
			
			// The OCI_NO_AUTO_COMMIT flag tells Oracle not to commit the INSERT immediately
			// Use OCI_DEFAULT as the flag for PHP <= 5.3.1.  The two flags are equivalent
			oci_execute($stid);
			
		}
	
		}else if(isset($_POST['grupo']) and !empty($_POST['grupo'])){
			//var_dump($_POST);
			foreach($_POST['array'] as $campo=>$valor){
				
				$permissao = explode("_",$valor);
				$campos_sql = '';
				$campos = '';
				//echo $permissao[1].' - '.$permissao[2].' - '.$permissao[3].'<br>';
				$checado = $permissao[3];
				switch($permissao[2]){
					case "ACE":
						if(isset($checado) and $checado == "1"){
							$campos_sql = "USUGRURESACE = 1";
						}else{
							$campos_sql = "USUGRURESACE = 2";
						}
						break;
					case "ALT":
						if(isset($checado) and $checado == "1"){
							$campos_sql = "USUGRURESALT = 1";
						}else {
							$campos_sql = "USUGRURESALT = 2";
						}
						break;
					case "INC":
						if(isset($checado) and $checado == "1"){
							$campos_sql = "USUGRURESINC = 1";
						}else {
							$campos_sql = "USUGRURESINC = 2";
						}
						break;
					case "EXC":
						if(isset($checado) and $checado== "1"){
							$campos_sql = "USUGRURESEXC = 1";
						}else {
							$campos_sql = "USUGRURESEXC = 2";
						}
						break;
				}
				// Insert into several tables, rolling back the changes if an error occurs
		
				$stid = oci_parse($conecta, "UPDATE USUARIO_GRUPO_RESTRICAO SET ".$campos_sql." WHERE USUGRUCOD = ".$_POST['grupo']." AND USUACECOD = $permissao[1]");
				
				// The OCI_NO_AUTO_COMMIT flag tells Oracle not to commit the INSERT immediately
				// Use OCI_DEFAULT as the flag for PHP <= 5.3.1.  The two flags are equivalent
				oci_execute($stid);
				
			}
		}
	}else{
		?><script>alert('Usuário não tem permissão para alterar!')</script><?php
	}
?>