<?php 
	include('../../classes/bd_oracle.class.php');  
	$query = oci_parse($conecta, 
			'SELECT 
				  EMPCOD AS CODIGO_EMPRESA, 
				  TABPRECOD AS CODIGO, 
				  TABPREDEN AS DESCRICAO,
				  TABPREINDVEN AS INDICE_VENDA
			  FROM 
			   	  TABELA_PRECO  
			  WHERE 
			  	  TABPRECOD  = '.$_GET['id']
			);
	
	oci_execute($query);
	
	$row = oci_fetch_object($query)
?>		
<html>
	<head>
		<script type="text/javascript">
        
	        //EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR ========================================================
			$('input[name="tabela_preco_nova_bt_salvar"]').click( function(){
				
				//Variaveis
				var tabela_preco	= $('input[name="tabela_preco_nome"]');
				var indice      	= $('input[name="tabela_preco_indice"]');
				var codigo			= $('input[name="tabela_preco_codigo"]');
				//Valida Variaveis
				if(tabela_preco.val() == '' || tabela_preco.val() == null){
					erro(tabela_preco,'Escreva o grupo');
				}else{
					$.ajax({
							 url: 'php/cadastro/produto_tabela_preco/atualizar_tabela.php', 
						dataType: 'html',
							data: { 
									"indice_venda"		:	indice.val(),
									"tabela_preco"		:	tabela_preco.val(),
									"codigo"			:	codigo.val(),
								   },
							type: 'POST',
					  beforeSend: function(){
						  				$('.retorno_produto_grupo').html('<img src="img/aguarde.gif" width="80" height="15" alt="Aguarde">');
						  			},
						 success: function(data) {
										$('.retorno_tabela_preco_nova').html(data);
										
										limparTodos('form[name="form_tabela_preco_nova"] input[type="text"]');
										tabela_preco.focus();
										setTimeout(function(){$('.retorno_tabela_preco_nova').html('');},5000);
										setInterval($('#cadastro_produto_tabela_preco').load('cadastro_produto_tabela_preco.php'),5000);
									},
							error: function(xhr,er) {
										$('.retorno_tabela_preco_nova').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
			
									}		
					});
					
				}
			});
			//==================================================================================================
			
			// EFEITO BOTÃO CANCELAR GRUPO =====================================================================	
			$('input[name="tabela_preco_nova_bt_cancelar"]').click( function(){
				$('#cadastro_produto_tabela_preco').load('cadastro_produto_tabela_preco.php');				
			});
			// =================================================================================================
        
        </script>    
	</head>
    <body>
		<div id="tabela_preco_form_nova" style="width:100%; text-align:right;">
        	<form name="form_tabela_preco_nova">
				<input type="hidden" name="tabela_preco_codigo" value="<?php echo $row->CODIGO;     ?>"  />
                <h3>Alterar tabela de Preços</h3>
                
               
                <label for="tabela_preco_nome">Tabela: </label><br />

                <input type="text" name="tabela_preco_nome"   value="<?php echo $row->DESCRICAO;    ?>" placeholder="PREÇO 1" maxlength="50">
                <br /><br />
        
        
                <label for="tabela_preco_indice">Índice de Venda: </label><br />
        
                <input type="text" name="tabela_preco_indice" value="<?PHP echo $row->INDICE_VENDA; ?>" placeholder="1,2" 	 maxlength="4">
                
                <br>
                <br>
            
                <input type="button" name="tabela_preco_nova_bt_salvar" value="Salvar" class="k-button">
                <input type="button" name="tabela_preco_nova_bt_cancelar" value="Cancelar" class="k-button">
                
                <br />
                <br />
                <span class="retorno_tabela_preco_nova"></span>
            </form>

        </div>
 	</body>
</html>