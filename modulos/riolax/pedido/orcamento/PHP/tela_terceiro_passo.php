<?php
	include('../../../../../php/classes/bd_oracle.class.php');
	
	$nGrupo  		= $_POST['nGrupo'];
	$cGrupo 		= $_POST['cGrupo'];
	$nSubgrupo  	= $_POST['nSubgrupo'];
	$cSubgrupo 		= $_POST['cSubgrupo'];
	
?>
<style>
	#or_caracteristica{width:250px; height:100%; float:left; padding:5px; margin:-3px 0 0 -10px; border-right:1px solid #B3D8E8;  border-bottom:1px solid #B3D8E8 }
	#or_caracteristica select, #or_caracteristica input{ height:28px; line-height:28px; width:210px; }
	#or_kits{ display:none; height:100%; width:550px; float:left; overflow:auto; margin-top:-3 !important;}
	.kit_item{width:500px}
	.bt_finalizar{ position:fixed; z-index:9999999999; bottom:70px; right:51px}
</style>
<div>
<div id="or_caracteristica" class="k-header" style="">
	<h2>Características</h2>
	Categoria: <br /><input type="text" disabled="disabled" value="<?php echo $nGrupo; ?>"/>
    <br />
    Modelo: <br /><input type="text" disabled="disabled" value="<?php echo $nSubgrupo; ?>"/>
	<div>
	<input type="hidden" name="cGrupo" value="<?php echo $cGrupo;?>" />
	<input type="hidden" name="cSubgrupo" value="<?php echo $cSubgrupo;?>" />
	<input type="hidden" name="orc_fechamento" value="">    
	Medida: <br />
    <select name="prod_dim">
    	<option value="">Escolha uma medida</option>
    	<?php 
			//Pesquisa tamanhos de cadastro
			$sql = 'SELECT PROLAR,
						   PROALT,
						   PROCOM,
						   PROPESLIQ,
						   PROPESBRU
					  FROM PRODUTO
					 WHERE PROGRUCOD = ' . $cGrupo . '
					   AND PROSUBGRUCOD = ' . $cSubgrupo . ' 
    			  GROUP BY PROLAR, PROALT, PROCOM, PROPESLIQ, PROPESBRU'
					   ;
			
			//Prepara cadastro
			$query = oci_parse($conecta,$sql);
			
			//Executa
			oci_execute($query);
			
			//Exibe dados
			while($row = oci_fetch_object($query)){
				?>
                    <option value="<?php echo $row->PROCOM. 'x' . $row->PROLAR. 'x' . $row->PROALT; ?>">
                        <?php echo $row->PROCOM. 'x' . $row->PROLAR. 'x' . $row->PROALT; ?>
                    </option>
				<?php
			}
			?>
    </select>
</div>

<div>

	Linha: 
	<div id="recebe_linhas"></div>
</div>
<div>

	Acabamento:
	<div id="recebe_acabamentos"></div>
</div>

<div>

	Cores: 
	<div id="recebe_cores"></div>
</div>
<div>

	Posição: 
	<div id="recebe_posicao"></div>
</div>
<div>

	Voltagem: 
	<div id="recebe_voltagem"></div>
</div>

</div>

















<div id="or_kits">
	
</div>

<input type="input" name="bt_po_voltar_2" value="Voltar" class="k-button"  style="position:absolute; top:12px; right:30px;"/>


</div>







