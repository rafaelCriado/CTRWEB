<?php 
	header( 'Cache-Control: no-cache' );
	header( 'Content-type: application/xml; charset="utf-8"', true );
	
	include('../classes/bd_oracle.class.php');
	include '../functions.php';
	

	//Verifica se recebeu CPF por post
	if(isset($_POST['cpf']) and !empty($_POST['cpf'])){
		$valor = "ENTCNPJCPF = '".addslashes($_POST['cpf'])."'";
	}
	
	//Verifica se recebeu Nome por post
	if(isset($_POST['nome']) and !empty($_POST['nome'])){
		$valor = "ENTNOM = '".addslashes($_POST['nome'])."'";
	}

	//Verifica se recebeu Nome por post
	if(isset($_POST['entidade']) and !empty($_POST['entidade'])){
		$valor = "ENTCOD = ".addslashes($_POST['entidade']);
	}

	
	
	
	$entidade = array();
	
	$sql = "SELECT E.ENTCOD AS CODIGO,
				   E.ENTCNPJCPF AS CPF,
				   E.ENTNOM AS NOME,
				   E.ENTNOMFAN AS APELIDO,
				   E.ENTEND AS ENDERECO,
				   E.ENTNUM AS NUMERO,
				   E.ENTBAI AS BAIRRO,
				   E.ENTCEP AS CEP,
				   E.CIDCOD AS CODIGO_CIDADE,
				   U.UFCOD AS CODIGO_ESTADO,
				   E.ENTINSEST AS INSCRICAO_ESTADUAL,
				   TO_CHAR(E.ENTDATCAD, 'DD/MM/YYYY') AS DATA_CADASTRO,
				   E.ENTHOMPAG AS SITE,
				   E.USUCOD AS CODIGO_USUARIO,
				   E.CATENTCODESTR AS CATEGORIA,
				   E.ENTNOMMAE AS MAE,
				   E.ENTNOMPAI AS PAI,
				   E.ENTRG AS RG,
				   E.ENTEMA AS EMAIL,
				   E.ENTLOCTRA AS LOCAL_TRABALHO,
				   E.ENTENDTRA AS ENDERECO_TRABALHO,
				   E.ENTATI AS ATIVO,
				   E.ENTPRO AS PROFISSAO,
				   TO_CHAR(E.ENTDATNAS, 'DD/MM/YYYY') AS DATA_NASCIMENTO,
				   E.ENTTIPPES AS TIPO_PESSOA,
				   E.ENTCON AS CONTATO,
				   E.ENTENDCOB AS ENDERECO_COBRANCA,
				   E.ENTNUMCOB AS NUMERO_COBRANCA,
				   E.ENTBAICOB AS BAIRRO_COBRANCA,
				   E.ENTCEPCOB AS CEP_COBRANCA,
				   E.CIDCODCOB AS CODIGO_CIDADE_COBRANCA,
				   U.UFCOD 	   AS CODIGO_ESTADO_COBRANCA,
				   E.ENTTEXLIV AS TEXTO,
				   E.ENTLIMCRE AS LIMITE_CREDITO,
				   TO_CHAR(E.ENTDATCONCRE, 'DD/MM/YYYY') AS ENTDATCONCRE,
				   E.ENTGER AS GERENTE,
				   E.ENTBLO AS BLOQUEIO,
				   E.ENTCOMPRA AS COMPRA_A_PRAZO,
				   E.ENTESTCIV AS ESTADO_CIVIL,
				   E.ENTSALTRA AS SALARIO,
				   E.ENTTEMTRA AS TEMPO_TRABALHO,
				   E.ENTNOMCON AS CONJUGE,
				   E.ENTCPFCON AS CPF_CONJUGE,
				   E.ENTRGCON AS RG_CONJUGE,
				   E.ENTLOCTRACON AS LOCAL_TRABALHO_CONJUGE,
				   E.ENTTEMTRACON AS TEMPO_TRABALHO_CONJUGE,
				   E.ENTSALCON AS SALARIO_CONJUGE,
				   E.ENTRESCONCRE AS CONSULTA_CREDITO,
				   E.ENTCODVEN AS CODIGO_VENDEDOR,
				   E.ENTPRCPAG AS PRACA,
				   E.ENTENDCOM AS ENDERECO_COMPLEMENTO,
				   E.CFOCOD AS CFOP,
				   E.ENTREPCOM AS COMISSAO,
				   E.ENTCODREP AS REPRESENTANTE,
				   (SELECT F.ENTFONNUM
					  FROM ENT_FONE F
					 WHERE F.ENTFONDESC = 'CELULAR'
					   AND F.ENTCOD = E.ENTCOD) AS FONE_CELULAR,
				   (SELECT F.ENTFONNUM
					  FROM ENT_FONE F
					 WHERE F.ENTFONDESC = 'COMERCIAL'
					   AND F.ENTCOD = E.ENTCOD) AS FONE_COMERCIAL,
				   (SELECT F.ENTFONNUM
					  FROM ENT_FONE F
					 WHERE F.ENTFONDESC = 'RESIDENCIAL'
					   AND F.ENTCOD = E.ENTCOD) AS FONE_RESIDENCIAL
			  FROM ENTIDADE E, CIDADE C, UF U
			 WHERE E.CIDCOD = C.CIDCOD
			   AND C.CIDUFCOD = U.UFCOD
			   AND $valor";
	$res = oci_parse($conecta,$sql);
	oci_execute($res);
	$row = oci_fetch_assoc( $res );
	
	$entidade = $row;
	
	
	echo( json_encode( $entidade ) );
?>
