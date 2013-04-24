<?php
	//Informações da forma de pagamento selecionada
	
	if(!isset($sessao)){
		//Inclui classe de sessão
		include('../../../../php/classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('../../../../php/functions.php');
		
		//Inclui banco de dados
		include('../../../../php/classes/bd_oracle.class.php');
	}
	
	if($_POST){
		
		$id = isset($_POST['id'])?$_POST['id']:'';
		
		if(!empty($id)){
			
			$sql_forma_pagamento = '  SELECT EMPCOD       AS EMPRESA,
											 FORPAGNUM    AS CODIGO,
											 FORPAGDES    AS NOME,
											 FORPAGVALMAX AS VALOR_MAXIMO,
											 FORPAGVEN    AS VENDA,
											 FORPAGTIP    AS TIPO_PAGAMENTO,
											 FORPAGMAXPAR AS PARCELA_MAXIMA,
											 USUCOD       AS USUARIO
										FROM FORMAS_PAGAMENTO
									   WHERE FORPAGNUM = '.$id;
			
			$query_forma_pagamento = oci_parse($conecta,$sql_forma_pagamento);
			
			if(oci_execute($query_forma_pagamento)){
				
				//Recebe informações
				$forma_pagamento = oci_fetch_object($query_forma_pagamento);
				
			}
			
		}
	}
?>


<div id="campo_fp">
    <label for="fp_codigo_demo">Código:</label><br />
    <input name="fp_codigo_demo" type="text" 	value="<?php echo isset($forma_pagamento->CODIGO)?$forma_pagamento->CODIGO:''; ?>" disabled="disabled" size="5"/>
    <input name="fp_codigo" 	 type="hidden" 	value="<?php echo isset($forma_pagamento->CODIGO)?$forma_pagamento->CODIGO:''; ?>" />
</div>

<div id="campo_fp">
    <label for="fp_descricao">Descrição:</label><br />
    <input name="fp_descricao" type="text" value="<?php echo isset($forma_pagamento->NOME)?$forma_pagamento->NOME:''; ?>"  size="45" />
</div>



<div id="campo_fp">
    <label for="fp_valor_maximo" title="Valor Máximo Permitido">Valor Máx.:</label><br />
    <input name="fp_valor_maximo" type="text" value="<?php echo isset($forma_pagamento->VALOR_MAXIMO)?$forma_pagamento->VALOR_MAXIMO:''; ?>"  size="5" />
</div>

<div id="campo_fp">
    <label for="fp_tipo_venda" title="Tipo de Venda">Tipo de Venda:</label><br />
    <select name="fp_tipo_venda">
        <option value="V">à Vista</option>
        <option value="P">à Prazo</option>
        
    </select>
    <script>
		$('select[name="fp_tipo_venda"]').val('<?php echo isset($forma_pagamento->VENDA)?$forma_pagamento->VENDA:''; ?>');
    </script>

</div>

<div id="campo_fp">
    <label for="fp_tipo_pagamento" title="Tipo de Pagamento">Tipo de Pagamento:</label><br />
    <select name="fp_tipo_pagamento">
        <?php
            //Tipo de Pagamento
            $sql_tipo_pagamento = 'SELECT TIPPAGNUM AS CODIGO, TIPPAGDES AS NOME FROM TIPO_PAGAMENTO';
            $query_tp = oci_parse($conecta,$sql_tipo_pagamento);
            
            if(oci_execute($query_tp)){
                while($tipo_pagamento = oci_fetch_object($query_tp)){
                    echo '<option value="'.$tipo_pagamento->CODIGO.'">'.$tipo_pagamento->NOME.'</option>';			
                }
            }
            
        ?>
    </select>
    <script>
		$('select[name="fp_tipo_pagamento"]').val(<?php echo isset($forma_pagamento->TIPO_PAGAMENTO)?$forma_pagamento->TIPO_PAGAMENTO:''; ?>);
    </script>
</div>



<div id="campo_fp">
    <label for="fp_parcela_maximo" title="Número maximo de parcelas">Parcela Máx.:</label><br />
    <input name="fp_parcela_maximo" type="text" value="<?php echo isset($forma_pagamento->PARCELA_MAXIMA)?$forma_pagamento->PARCELA_MAXIMA:''; ?>"  size="5" />
</div>

<div id="campo_fp" >
	<input type="button" name="fp_bt_imagem" value="Imagem" class="oculto"/>
</div>

<style>
.img_carregar{ visibility:visible} 
.oculto{ visibility:hidden}
</style>