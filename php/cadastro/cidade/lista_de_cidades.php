<?php 
error_reporting(0);
include('../../../php/classes/bd_oracle.class.php'); 
?>

<table width="100%">
    <tr>
        <td colspan="10" class="k-header title">
            Cidades Cadastradas
        </td>
    </tr>
    <tr>
        <td><strong>Cidade</strong></td>
        <td><strong>Estado</strong></td>
        <td><strong>Código Nacional</strong></td>
        <td><strong>Código IBGE</strong></td>
        <td></td>
    </tr> 
    
    <?php
		
		//Consulta Estados Cadastrados
		$query = oci_parse($conecta, 
			'SELECT 
			   C.CIDCOD AS CODIGO_CIDADE,
			   C.CIDNOM AS CIDADE,
			   C.CIDNAC AS CODIGO_NACIONAL,
			   C.CIDIBG AS CODIGO_IBGE,
			   U.UFNOM AS ESTADO
			FROM
			   CIDADE C, UF U
			WHERE
			   C.CIDUFCOD = U.UFCOD'
			);
			
		oci_execute($query);

        while ($row = oci_fetch_object($query)) {
            ?>
            <tr>
                <td title="<?php echo $row->CIDADE;?>"><?php echo substr($row->CIDADE,0,21); ?></td>
                <td title="<?php echo $row->ESTADO;?>"><?php echo substr($row->ESTADO,0,13); ?></td>
                <td><?php echo utf8_encode($row->CODIGO_NACIONAL)?></td>
                <td><?php echo utf8_encode($row->CODIGO_IBGE)?></td>
                <td>
                    <a href="" class="k-button" id="<?php echo $row->CODIGO_CIDADE;?>" name="nova_cidade_bt_alterar" title="<?php echo $row->CODIGO_CIDADE;?>">
                        Alterar
                    </a>
                    <a href="" class="k-button" id="excluir" name="nova_cidade_bt_excluir" title="<?php echo $row->CODIGO_CIDADE;?>">
                        Excluir
                    </a>
                </td>
            </tr> 
            <?php
        }
    ?>
</table>