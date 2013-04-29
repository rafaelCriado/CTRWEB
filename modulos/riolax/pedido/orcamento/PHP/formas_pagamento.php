<style>

	.FormPagam{
		height:350px; width:400px; border:1px solid #000; text-align:left;
	}
	
	.FormPagam_select{
		margin-left:10px;
	}
	
	.FormPagam_valor{
		margin-left:112px;
	}
	
	.FormPagam_resto{
		margin-left:94px;
	}

	table{
		margin:auto;
	}
	
	.k-button{
		float:right;	
	}

</style>
<div class="FormPagam">
	
	
    Formas de Pagamento:
      
        <input type="hidden" name="fp_get" value="<?php echo $formaPagamento; ?>">
    
    <select name="FormPagam_select" class="FormPagam_select">
	
			<?php 
                $formaPagamento = isset($_GET['codigo'])?$_GET['codigo']:'';
                
                include '../../../../../php/classes/bd_oracle.class.php';
                
                $select = "SELECT FP.FORPAGNUM AS CODIGO ,FP.FORPAGDES AS FORM_PAGAMENTO FROM FORMAS_PAGAMENTO FP";
                
                $query = oci_parse($conecta,$select);
                
                oci_execute($query);
                
                $cont = 0;
                while($item = oci_fetch_array($query)){
                    
                    echo "<option value='" . $item['CODIGO'] . "' > " .  $item['FORM_PAGAMENTO'] . "</option>";			
                }
            ?>
    
    </select>
    
    <script>
		$(document).ready(function(e) {
            $('select[name="FormPagam_select"]').val($('input[name="fp_get"]').val());
        });
	</script>
        
	<br> Valor: <input type="text" name="FormPagam_valor" class="FormPagam_valor"/>
    
    <br> Restante: <input type="text" disabled name="FormPagam_resto" class="FormPagam_resto"/>
    
    <br> 
    <table>
    <tr>
    <td></td>
    </tr>
    </table>
    
    <br> <input type="button" name="FormPagam" value="Incluir" class="k-button" />   
    	
    
	
</div>

