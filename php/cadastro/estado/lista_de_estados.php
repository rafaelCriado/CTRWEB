
<?php 
error_reporting(0);
include('../../../php/classes/bd_oracle.class.php'); 
include('php/classes/bd_oracle.class.php'); 
?>

<table width="100%">
    <tr>
        <td colspan="10" class="k-header title">
            Estados
        </td>
    </tr>
    <tr>
        <td><strong>Abreviatura</strong></td>
        <td><strong>Estado</strong></td>
        <td><strong>Código País</strong></td>
        <td></td>
    </tr> 
    
    <?php
		
		//Consulta Estados Cadastrados
		$query = oci_parse($conecta, 
			'SELECT 
				UFCOD AS CODIGO, 
			 	UPPER(UFNOM) AS ESTADO, 
			 	UPPER(UFABREV) AS ABREVIATURA, 
			 	UFCODPAIS AS PAIS_CODIGO 
			 FROM 
			 	UF
			 ORDER BY
			 	ABREVIATURA'
			);
			
		oci_execute($query);

        while ($row = oci_fetch_object($query)) {
            ?>
            <tr>
                <td><?php echo utf8_encode($row->ABREVIATURA); ?></td>
                <td><?php echo utf8_encode($row->ESTADO); ?></td>
                <td><?php echo utf8_encode($row->PAIS_CODIGO)?></td>
                <td>
                    <a href="" class="k-button" id="<?php echo $row->CODIGO;?>" name="novo_estado_bt_alterar" title="<?php echo $row->CODIGO;?>">
                        Alterar	
                    </a>
                    <a href="" class="k-button" id="excluir" name="novo_estado_bt_excluir" title="<?php echo $row->CODIGO;?>">
                        Excluir
                    </a>
                </td>
            </tr> 
            <?php
        }
    ?>
</table>