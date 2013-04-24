<style>
	table#grid tr:nth-child(even) {background: #ccc}
	table#grid tr{ line-height:30px; height:30px}
	#excluir{ text-decoration:none;}
	#grid{ height:inherit; margin:0px; padding:0px; font-size:10px;	}
	#grid .k-header{ font-size:14px; font-weight:bold; color:#555; line-height:35px; padding-left:15px; font-family:Arial, Helvetica, sans-serif;}
</style>

<?php 
error_reporting(0);
include('../../../php/classes/bd_oracle.class.php'); 
//Consulta Estados Cadastrados
		$query = oci_parse($conecta, 
			'SELECT 
			  U.USUCOD AS CODIGO, 
			  U.USUNOM AS NOME, 
			  U.USUPASS AS SENHA, 
			  U.USUCAR AS CARGO,
			  UG.USUGRUDESC AS GRUPO
			FROM 
			  USUARIO U
			LEFT JOIN
			 USUARIO_GRUPO UG
			ON 
			U.USUGRUCOD = UG.USUGRUCOD'
			);
			
		oci_execute($query);
?>
<table width="100%" >
    <tr>
        <td colspan="4" class="k-header title">
           Usuários Cadastrados
        </td>
    </tr>
        <tr>
        	<td>Usuário</td>
        	<td>Cargo</td>
        	<td>Grupo</td>
            <td></td>
        </tr>
    <tbody>
	<?php
	while ($row = oci_fetch_object($query)) {
		?>
        <tr>
        	<td title="<?php echo $row->NOME;?>">  <?php echo substr($row->NOME,0,9);?></td>
            <td title="<?php echo $row->CARGO;?>"> <?php echo substr($row->CARGO,0,11);?></td>
            <td title="<?php echo $row->GRUPO;?>"> <?php echo substr($row->GRUPO,0,8);?></td>
            <td style="float:right">
            	<a href="" class="k-button" id="<?php echo $row->CODIGO;?>" name="novo_usuario_bt_alterar" title=" Alterar Dados">
                	Alterar
                </a>
            	
                <a href="" class="k-button" id="excluir" name="novo_usuario_bt_excluir" title="<?php echo $row->CODIGO;?>">
                	Excluir
                </a>
         	</td>
        </tr>
    	<?PHP
	}
	?>
    </tbody>
</table>
