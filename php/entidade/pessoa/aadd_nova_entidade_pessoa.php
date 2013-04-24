<?php
	//error_reporting(0);

	include('../../classes/session.class.php');
	//Inicia a sessão
	$sessao = new Session();
	
	//error_reporting(1); 
	
	//Inclui banco de dados
	include('../../classes/bd_oracle.class.php');
	
	//Função limpa cpf_cnpj
	function limpaCPF($cpf_recebido){
		$cpf_recebido = str_replace('.','',$cpf_recebido);
		$cpf_recebido = str_replace('/','',$cpf_recebido);
		$cpf_recebido = str_replace('-','',$cpf_recebido);
		return $cpf_recebido;
	}
	
	//Corrige os numeros
	function corrigeNumber($numero){
		if(isset($numero) or !empty($numero)){
			return $numero = str_replace(',','.',$numero);
		}else{
			return 1;
		}
	}
	
	//Função corrige nome
	function corrigeNome($nome_recebido){
		if(is_string($nome_recebido)){
			$nome_recebido = strtoupper($nome_recebido);
			return $nome_recebido;
		}else{
			return $nome_recebido;
		}
	}
	
	//Função corrige data 
	function dataNascimento($nascimento){
		if(isset($nascimento)){
			$nascimento = explode("/",$nascimento);
			switch($nascimento[1]){
				case '01':
					$nascimento[1] = 'JAN';
					break;
				case '02':
					$nascimento[1] = 'FEV';
					break;
				case '03':
					$nascimento[1] = 'MAR';
					break;
				case '04':
					$nascimento[1] = 'ABR';
					break;
				case '05':
					$nascimento[1] = 'MAI';
					break;
				case '06':
					$nascimento[1] = 'JUN';
					break;
				case '07':
					$nascimento[1] = 'JUL';
					break;
				case '08':
					$nascimento[1] = 'AGO';
					break;
				case '09':
					$nascimento[1] = 'SET';
					break;
				case '10':
					$nascimento[1] = 'OUT';
					break;
				case '11':
					$nascimento[1] = 'NOV';
					break;
				case '12':
					$nascimento[1] = 'DEZ';
					break;
			}
			$nascimento = implode('-',$nascimento);
		}else{
			$nascimento = 'NULL';
		}
		return $nascimento;
	}

	

	//Recebe as variaveis por POST 
	$var = $_POST;
	
	foreach($var as $campo => $valor){
		
		$$campo = $valor;
		if(empty($$campo)){
			
			$$campo = ' ';
		}
		
	}
	//Consulta se já existe cliente com tal cpf/cnpj
	$query = oci_parse($conecta,"SELECT ENTCOD AS CODIGO FROM ENTIDADE WHERE ENTCNPJCPF = '".limpaCPF($cpf_cnpj)."'");
	oci_execute($query);
	
	$result = oci_fetch_object($query);
	
	if(isset($result->CODIGO) and !empty($result)){
		?><script type="text/javascript">alert('Cliente já cadastrado')</script><?php 
	}else{
	
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
								ENTCODREP) 
							VALUES (
								  '".corrigeNome($nome)."',
								  '".corrigeNome($apelido)."',
								  '".corrigeNome($endereco)."',
								  '$numero',
								  '".corrigeNome($bairro)."',
								  '".limpaCPF($cep)."',
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
								  NULL,
								  NULL,
								  NULL,
								  NULL,
								  NULL,
								  '$estado_civil',
								  0,
								  '$tempo_trabalho',
								  '$nome_conjuge',
								  '".limpaCPF($cpf_conjuge)."',
								  '$rg_conjuge',
								  '$local_trabalho_conjuge',
								  '$tempo_trabalho_conjuge',
								  0,
								  '',
								  '',
								  '',
								  '',
								  NULL,
								  NULL,
								  NULL )";
	
		//PREPARA A QUERY
		echo $sql;
		$insert_entidade = oci_parse($conecta,$sql);
	
		try{
			if(oci_execute($insert_entidade)){
				
				//Cadastrar Telefones
				if(!isset($entidade_fone_celular) or empty($entidade_fone_celular)){
					$entidade_fone_celular = "0";
				}
				if(!isset($entidade_fone_residencial) or empty($entidade_fone_residencial)){
					$entidade_fone_residencial = "00";
				}
				if(!isset($entidade_fone_comercial) or empty($entidade_fone_comercial)){
					$entidade_fone_comercial = "000";
				}
				//Pesquisa codigo de cadastro
				$query_cadastro = oci_parse($conecta,"SELECT E.ENTCOD AS CODIGO FROM ENTIDADE E WHERE E.ENTCNPJCPF = '".limpaCPF($cpf_cnpj)."'");
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
					echo $sqlcinco;

					//Cadastrar telefones
					$sql6 = "INSERT INTO ENT_FONE
							  (ENTCOD, ENTFONNUM, ENTFONDESC, ENTFONTIP, USUCOD)
							VALUES
							  (".$cadastro->CODIGO.", '".$entidade_fone_comercial."', 'COMERCIAL', 'COMERCIAL', ".$sessao->getNode('usuario_citrino').")";
					//echo $sql6;
					$insert_entidade_telefone3 = oci_parse($conecta,$sql6);
					oci_execute($insert_entidade_telefone3);

				}else{
					echo 'Falha ao cadastrar os telefones';
				}
				
				?><script type="text/javascript">alert('Cadastrado com Sucesso')</script><?php 
			}else{
				$erro = oci_error($result);
				//echo '<pre>';print_r($erro);echo '</pre>';
				?><script type="text/javascript">alert('Falha ao Cadastrar')</script><?php 
			}
		}catch(Excpetion $e){
			echo 'Erro inesperado';
		}

	}
	?>
