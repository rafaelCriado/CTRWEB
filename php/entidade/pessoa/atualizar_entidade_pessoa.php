<?php
	//Página de inclusão na tabela ENTIDADE e ENT_FONE
	error_reporting(0);
	
	//Sessão
	include('../../classes/session.class.php');
	$sessao = new Session();
	
	//Não deixa apresentar erros
	//error_reporting(0);
	
	//Inclui o banco de dados
	include("../../classes/bd_oracle.class.php");
	
	
	//Inclui funções
	include("../../functions.php");
	
	
	//Verifica permissão de gravação
 
	//CONTROLE DE ACESSO
	$acessar = acessaTela(129, $sessao->getNode('usuario_citrino'),'ALTERAR',$conecta);
	if(validaAcesso($acessar)){						
	
		//Recebe as variaveis por POST 
		$var = $_POST;
		foreach($var as $campo => $valor){
			
			$$campo = $valor;
			if(empty($$campo)){
				
				$$campo = '';
			}
			
		}
		if(!isset($salario) or empty($salario)){
			$salario = 0;
		}
		if(!isset($salario_conjuge) or empty($salario_conjuge)){
			$salario_conjuge = 0;
		}
		

		//Consulta se já existe cliente com tal cpf/cnpj
		$query = oci_parse($conecta,"SELECT ENTCOD AS CODIGO FROM ENTIDADE WHERE ENTCNPJCPF = '".limpaCPF($cpf_cnpj)."'");
		oci_execute($query);
		
		$result = oci_fetch_object($query);
		
		if(!isset($result->CODIGO) and empty($result)){
			?><script type="text/javascript">alert('Cliente não cadastrado')</script><?php 
		}else{
			//SQL
			
			$sql = "UPDATE ENTIDADE
					   SET ENTNOM 			= '".corrigeNome($nome)."',
						   ENTNOMFAN 		= '".corrigeNome($apelido)."',
						   ENTEND 			= '".corrigeNome($endereco)."',
						   ENTNUM 			= '$numero',
						   ENTBAI 			= '".corrigeNome($bairro)."',
						   ENTCEP 			= '".limpaCPF($cep)."',
						   CIDCOD 			= $cidade,
						   ENTCNPJCPF 		= '".limpaCPF($cpf_cnpj)."',
						   ENTINSEST 		= '$ie',
						   ENTDATCAD 		= TRUNC(SYSDATE),
						   ENTHOMPAG		= '$site',
						   USUCOD 			= ".$sessao->getNode('usuario_citrino').",
						   CATENTCODESTR 	= '$categoria',
						   ENTNOMMAE 		= '$mae',
						   ENTNOMPAI 		= '$pai',
						   ENTRG 			= '$rg',
						   ENTEMA 			= '$email',
						   ENTLOCTRA 		= '$local_trabalho',
						   ENTENDTRA 		= '$endereco_trabalho',
						   ENTATI 			= $entidade_ativo,
						   ENTPRO 			= '$profissao',
						   ENTDATNAS 		= '".dataNascimento($data_nascimento)."',
						   ENTTIPPES 		= '$tipo_pessoa',
						   ENTCON 			= 'CONTATO',
						   ENTENDCOB 		= '$endereco_cobranca',
						   ENTNUMCOB 		= '$numero_cobranca',
						   ENTBAICOB 		= '$bairro_cobranca',
						   ENTCEPCOB 		= '".limpaCPF($cep_cobranca)."',
						   CIDCODCOB 		= $cidade_cobranca,
						   ENTTEXLIV 		= 'OBSERVACAO',
						   ENTLIMCRE 		= ".checkNumber($limite_credito).",
						   ENTDATCONCRE 	= NULL,
						   ENTGER 			= '".corrigeNome($gerente)."',
						   ENTBLO 			= ".checkNumber($bloqueado).",
						   ENTCOMPRA 		= ".checkNumber($prazo).",
						   ENTESTCIV 		= '$estado_civil',
						   ENTSALTRA 		= ".checkNumber($salario).",
						   ENTTEMTRA 		= '$tempo_trabalho',
						   ENTNOMCON 		= '$nome_conjuge',
						   ENTCPFCON 		= '$cpf_conjuge',
						   ENTRGCON 		= '$rg_conjuge',
						   ENTLOCTRACON 	= '$local_trabalho_conjuge',
						   ENTTEMTRACON 	= '$tempo_trabalho_conjuge',
						   ENTSALCON 		= ".checkNumber($salario_conjuge).",
						   ENTRESCONCRE 	= '',
						   ENTCODVEN		= '',
						   ENTPRCPAG 		= '',
						   ENTENDCOM 		= '',
						   CFOCOD 			= NULL,
						   ENTREPCOM 		= NULL,
						   ENTCODREP 		= NULL
					 WHERE ENTCOD = $codigo";
			//echo $sql;
			

			//PREPARA A QUERY
			$insert_entidade = oci_parse($conecta,$sql);
		
			try{
				
				if(oci_execute($insert_entidade)){
					
					
					
					
					//Cadastrar Telefones
					
						//Pesquisa codigo de cadastro
						
						
							
							//Cadastrar telefones 
							$sql = "UPDATE ENT_FONE
									   SET ENTFONNUM 	= '".$entidade_fone_celular."',
										   USUCOD 		= ".$sessao->getNode('usuario_citrino')."
									 WHERE ENTCOD = ".$result->CODIGO." AND ENTFONDESC = 'CELULAR'";
							$insert_entidade_telefone1 = oci_parse($conecta,$sql);
							oci_execute($insert_entidade_telefone1);
	
	
							//Cadastrar telefones
							$sql1 = "UPDATE ENT_FONE
										SET ENTFONNUM 	= '".$entidade_fone_residencial."',
											USUCOD 		= ".$sessao->getNode('usuario_citrino')."
									  WHERE ENTCOD = ".$result->CODIGO." AND ENTFONDESC = 'RESIDENCIAL'";
							$insert_entidade_telefone2 = oci_parse($conecta,$sql1);
							oci_execute($insert_entidade_telefone2);
	
	
							//Cadastrar telefones
							$sql2 = "UPDATE ENT_FONE
									   SET ENTFONNUM 	= '".$entidade_fone_comercial."',
										   USUCOD 		= ".$sessao->getNode('usuario_citrino')."
									 WHERE ENTCOD = ".$result->CODIGO." AND ENTFONDESC = 'COMERCIAL'";
							//echo $sql2;
							$insert_entidade_telefone3 = oci_parse($conecta,$sql2);
							oci_execute($insert_entidade_telefone3);
							
					
					
					
					?><script type="text/javascript">alert('Alterações realizadas com Sucesso')</script><?php 
				}else{
					$erro = oci_error($result);
					//echo '<pre>';print_r($erro);echo '</pre>';
					?><script type="text/javascript">alert('Falha ao Salvar')</script><?php 
				}
			}catch(Excpetion $e){
				echo 'Erro inesperado';
			}
	
		}
	}else{
		?><script type="text/javascript">alert('Usuário não tem permissão para alterar!')</script><?php 
	}
	?>
