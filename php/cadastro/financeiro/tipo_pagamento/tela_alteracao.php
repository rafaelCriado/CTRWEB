      	<?php 
			include('../../../classes/bd_oracle.class.php');  
			$query = oci_parse($conecta, "  SELECT TIPPAGNUM AS CODIGO,
												   TIPPAGDES AS NOME,
												   EMPCOD    AS EMPRESA,
												   USUCOD    AS USUARIO
											  FROM TIPO_PAGAMENTO
											 WHERE TIPPAGNUM =".$_GET['id']);
			
			oci_execute($query);
			
			$row = oci_fetch_object($query);
			?>		
			<h3>Novo Tipo de Pagamento</h3>
            <form name="novo_tipo_pagamento">
                <input type="hidden" name="codigo_novo_tipo_pagamento" value="<?php echo $row->CODIGO;?>" />   
                
                &nbsp;&nbsp;&nbsp;&nbsp;Nome:	
                <input type="text" name="novo_tipo_pagamento_nome" placeholder="HBC" maxlength="60"  value="<?php echo $row->NOME;?>" >
                <br><br />

                

                
                
                <input type="button" value="CANCELAR" name="novo_tipo_pagamento_bt_limpar"  class="k-button">
                <input type="button" value="SALVAR" name="novo_tipo_pagamento_bt_salvar" class="k-button">
            </form>
            <br><br>
            <span class="resultado_novo_tipo_pagamento"></span>
        	<script>
		//EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR===================================================
		$('input[name="novo_tipo_pagamento_bt_salvar"]').live('click', function(e){
			e.preventDefault();
			
			var desc		= $('input[name="novo_tipo_pagamento_nome"]');
			var cod			= $('input[name="codigo_novo_tipo_pagamento"]');
			
			if(desc.val() == '' || desc.val() == null){
				erro(desc,'Escreva a descrição');
			}else{
				//Caso todos os campos estiverem preenchidos faça
				$.ajax({
					url: 'php/cadastro/financeiro/tipo_pagamento/atualizar_novo_tipo_pagamento.php', 
					dataType: 'html',
					data: { 
							codigo:cod.val(),
							descricao:desc.val(),
															
						},
					type: 'POST',
					success: function(data, textStatus) {
								
								$('.resultado_novo_tipo_pagamento').html('<p>' + data + '</p>');
								$('#retorno_novo_tipo_pagamento').load('php/cadastro/financeiro/tipo_pagamento/lista_de_tipo_pagamento.php');
								
								limparTodos('form[name="novo_tipo_pagamento"] input[type="text"]');
								desc.focus();
								setTimeout(function(){$('.resultado_novo_tipo_pagamento').html('')},5000);
								$('#input_novo_tipo_pagamento').load('php/cadastro/financeiro/tipo_pagamento/form_input.php');
							 },
					error: function(xhr,er) {
								$('.resultado_novo_tipo_pagamento').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
								
							 }		
							 
				});						
			
			}
		});
		
		$('input[name="novo_tipo_pagamento_bt_limpar"]').click( function(){
			$('#input_novo_tipo_pagamento').load('php/cadastro/financeiro/tipo_pagamento/form_input.php');
		});
		</script>