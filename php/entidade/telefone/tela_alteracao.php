      	<?php 
			include('../../classes/bd_oracle.class.php');  
			$query = oci_parse($conecta, "SELECT UFCOD CODIGO, UFNOM NOME, UFCODPAIS CODIGO_PAIS,  UFABREV ABREVIATURA FROM UF WHERE UFCOD = ".$_GET['id']);
			
			oci_execute($query);
			
			$row = oci_fetch_object($query);
			?>		
			<h3>Atualizar Estado</h3>
            <form name="novo_estado">
                <input type="hidden" name="codigo_novo_estado" value="<?php echo $row->CODIGO;?>" />   
                Descrição:	
                    <span class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="novo_estado_nome" placeholder="São Paulo" maxlength="60" class="k-input" value="<?php echo $row->NOME;?>" style="width:100%">
                    </span>
                    <br>
                Abreviatura: 			
                    <span class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="novo_estado_abreviatura" placeholder="SP" maxlength="2" class="k-input" value="<?php echo $row->ABREVIATURA;?>" style="width:100%">
                    </span>
                    <br>
                Código do País: 	
                    <span class="k-widget k-autocomplete k-header k-state-default">
                        <input type="text" name="novo_estado_pais" placeholder="5659" maxlength="4" class="k-input" value="<?php echo $row->CODIGO_PAIS;?>" style="width:100%">
                    </span>
                    <br><br />
                    <input type="button" value="CANCELAR" name="novo_estado_bt_limpar"  class="k-button">
                    <input type="button" value="SALVAR" name="novo_estado_bt_salvar" class="k-button">
            </form>
            <br><br>
            <span class="resultado_novo_estado"></span>
        	<script>
		//EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR===================================================
		$('input[name="novo_estado_bt_salvar"]').click( function(){
			
			var desc		= $('input[name="novo_estado_nome"]');
			var abre		= $('input[name="novo_estado_abreviatura"]');
			var codp		= $('input[name="novo_estado_pais"]');
			var cod			= $('input[name="codigo_novo_estado"]');
			
			if(desc.val() == '' || desc.val() == null){
				erro(desc,'Escreva a descrição');
			}else{
				if(abre.val() == '' || abre.val() == null){
					erro(abre, 'Escreva a abreviatura');
				}else{
					if(codp.val() == '' || codp.val() == null){
						erro(abre, 'Escreva a código do país');
					}else{
		
						//Caso todos os campos estiverem preenchidos faça
						$.ajax({
							url: 'php/cadastro/estado/atualizar_estado.php', 
							dataType: 'html',
							data: { 
									codigo:cod.val(),
									descricao:desc.val(),
									abreviatura:abre.val(), 
									codigo_pais:codp.val(), 
								},
							type: 'POST',
							success: function(data, textStatus) {
										$('.resultado_novo_estado').html('<p>' + data + '</p>');
										$('#retorno_novo_estado').load('php/cadastro/estado/lista_de_estados.php');
										
										limparTodos('form[name="nova_estado"] input[type="text"]');
										nome.focus();
										setTimeout(function(){$('.resultado_novo_estado').html('');},5000);
										$('#cadastro_estado').load('cadastro_estado.php');
									 },
							error: function(xhr,er) {
										$('.resultado_novo_estado').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
										
									 }		
									 
						});						
					}
				}
			}
		});
		
		$('input[name="novo_estado_bt_limpar"]').click( function(){
			$('#cadastro_estado').load('cadastro_estado.php');
		});
		</script>