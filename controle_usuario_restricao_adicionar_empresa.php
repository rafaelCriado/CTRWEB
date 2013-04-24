<?php 
	include 'php/classes/bd_oracle.class.php' ;
	$query_empresas = oci_parse($conecta,"SELECT EMPCOD CODIGO, EMPNOM RAZAO, EMPNOMFAN FANTASIA FROM EMPRESA");
	
	ociexecute($query_empresas);
?>



<html>
	<head>
    	<meta charset="utf-8">
    </head>
    
    <body>
        <select id="empresas_cadastradas_select" name="vincular_empresa_usuario" size="10" multiple style="width:190px">
            <?php 
				while($result_empresa = oci_fetch_object($query_empresas)){
					?>
            		<option value="<?php echo $result_empresa->CODIGO;?>"><?php echo $result_empresa->FANTASIA;?></option>
                 	<?php
				}
			?>
            
        </select>
        &nbsp;<input type="button" class="k-button" name="bt_vincular_usuario_empresa"value="Vincular"> 
        <span id="result_vincular_empresa"></span> 
	</body>
</html>