<style>
	table#grid tr:nth-child(even) {background: #ccc}
	table#grid tr{ line-height:30px; height:30px}
	#excluir{ text-decoration:none;}
	#grid{ height:inherit; margin:0px; padding:0px; font-size:10px;	}
	#grid .k-header{ font-size:14px; font-weight:bold; color:#555; line-height:35px; padding-left:15px; font-family:Arial, Helvetica, sans-serif;}
</style>

<?php 
error_reporting(0);
include('../../classes/bd_oracle.class.php'); 
include('../../cadastro - Cópia/estado/php/classes/bd_oracle.class.php'); 
?>

<table width="100%" id="" class="k-content" cellpadding="0" cellspacing="0">
    <tr>
        <td colspan="10" class="k-header">
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