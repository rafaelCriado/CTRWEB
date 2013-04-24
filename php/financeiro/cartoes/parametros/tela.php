<div id="cc_esquerda">
	<?php include('php/financeiro/cartoes/parametros/lista_forma_pagamento.php'); //Lista formas cadastradas?>
</div>

<div id="cc_direita">
	
    <form name="cartao_credito_form">
    	<fieldset>
        	<div id="cc_form">
            	<div id="cc_form_sup">
                    <?php include('php/financeiro/cartoes/parametros/formulario.php');?>
				</div>
                <div id="cc_form_inf">
                    <div id="botoes_cc">
                        <input type="button" name="cc_bt_salvar"  	value="Salvar" 	class=""/>
                        <input type="button" name="cc_bt_excluir" 	value="Excluir" class=""/>
                        <input type="button" name="cc_bt_novo" 		value="Novo" 	class=""/>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    
</div>