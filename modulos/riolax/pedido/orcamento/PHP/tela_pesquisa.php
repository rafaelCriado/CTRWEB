<?php	
	$orcamentos = isset($_POST['orcamento'])?$_POST['orcamento']:'';
	if($_POST){
		include('../../../../../php/classes/bd_oracle.class.php');
		include('../../../../../php/classes/session.class.php');
		
		$sessao = new Session();
		
		//Pesquisa orçamento
		$sql_select_orcamento = "SELECT O.ORCCOD AS NUMERO,
									   O.ORCDATCAD AS DATA_CADASTRO,
									   O.ORCDAT AS DATA,
									   O.ENTCOD AS CLIENTE_CODIGO,
									   E.ENTNOM AS CLIENTE,
									   O.ORCDATVAL AS DATA_VENCIMENTO,
									   O.ORCPRAENT AS PRAZO_ENTREGA,
									   O.CONPAGCOD AS CONDICAO_PAGAMENTO,
									   CP.CONPAGDEN AS CONDICAO_PAGAMENTO_NOME,
									   O.ORCPERDES1 AS DESCONTO,
									   TO_CHAR(O.ORCVALFRE, '99999990.99') AS FRETE,
									   O.ORCVALTOT AS TOTAL,
									   O.USUCOD AS USUARIO_CODIGO,
									   U.USUNOM AS USUARIO,
									   O.ORCVALADI AS ADICIONAL,
									   O.ORCPREVEN AS PRECO_VENDA
								  FROM ORCAMENTO O, ENTIDADE E, USUARIO U, cond_pag cp
								 WHERE O.ENTCOD = E.ENTCOD
								   AND O.USUCOD = U.USUCOD
								   AND O.CONPAGCOD = CP.CONPAGCOD(+)
								   AND O.ORCCOD = ".$orcamentos;
		
		$select_orcamento = oci_parse($conecta,$sql_select_orcamento);
		
		if(oci_execute($select_orcamento)){
			
			$orcamento = oci_fetch_object($select_orcamento);

			//PESQUISA ITENS
			$query_itens_pedido = " SELECT OI.PROCOD AS CODIGO,
										   OI.ORCITEPRODES AS DESCRICAO,
										   OI.ORCITEPROQUA AS QUANTIDADE,
										   OI.ORCITEPROVALUNI AS PRECO,
										   OI.ORCITEVALTOT AS SUBTOTAL
									  FROM ORCAMENTO_ITEM OI
									  WHERE OI.ORCCOD = ".$orcamentos;
				
		}
		
		
		
		
	}	
	
	
		
	
?>
<input type="hidden" name="orc-status" value="<?php echo isset($_POST['status'])?$_POST['status']:'';?>" />
<input type="hidden" name="orc-num" 	  value="<?php echo $orcamentos;?>" size="5"> 



<style>	
	div.campo{ float:left}
