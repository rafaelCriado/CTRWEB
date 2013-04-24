<style>
	table#grid tr:nth-child(even) {background: #ccc}
	table#grid tr{ line-height:30px; height:30px}
	#excluir{ text-decoration:none;}
	#grid{ height:inherit; margin:0px; padding:0px; font-size:10px;	}
	#grid .k-header{ font-size:14px; font-weight:bold; color:#555; line-height:35px; padding-left:15px; font-family:Arial, Helvetica, sans-serif;}
</style>

<?php 
	error_reporting(0);
	include('');
	include('../../classes/bd_oracle.class.php'); 
	include('../../functions.php'); 

	
	
	if(isset($_GET['grupo']) and !empty($_GET['grupo'])){
		
		//Variavel
		$grupo = $_GET['grupo'];
		
		?>
        <table width="300" cellpadding="0" cellspacing="0" style="display:block;">
            <tr style="width:300px">
                <td colspan="3" class="k-header" style="width:300px">
                    Subgrupos Cadastrados
                </td>
            </tr>
            <tr>
                <td><strong>Grupo</strong></td>
                <td><strong>Subgrupo</strong></td>
                <td></td>
            </tr> 
            
            <?php
                
                //Consulta Estados Cadastrados
                $query = oci_parse($conecta, 
                       'SELECT 
					   		   E.EMPNOM AS EMPRESA,
							   PG.PROGRUDEN AS GRUPO,
							   PS.PROSUBGRUCOD AS CODIGO_SUBGRUPO,
							   PS.PROSUBGRUDEN AS SUBGRUPO
						  FROM 
						  	   PRODUTO_SUBGRUPO PS, EMPRESA E, PRODUTO_GRUPO PG
						 WHERE 
						 	   PS.EMPCOD = E.EMPCOD AND 
							   PS.PROGRUCOD = PG.PROGRUCOD AND 
							   PS.PROGRUCOD = '.$grupo
                    );
                    
                oci_execute($query);
        
                while ($row = oci_fetch_object($query)) {
                    ?>
                    <tr id="<?php echo $row->EMPRESA; ?>">
                        <td title="<?php echo $row->GRUPO; ?>"><?php echo textoFORMAT($row->GRUPO,15); ?></td>
                        <td title="<?php echo $row->SUBGRUPO; ?>"><?php echo textoFORMAT($row->SUBGRUPO,15); ?></td>
                        <td>
                            <a href="" class="k-button" id="<?php echo $row->CODIGO_SUBGRUPO; ?>" name="novo_produto_subgrupo_bt_alterar" title="<?php echo $row->CODIGO_SUBGRUPO;?>">
                                Alterar
                            </a>
                            <a href="" class="k-button" id="excluir" name="novo_produto_subgrupo_bt_excluir" title="<?php echo $row->CODIGO_SUBGRUPO;?>">
                                Excluir
                            </a>
                        </td>
                    </tr> 
                    <?php
                }
            ?>
        </table>        
        
		<?php
	}else{
		//echo 'Falha de Requisição';
	}
	
?>

