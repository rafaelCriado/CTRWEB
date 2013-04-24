<div id="fp_esquerda">
	<?php include('php/cadastro/financeiro/forma_pagamento/lista_forma_pagamento.php'); //Lista formas cadastradas?>
</div>

<div id="fp_direita">
	
    <form name="forma_pagamento_form">
    	<fieldset>
        	<div id="fp_form">
            	<div id="fp_form_sup">
                    <?php include('php/cadastro/financeiro/forma_pagamento/formulario.php');?>
				</div>
                <div id="fp_form_inf">
                    <div id="botoes_fp">
                        <input type="button" name="fp_bt_salvar"  	value="Salvar" 	class=""/>
                        <input type="button" name="fp_bt_excluir" 	value="Excluir" class=""/>
                        <input type="button" name="fp_bt_novo" 		value="Novo" 	class=""/>
                    </div>
                </div>
            </div>
        </fieldset>
    </form>
    
</div>