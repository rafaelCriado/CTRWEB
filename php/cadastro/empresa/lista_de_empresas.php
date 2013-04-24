<?php 
	error_reporting(0);
	include('../../classes/bd_oracle.class.php'); 
	include('../../functions.php'); 
?>

<table width="100%">
    <tr>
        <td colspan="8" class="k-header title">
            Empresas Cadastradas
        </td>
    </tr>
    <tr>
        
        <td><strong>Razão Social</strong></td>
        <td><strong>Nome Fantasia</strong></td>
        <td><strong>Cadastrada em</strong></td>
        <td><strong>Sigla</strong></td>
        <td><strong>CNPJ</strong></td>
        <td><strong>IE</strong></td>
        <td><strong>Cidade</strong></td>
        <td></td>
    </tr> 
    
    <?php
		
		//Consulta Estados Cadastrados
		$query = oci_parse($conecta, 
			'SELECT 
			  E.EMPCOD AS CODIGO,
			  E.EMPNOM AS RAZAO_SOCIAL,
			  E.EMPNOMFAN AS FANTASIA,
			  E.EMPDATCAD AS DATA_CADASTRO,
			  E.EMPSIG AS SIGLA,
			  E.EMPCNP AS CNPJ,
			  E.EMPIE  AS IE,
			  E.EMPEND AS ENDERECO,
			  E.EMPBAI AS BAIRRO,
			  E.EMPENDCOM AS COMPLEMENTO,
			  E.EMPENDNUM AS NUMERO,
			  E.EMPCEP AS CEP,
			  E.EMPTEL AS TELEFONE,
			  C.CIDNOM AS CIDADE,
			  E.EMPEMA AS EMAIL,
			  E.EMPHOM AS SITE
			FROM 
			  EMPRESA E, CIDADE C
			WHERE
			  E.CIDCOD = C.CIDCOD'
			);
			
		oci_execute($query);

        while ($row = oci_fetch_object($query)) {
            ?>
            <tr id="<?php echo $row->CODIGO; ?>">
                <td title="<?php echo utf8_encode($row->RAZAO_SOCIAL); ?>"><?php echo textoFORMAT($row->RAZAO_SOCIAL,9);?></td>
                <td title="<?php echo utf8_encode($row->FANTASIA); ?>"><?php echo textoFORMAT($row->FANTASIA,9);?></td>
                <td><?php echo utf8_encode($row->DATA_CADASTRO)?></td>
                <td><?php echo utf8_encode($row->SIGLA)?></td>
                <td title="<?php echo utf8_encode($row->CNPJ); ?>"><?php echo textoFORMAT($row->CNPJ,9);?></td>
                <td title="<?php echo utf8_encode($row->IE); ?>"><?php echo textoFORMAT($row->IE,9);?></td>
                <td title="<?php echo utf8_encode($row->CIDADE); ?>"><?php echo textoFORMAT($row->CIDADE,9);?></td>
                <td>
                    <a href="" class="k-button" id="<?php echo $row->CODIGO; ?>" name="nova_empresa_bt_alterar" title="<?php echo $row->CODIGO;?>">
                        Alterar
                    </a>
                    <a href="" class="k-button" id="excluir" name="nova_empresa_bt_excluir" title="<?php echo $row->CODIGO;?>">
                        Excluir
                    </a>
                </td>
            </tr> 
            <?php
        }
    ?>
</table>