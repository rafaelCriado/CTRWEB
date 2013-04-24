        <?php 
			include('../../classes/bd_oracle.class.php');  
			$query = oci_parse($conecta, "SELECT CATENTCODESTR AS CODIGO, CATENTDESC AS DESCRICAO, CATENTCLA AS CLASSIFICACAO FROM CATEG_ENTIDADE WHERE CATENTCODESTR = '".$_GET['id']."'");
			
			oci_execute($query);
			
			$row = oci_fetch_object($query);
		?>		
        <h3>Alterar Categoria de Pessoas</h3>
        <form name="nova_categoria_entidade">

            <input type="hidden" name="nova_categoria_entidade_codigo" placeholder="Código" maxlength="30" value="<?php echo $row->CODIGO;?>">
            

            Descrição: 	
            <input type="text" name="nova_categoria_entidade_descricao" placeholder="Descrição" maxlength="100" value="<?php echo $row->DESCRICAO;?>">
	        <br><br>

            Classificação: 	
            <select name="nova_categoria_entidade_classificacao">
                <option value="OUT">Outros</option>
                <option value="CLI">Clientes</option>
                <option value="FOR">Fornecedores</option>
                <option value="TRA">Transportadoras</option>
                <option value="REP">Representantes</option>
            </select><br />
            <br>
            <br><br />
            <input type="button" value="CANCELAR" name="nova_categoria_entidade_bt_cancelar" class="k-button">
            <input type="button" value="SALVAR" name="nova_categoria_entidade_bt_salvar" class="k-button">
            </form>
            <br><br>
            <span class="resultado_novo_tipo_categoria"></span>
        	<script>
				$('select[name="nova_categoria_entidade_classificacao"]').val('<?php echo $row->CLASSIFICACAO;?>');
				
				//EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR ========================================
				$('input[name="nova_categoria_entidade_bt_salvar"]').click( function(){
					
					var codigo			= $('input[name="nova_categoria_entidade_codigo"]');
					var descricao		= $('input[name="nova_categoria_entidade_descricao"]');
					var classificacao	= $('select[name="nova_categoria_entidade_classificacao"]');
					
					
					if(codigo.val() == '' || codigo.val() == null){
						erro(codigo,'Escreva o codigo');
					}else{
						if(descricao.val() == '' || descricao.val() == null){
							erro(descricao, 'Escreva a descricao');
						}else{
							if(classificacao.val() == '' || classificacao.val() == null){
								erro(classificacao, 'Escreva a classificação');
							}else{
								
								//Caso todos os campos estiverem preenchidos faça
								$.ajax({
									url: 'php/entidade/tipo/atualizar_tipo_entidade.php', 
									dataType: 'html',
									data: { 
											codigo_:		codigo.val(),
											descricao_:		descricao.val(),
											classificacao_:	classificacao.val(),
										},
									type: 'POST',
									success: function(data) {
												$('.resultado_novo_tipo_categoria').html(data);
												$('#retorno_novo_tipo_entidade').load('php/entidade/tipo/lista_de_tipo_entidades.php');		
												
												limparTodos('form[name="nova_categoria_entidade"] input[type="text"]');
												codigo.focus();
												setTimeout(
													function(){
														$('.resultado_novo_tipo_categoria').html('');
														$('#cadastro_entidade_tipo').load('cadastro_entidade_tipo.php');
													},
													4000);
												
											 },
									error: function(xhr,er) {
												$('.resultado_novo_tipo_categoria').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
												
											 }		
											 
								});
								
							}
						}
					}
				});
				//==================================================================================
				
				
				//Evento Cancelar ==================================================================
				$('input[name="nova_categoria_entidade_bt_cancelar"]').click( function(){
					$('#cadastro_entidade_tipo').load('cadastro_entidade_tipo.php');
				});
				//==================================================================================
			</script>