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
	include('../../functions.php'); 
?>

<table width="300" cellpadding="0" cellspacing="0" style="display:block;">
    <tr style="width:300px">
        <td colspan="9" class="k-header" style="width:300px">
            Grupos Cadastrados
        </td>
    </tr>
    <tr>
        
        <td><strong>Cód.</strong></td>
        <td><strong>Grupo</strong></td>
        <td></td>
    </tr> 
    
    <?php
		
		//Consulta Estados Cadastrados
		$query = oci_parse($conecta, 
			'SELECT 
					PG.EMPCOD    AS CODIGO_EMPRESA,
				    E.EMPNOM     AS EMPRESA,
				    PG.PROGRUCOD AS CODIGO,
				    PG.PROGRUDEN AS NOME
			   FROM 
			   		PRODUTO_GRUPO PG, 
			   		EMPRESA E
			  WHERE 
			  		PG.EMPCOD = E.EMPCOD'
			);
			
		oci_execute($query);

        while ($row = oci_fetch_object($query)) {
            ?>
            <tr id="<?php echo $row->CODIGO; ?>">
                <td><?php echo utf8_encode($row->CODIGO); ?></td>
                <td title="<?php echo $row->NOME; ?>"><?php echo textoFORMAT($row->NOME,15); ?></td>
                <td>
                    <a href="" class="k-button" id="<?php echo $row->CODIGO; ?>" name="novo_produto_grupo_bt_alterar" title="<?php echo $row->CODIGO;?>">
                        Alterar
                    </a>
                    <a href="" class="k-button" id="excluir" name="novo_produto_grupo_bt_excluir" title="<?php echo $row->CODIGO;?>">
                        Excluir
                    </a>
                </td>
            </tr> 
            <?php
        }
    ?>
</table>