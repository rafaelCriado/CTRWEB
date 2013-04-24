<?php
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
			
	//Página de inclusão na tabela ENTIDADE e ENT_FONE
	
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
	//Não deixa apresentar erros
	error_reporting(0);
	
	//Inclui o banco de dados
	include("../../classes/bd_oracle.class.php");
	
	
	//Inclui funções
	include("../../functions.php");
	
	
	//Verifica permissão de gravação
 
	//CONTROLE DE ACESSO
	$acessar = acessaTela(129, $sessao->getNode('usuario_citrino'),'INCLUIR',$conecta);
	if(validaAcesso($acessar)){						

	
	
	
	//RECEBE VARIAVEIS POR POST
	
	if($_POST){
		
		
		//Recebe as variaveis por POST 
		$var = $_POST;
		
		foreach($var as $campo => $valor){
			
			$$campo = $valor;
			if(empty($$campo)){
				
				$$campo = ' ';
			}
			//echo $campo .'='. $valor. '<br>';
		}
			
		//Consulta se já existe cliente com tal cpf/cnpj
		$query = oci_parse($conecta,"SELECT ENTCOD AS CODIGO FROM ENTIDADE WHERE ENTCNPJCPF = '".limpaCNPJ($cpf_cnpj)."' AND ENTNOM = '$nome'");
		oci_execute($query);
		
		$result = oci_fetch_object($query);
	
		if(isset($result->CODIGO) and !empty($result->CODIGO)){
				$texto = 'Cliente já cadastrado';
				$retorno = 0;
		}else{	
			if($salario == ' '){
				$salario = 0;
			}
			if($salario_conjuge == ' '){
				$salario_conjuge = 0;
			}
			$cidade_cobranca = 'NULL';
			if(!is_null($_POST['cidade_cobranca'])){
				$cidade_cobranca == $_POST['cidade_cobranca'];
			}
			
			
			
			//Verifica se cliente ja foi cadastrado =====================
				
				//include('duplicidade.php');
				
			// ==========================================================
			
			
			
			
			
			
			
			
			//SQL
			$sql = "INSERT INTO ENTIDADE( 
									ENTNOM, 
									ENTNOMFAN,
									ENTEND, 
									ENTNUM, 
									ENTBAI, 
									ENTCEP, 
									CIDCOD, 
									ENTCNPJCPF, 
									ENTINSEST, 
									ENTDATCAD, 
									ENTHOMPAG,
									USUCOD,
									CATENTCODESTR, 
									ENTNOMMAE, 
									ENTNOMPAI, 
									ENTRG, 
									ENTEMA, 
									ENTLOCTRA,
									ENTENDTRA, 
									ENTATI, 
									ENTPRO, 
									ENTDATNAS, 
									ENTTIPPES,
									ENTCON,
									ENTENDCOB,
									ENTNUMCOB,
									ENTBAICOB,
									ENTCEPCOB, 
									CIDCODCOB, 
									ENTTEXLIV, 
									ENTLIMCRE,
									ENTDATCONCRE, 
									ENTGER, 
									ENTBLO, 
									ENTCOMPRA, 
									ENTESTCIV, 
									ENTSALTRA,
									ENTTEMTRA,
									ENTNOMCON,
									ENTCPFCON, 
									ENTRGCON, 
									ENTLOCTRACON, 
									ENTTEMTRACON, 
									ENTSALCON, 
									ENTRESCONCRE, 
									ENTCODVEN,
									ENTPRCPAG, 
									ENTENDCOM, 
									CFOCOD, 
									ENTREPCOM,
									ENTCODREP,
									EMPCOD) 
								VALUES (
									  '".corrigeNome($nome)."',
									  '".corrigeNome($apelido)."',
									  '".corrigeNome($endereco)."',
									  '$numero',
									  '".corrigeNome($bairro)."',
									  '".limpaCNPJ($cep)."',
									  $cidade,
									  '".limpaCPF($cpf_cnpj)."',
									  '$ie',
									  TRUNC(SYSDATE),
									  '$site',
									  ".$sessao->getNode('usuario_citrino').",
									  '$categoria',
									  '$mae',
									  '$pai',
									  '$rg',
									  '$email',
									  '$local_trabalho',
									  '$endereco_trabalho',
									  $entidade_ativo,
									  '$profissao',
									  '".dataNascimento($data_nascimento)."',
									  '$tipo_pessoa',
									  'CONTATO',
									  '$endereco_cobranca',
									  '$numero_cobranca',
									  '$bairro_cobranca',
									  '".limpaCPF($cep_cobranca)."',
									  $cidade_cobranca,
									  'OBSERVACAO',
									  1".checkInteiro($limite_credito).",
									  NULL,
									  '".corrigeNome($gerente)."',
									  ".checkNumber($bloqueado).",
									  ".checkNumber($prazo).",
									  '$estado_civil',
									  ".checkNumber($salario).",
									  '$tempo_trabalho',
									  '$nome_conjuge',
									  '".limpaCPF($cpf_conjuge)."',
									  '$rg_conjuge',
									  '$local_trabalho_conjuge',
									  '$tempo_trabalho_conjuge',
									  ".checkNumber($salario_conjuge).",
									  '',
									  '',
									  '',
									  '',
									  NULL,
									  NULL,
									  NULL,
									  ".$sessao->getNode('empresa_acessada')." )";
			//echo $sql;
			//PREPARA A QUERY
			$insert_entidade = oci_parse($conecta,$sql);
		
			try{
				if(oci_execute($insert_entidade)){
					
					//Cadastrar Telefones
					if(!isset($entidade_fone_celular) or empty($entidade_fone_celular) or $entidade_fone_celular == ' '){
						$entidade_fone_celular = "0";
					}
					if(!isset($entidade_fone_residencial) or empty($entidade_fone_residencial) or $entidade_fone_residencial == ' '){
						$entidade_fone_residencial = "00";
					}
					if(!isset($entidade_fone_comercial) or empty($entidade_fone_comercial) or $entidade_fone_comercial == ' '){
						$entidade_fone_comercial = "000";
					}
					//Pesquisa codigo de cadastro
					$query_cadastro = oci_parse($conecta,"SELECT E.ENTCOD AS CODIGO FROM ENTIDADE E WHERE E.ENTCNPJCPF = '".limpaCPF($cpf_cnpj)."' OR E.ENTNOM = '$nome'");
					oci_execute($query_cadastro);
					$cadastro  = oci_fetch_object($query_cadastro);
					
					if(isset($cadastro->CODIGO) and !empty($cadastro->CODIGO)){
						
						//Cadastrar telefones 
						$sqlquatro = "INSERT INTO ENT_FONE
								  (ENTCOD, ENTFONNUM, ENTFONDESC, ENTFONTIP, USUCOD)
								VALUES
								  (".$cadastro->CODIGO.", '".$entidade_fone_celular."', 'CELULAR', 'CELULAR', ".$sessao->getNode('usuario_citrino').")";
						$insert_entidade_telefoneum = oci_parse($conecta,$sqlquatro);
						oci_execute($insert_entidade_telefoneum);
	
	
						//Cadastrar telefones
						$sqlcinco = "INSERT INTO ENT_FONE
								  (ENTCOD, ENTFONNUM, ENTFONDESC, ENTFONTIP, USUCOD)
								VALUES
								  (".$cadastro->CODIGO.", '".$entidade_fone_residencial."', 'RESIDENCIAL', 'RESIDENCIAL', ".$sessao->getNode('usuario_citrino').")";
						$insert_entidade_telefonesete = oci_parse($conecta,$sqlcinco);
						oci_execute($insert_entidade_telefonesete);
						
	
						//Cadastrar telefones
						$sql6 = "INSERT INTO ENT_FONE
								  (ENTCOD, ENTFONNUM, ENTFONDESC, ENTFONTIP, USUCOD)
								VALUES
								  (".$cadastro->CODIGO.", '".$entidade_fone_comercial."', 'COMERCIAL', 'COMERCIAL', ".$sessao->getNode('usuario_citrino').")";
						
						$insert_entidade_telefone3 = oci_parse($conecta,$sql6);
						oci_execute($insert_entidade_telefone3);
	
					}else{
						$texto = 'Falha ao cadastrar os telefones';
						$retorno = 0;
					}
					
					$texto = 'Cadastrado com Sucesso';
					$retorno = $cadastro->CODIGO;
				}else{

					$erro = oci_error($result);
					$texto = 'Falha ao Cadastrar'.$sql;
					$retorno = 0;
					
				}
			}catch(Excpetion $e){
					$texto = 'Erro inesperado!';
					$retorno = 0;
			}
		}
	}
	}else{
		$texto = 'Usuário não tem permissão para incluir!';
		$retono = 0;
	}
	$entidade = array();
	$entidade[] = array(
		"msg" => $texto,
		"retorno" => $retorno,
		"sql" => $sql,
	);
	echo( json_encode( $entidade ) );

?>