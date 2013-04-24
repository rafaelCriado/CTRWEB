<?php 
	error_reporting(0);
	include('../../classes/bd_oracle.class.php'); 
	//Consulta Grupos Cadastrados
	$query = oci_parse($conecta, 
		'SELECT 
			USUGRUCOD AS CODIGO, 
			USUGRUDESC AS GRUPO 
		FROM 
			USUARIO_GRUPO'
		);
	oci_execute($query);
?>
<table width="100%" class="table_controle_usuario_grupo_sub">
    <tr>
        <td colspan="3" class="k-header title" >
            Grupos Cadastrados
        </td>
    </tr>
   
        <tr>
        	<td>Código</td>
        	<td>Grupo</td>
            <td></td>
        </tr>
    
    
	<?php
	while ($row = oci_fetch_object($query)) {
		?>
        <tr>
        	<td> <?php echo utf8_encode($row->CODIGO); ?></td>
            <td> <?php echo utf8_encode($row->GRUPO); ?></td>
            <td>
            	<a href="" class="k-button" id="<?php echo $row->CODIGO;?>" name="novo_usuario_grupo_bt_alterar" title=" Alterar Dados">
                	Alterar
                </a>
            	
                <a href="" class="k-button" id="excluir" name="novo_grupo_usuario_bt_excluir" title="<?php echo $row->CODIGO;?>">
                	Excluir
                </a>
         	</td>
        </tr>
    	<?PHP
	}
	?>
</table>