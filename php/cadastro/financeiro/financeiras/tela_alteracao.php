      	<?php 
			include('../../../classes/bd_oracle.class.php');  
			$query = oci_parse($conecta, "SELECT FINCOD AS CODIGO, FINNOM AS NOME, FINTAXABE AS TAXA FROM FINANCEIRAS WHERE FINCOD = ".$_GET['id']);
			
			oci_execute($query);
			
			$row = oci_fetch_object($query);
			?>		
			<h3>Atualizar Financeira</h3>
            <form name="nova_financeira">
                <input type="hidden" name="codigo_nova_financeira" value="<?php echo $row->CODIGO;?>" />   
                
                &nbsp;&nbsp;&nbsp;&nbsp;Nome:	
                <input type="text" name="nova_financeira_nome" placeholder="HBC" maxlength="60"  value="<?php echo $row->NOME;?>" >
                <br><br />

                
                Taxa de Abertura: 			
                <input type="text" name="nova_financeira_taxa" placeholder=""  value="<?php echo $row->TAXA;?>" onKeyPress="return(MascaraMoeda(this,'.',',',event))">
                <br><br />

                
                
                <input type="button" value="CANCELAR" name="nova_financeira_bt_limpar"  class="k-button">
                <input type="button" value="SALVAR" name="nova_financeira_bt_salvar" class="k-button">
            </form>
            <br><br>
            <span class="resultado_nova_financeira"></span>
        	<script>
		//EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR===================================================
		$('input[name="nova_financeira_bt_salvar"]').live('click', function(e){
			e.preventDefault();
			
			var desc		= $('input[name="nova_financeira_nome"]');
			var tax			= $('input[name="nova_financeira_taxa"]');
			var cod			= $('input[name="codigo_nova_financeira"]');
			
			if(desc.val() == '' || desc.val() == null){
				erro(desc,'Escreva a descrição');
			}else{
				if(tax.val() == '' || tax.val() == null){
					erro(tax, 'Escreva a taxa');
				}else{
						//Caso todos os campos estiverem preenchidos faça
						$.ajax({
							url: 'php/cadastro/financeiro/financeiras/atualizar_financeira.php', 
							dataType: 'html',
							data: { 
									codigo:cod.val(),
									descricao:desc.val(),
									taxa: tax.val() 								
								},
							type: 'POST',
							success: function(data, textStatus) {
										$('.resultado_nova_financeira').html('<p>' + data + '</p>');
										$('#retorno_nova_financeira').load('php/cadastro/financeiro/financeiras/lista_de_financeiras.php');
										
										limparTodos('form[name="nova_estado"] input[type="text"]');
										desc.focus();
										setTimeout(function(){$('.resultado_nova_financeira').html('')},5000);
										$('#input_nova_financeira').load('php/cadastro/financeiro/financeiras/form_input.php');
									 },
							error: function(xhr,er) {
										$('.resultado_nova_financeira').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
										
									 }		
									 
						});						
					
				}
			}
		});
		
		$('input[name="nova_financeira_bt_limpar"]').click( function(){
			$('#input_nova_financeira').load('php/cadastro/financeiro/financeiras/form_input.php');
		});
		</script>