</style>
<fieldset>
	<h3 style="margin:0">ORÇAMENTO</h3>
    <hr />
	<div class="campo">
    <label for="search_orc-numero"> Número: </label><br />
    	<input type="text" name="search_orc-numero" value="<?php echo $orcamentos;?>" size="5"> 
    </div>    
        
	
    <div class="campo">
	<label for="search_orc-data"> Data: </label><br />
    	<input type="text" name="search_orc-data" value="<?php echo isset($orcamento->DATA)?$orcamento->DATA:''; ?>" size="10"> 
	</div>

	<div class="campo">
    <label for="search_orc-vendedor">Usuario: </label><br />
    	<input type="text" name="search_orc-vendedor" value="<?php echo isset($orcamento->USUARIO)?$orcamento->USUARIO:''; ?>"  />
   		
   	</div>

	<div class="campo">
    <label for="search_orc-frete">Frete (R$): </label><br />
    	<input type="text" name="search_orc-frete" value="<?php echo isset($orcamento->FRETE)?number_format(trim($orcamento->FRETE),2,',','.'):''; ?>"  />
   		
   	</div>
	<div class="campo">
    <label for="search_orc-desconto">Desconto (%) : </label><br />
    	<input type="text" name="search_orc-desconto" value="<?php echo isset($orcamento->DESCONTO)?$orcamento->DESCONTO:''; ?>" size="10"  />
   		
   	</div>
	<div class="campo">
    <label for="search_orc-adicional">Adicional (R$) : </label><br />
    	<input type="text" name="search_orc-adicional" value="<?php echo isset($orcamento->ADICIONAL)?number_format($orcamento->ADICIONAL,2,',','.'):''; ?>" size="10"  />
   		
   	</div>
	<div class="campo">
    <label for="search_orc-condicao_pagamento">Cond. Pgto: </label><br />
    	<input type="text" name="search_orc-condicao_pagamento" value="<?php echo isset($orcamento->CONDICAO_PAGAMENTO_NOME)?$orcamento->CONDICAO_PAGAMENTO_NOME:''; ?>" size="10"  />
   		
   	</div>
        
        
    <br>

	<div  class="campo">
	<label for="search_orc-cliente">Cliente: </label><br />

    	<input type="text" name="search_orc-cliente" value="<?php echo isset($orcamento->CLIENTE)?$orcamento->CLIENTE:''; ?>" size="110" > 
        
    </div>
   </fieldset>  
   
   
   
   
       
   <fieldset>
   		<legend><h4>Itens:</h4></legend>
               
			
        <div class="campo">
        <label for="search_orc-produto">Produto: </label><br />

            <input type="text" name="search_orc-produto" value="" size="30" > 
		</div>
        <div class="campo">
        <label for="search_orc-quantidade">Qtde: </label><br />

            <input type="text" name="search_orc-quantidade" value="1" size="5" > 
        </div>
        <div class="campo">
        <label for="search_orc-valor">Preço: </label><br />

            <input type="text" name="search_orc-valor" value="" size="10" > 
           
        </div>    
        
        <div class="campo">
        	&nbsp;<br />
			<input type="button" value="Adicionar" name="search_orc-bt_add_produto">
        </div>

		<div style="clear:both">
        <fieldset>
        	<legend>Lista</legend>
            <table width="100%" cellpadding="0" cellspacing="0" style="line-height:20px; border:1px solid #999; padding:5px;">
            	<tr class="k-header">
                	<td> Item.</td>
                	<td> Cod.</td>
                	<td> Descrição</td>
                	<td> Preço</td>
                	<td> Quantidade</td>
                	<td align="right">SubTotal </td>
                </tr>
                
                <?PHP 
					if(isset($query_itens_pedido)){
						$query_itens_pedido = oci_parse($conecta,$query_itens_pedido);
						oci_execute($query_itens_pedido);
						$itens = 1;
						$total = 0;
						while($item = oci_fetch_object($query_itens_pedido)){
							?>
							<tr>
                            	<td><?php echo $itens++; 										 ?></td>
								<td><?php echo isset($item->CODIGO)		?$item->CODIGO		:''; ?></td>
								<td><?php echo isset($item->DESCRICAO)	?$item->DESCRICAO	:''; ?></td>
								<td>R$ <?php echo isset($item->PRECO)		?number_format($item->PRECO,2,',','.')		:''; ?></td>
								<td><?php echo isset($item->QUANTIDADE)	?$item->QUANTIDADE	:''; ?></td>
								<td align="right">R$ <?php echo isset($item->SUBTOTAL)	?number_format($item->SUBTOTAL,2,',','.')	:''; ?></td>
							</tr>
							<?php
							$total += $item->SUBTOTAL;
						}
						?>
                        	<tr align="right">
                            	
                            	<td colspan="6"> Subtotal: <strong> R$ <?php echo number_format($total,2,',','.')?></strong></td>
                            </tr>
                        <?php
					}
                ?>
            </table>
            <hr />
            <span style="float:right; line-height:30px; font-size:16px; font-weight:bold;"><strong>Total: R$</strong> <?php echo isset($orcamento->TOTAL)?number_format($orcamento->TOTAL,2,',','.'):'';?> </span>
        </fieldset>
        
        
        </div>
        
        
   
   <input type="button" value="Gerar Pedido"  name="orc-bt_gerar_pedido">
   <input type="button" value="Imprimir" name="orc-bt_imprimir_orcamento">
   <input type="button" value="Cancelar" name="orc-bt_cancelar_orcamento">
   <input type="button" value="Pesquisar" name="orc-bt_pesquisar_orcamento">
   
   </fieldset>


<script>
	$(document).ready(function(e) {
		
		$('#po_aba_tres').html('');
		
		var status = $('input[name="orc-status"]').val();
        if(status = 1){
			
			
			$('input[name^="search_orc-"]').attr("disabled","disabled");
			
			//Botão IMPRIMIR Orçamento
			$('input[name="orc-bt_imprimir_orcamento"]').click(function(e) {
                e.preventDefault();
				
				window.open('modulos/riolax/pedido/orcamento/PHP/orcamento_pdf.php?n='+$('input[name="orc-num"]').val());
					
				
            });
			// =======================
			
			
			
			
			
			
			
			
		}
		
		
		
		
		
		
    });
</script>

