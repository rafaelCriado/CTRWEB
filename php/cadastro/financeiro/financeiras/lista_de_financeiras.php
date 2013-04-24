
<?php 
error_reporting(0);
include('../../../classes/bd_oracle.class.php'); 
include('php/classes/bd_oracle.class.php'); 
?>

<table width="100%">
    <tr>
        <td colspan="10" class="k-header title">
            Financeiras
        </td>
    </tr>
    <tr>
        <td><strong>Código</strong></td>
        <td><strong>Nome</strong></td>
        <td><strong>Tx. Abertura</strong></td>
        <td></td>
    </tr> 
    
    <?php
		
		//Consulta Estados Cadastrados
		$query = oci_parse($conecta, 
		   'SELECT FINCOD    AS CODIGO,
				   FINNOM    AS NOME,
				   FINTAXABE AS TAXA
			  FROM FINANCEIRAS'
			);
			
		oci_execute($query);

        while ($row = oci_fetch_object($query)) {
            ?>
            <tr>
                <td><?php echo utf8_encode($row->CODIGO); ?></td>
                <td><?php echo utf8_encode($row->NOME); ?></td>
                <td><?php echo 'R$ '.utf8_encode(number_format($row->TAXA,2,',','.'))?></td>
                <td>
                    <a href="" class="k-button" id="<?php echo $row->CODIGO;?>" name="nova_financeira_bt_alterar" title="<?php echo $row->CODIGO;?>">
                        Alterar	
                    </a>
                    <a href="" class="k-button" id="excluir" name="nova_financeira_bt_excluir" title="<?php echo $row->CODIGO;?>">
                        Excluir
                    </a>
                </td>
            </tr> 
            <?php
        }
    ?>
</table>