<style>
	/* 
	Cusco Sky table styles
	
*/

table, th, td {
	border: 1px solid #D4E0EE;
	border-collapse: collapse;
	font-family: "Trebuchet MS", Arial, sans-serif;
	color: #555;
}

caption {
	font-size: 150%;
	font-weight: bold;
	margin: 5px;
}

td, th {
	padding: 4px;
}

thead th {
	text-align: center;
	background: #E6EDF5;
	color: #4F76A3;
	font-size: 100% !important;
}

tbody th {
	font-weight: bold;
}

tbody tr { background: #FCFDFE; }
thead tr { background: #FCFDFE; font-weight:bold; }

tbody tr.odd { background: #F7F9FC; }

table a:link {
	color: #718ABE;
	text-decoration: none;
}

table a:visited {
	color: #718ABE;
	text-decoration: none;
}

table a:hover {
	color: #718ABE;
	text-decoration: underline !important;
}

tfoot th, tfoot td {
	font-size: 85%;
}

</style>
<script>
	$('#grid tr').live("mouseover",
		function(){
			$(this).addClass('destaque_linha');
		}
	);
	$('#grid tr').live("mouseout",
		function(){
			$(this).removeClass('destaque_linha');
		}
	);
</script>
<?php 
	error_reporting(0);
	include('../../classes/bd_oracle.class.php');  
?>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
    	<td class="k-header title" colspan="3">Telas de Acesso Cadastradas</td>
    </tr>
    
    <tr>
        
        <td><strong>Cód.</strong></td>
        <td><strong>Descrição da Tela</strong></td>
        <td></td>
    </tr> 
    
    <?php
		
		//Consulta Estados Cadastrados
		$query = oci_parse($conecta, 
			'SELECT 
				UA.USUACECOD AS CODIGO_TELA, 
				UA.USEACEDESC AS DESCRICAO_TELA 
			 FROM 
			 	USUARIO_ACESSO UA
			 ORDER BY
			 	DESCRICAO_TELA'
			);
			
		oci_execute($query);

        while ($row = oci_fetch_object($query)) {
            ?>
            <tr>
               
                <td><?php echo utf8_encode($row->CODIGO_TELA); ?></td>
                <td id="<?php echo $row->CODIGO_TELA;?>"><?php echo utf8_encode($row->DESCRICAO_TELA); ?></td>
                <td width="115px">
                	<a href="" class="k-button" id="<?php echo $row->CODIGO_TELA;?>" name="nova_tela_bt_alterar" title=" Alterar Dados">
                        Alterar
                    </a>

                    <a href="" class="k-button" id="excluir" name="nova_tela_bt_excluir" title="<?php echo $row->CODIGO_TELA;?>">
                        Excluir
                    </a>
                </td>
            </tr> 
            <?php
        }
//Consulta Estados Cadastrados
		
		//fecha a conexão atual
		//oci_close($conecta);
    ?>

</table>