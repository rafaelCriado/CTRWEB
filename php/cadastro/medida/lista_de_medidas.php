<table width="100%">
    <tr>
        <td colspan="3" class="k-header title">
           Unidades de Medidas Cadastradas
        </td>
    </tr>
    <tr>
        <td>MEDIDA</td>
        <td>DESCRIÇÃO</td>
        <td></td>
    </tr> 
    
    <?php
	
		error_reporting(0);
		include('../../functions.php');

		if(!isset($conecta)){
			include('../../classes/bd_oracle.class.php');
			//echo '<style>#retorno_nova_medida{margin-top:-16px;}</style>'; 
		}
		//Consulta Estados Cadastrados
		$query = oci_parse($conecta, 
			'SELECT 
				UM.UNIMEDCOD AS CODIGO, 
				UM.UNIMEDDES AS DESCRICAO 
			 FROM 
			 	UNIDADE_MEDIDA UM'
			);
			
		oci_execute($query);

        while ($row = oci_fetch_object($query)) {
            ?>
            <tr>
                <td><?php echo utf8_encode($row->CODIGO); ?></td>
                <td title="<?php echo $row->DESCRICAO;?>"><?php echo textoFORMAT($row->DESCRICAO,10); ?></td>
                <td style="text-align:right">
                    <a href="" class="k-button" id="<?php echo $row->CODIGO;?>" name="nova_medida_bt_alterar" title="<?php echo $row->CODIGO;?>">
                        Alterar
                    </a>
                    <a href="" class="k-button" id="excluir" name="nova_medida_bt_excluir" title="<?php echo $row->CODIGO;?>">
                        Excluir
                    </a>
                </td>
            </tr> 
            <?php
        }
    ?>
</table>