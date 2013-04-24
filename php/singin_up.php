<?php
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	
	//INCLUI CLASSE DE SESSÃO
	include('classes/session.class.php');
	$sessao = new Session();
	$sessao->init(3600);
	
	
	error_reporting(0);
	require 'classes/bd_oracle.class.php';
	include 'functions.php';
	
	
	$sessao->addNode('erro',0);
	
	$texto 		= '';
	$retorno 	= '';
	
	
	if($_POST){
		
		$usuario 	= addslashes($_POST['usuario']);
		$senha 		= addslashes($_POST['senha']);
		
		$checa_senha = oci_parse($conecta, $sql = "select t.usunom usuario, t.usupass senha, t.usucod codigo_usuario from usuario t where t.usunom = '$usuario' AND t.usupass = '$senha'");
		
		oci_execute($checa_senha);
		
		$user = oci_fetch_object($checa_senha);
				
		if(isset($user->CODIGO_USUARIO) and !empty($user->CODIGO_USUARIO)){
						
			$sessao->addNode('login_citrino',1);
			$sessao->addNode('usuario_citrino',$user->CODIGO_USUARIO);
			$sessao->addNode('usuario',$user->USUARIO);
			
			$sql_numero = 'SELECT COUNT(*) AS LINHAS FROM USUARIO_EMPRESA UE , EMPRESA E WHERE UE.EMPCOD = E.EMPCOD AND UE.USUCOD = '.$user->CODIGO_USUARIO;
			
			$query_numero_empresa = oci_parse($conecta,$sql_numero);
			
			oci_execute($query_numero_empresa);
			
			$row_empresa = oci_fetch_object($query_numero_empresa);
			
			if( $row_empresa->LINHAS > 0 ){

			
				//pesquisa empresa
				$sql = 'SELECT E.EMPCOD AS CODIGO,  E.EMPNOM AS EMPRESA FROM USUARIO_EMPRESA UE , EMPRESA E WHERE UE.EMPCOD = E.EMPCOD AND UE.USUCOD ='.$user->CODIGO_USUARIO;
				
				$query_empresa = oci_parse($conecta, $sql);
				
				oci_execute($query_empresa);
				
				
				$texto .= 'Empresa: <select name="empresa_acesso" style="line-height:30px; height:30px; margin:5px;">';
				while($row = oci_fetch_object($query_empresa)){
				
				
					$texto .= '<option value="'.$row->CODIGO.'" title="'.$row->EMPRESA.'">'.textoFORMAT($row->EMPRESA,20).'</option>';
				
				
				}	
				$texto .= '</select><br><input type="submit" name="acesso_empresa" class="bt_logar" value="Acessar">';
				$retorno = $user->CODIGO_USUARIO;
			}else{
				$texto = 'Usuário não está cadastrado em nenhuma empresa!';
				$retorno = 0;
			}
		}else{
			$sessao->addNode('erro',"Usuário ou Senha inválidos");
			$texto .= 'Usuário ou Senha inválidos';
			$retorno = 0;
		}
	}else{
		$texto = 'Falha na transmissão dos dados!';
		$retorno = 0;
	}
	$user = array();
	$user = array(
		"msg" => $texto,
		"retorno" => $retorno
	);
	
	echo( json_encode( $user ) );
?>