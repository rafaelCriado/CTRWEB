<?php 
	include('../../classes/bd_oracle.class.php');  
	$query = oci_parse($conecta, 
			'SELECT 
					EMPCOD AS CODIGO_EMPRESA, 
					PROGRUCOD AS CODIGO, 
					PROGRUDEN AS GRUPO
			   FROM 
			   		PRODUTO_GRUPO  
			  WHERE 
			  		PROGRUCOD  = '.$_GET['id']
			);
	
	oci_execute($query);
	
	$row = oci_fetch_object($query)
?>		
<html>
	<head>
		<script type="text/javascript">
        	//Alimenta Campo ===================================================================================
        	$('select[name="empresa_produto_grupo"]').val(<?php echo $row->CODIGO_EMPRESA;?>);
			// =================================================================================================
        
	        //EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR ========================================================
			$('input[name="bt_produto_grupo_gravar"]').click( function(){
				
				//Variaveis
				var grupo			= $('input[name="produto_grupo_descricao"]');
				var codigo			= $('input[name="produto_grupo_codigo"]');
			
				//Valida Variaveis
				if(grupo.val() == '' || grupo.val() == null){
					erro(grupo,'Escreva o grupo');
				}else{
					$.ajax({
							 url: 'php/cadastro/produto_grupo_sub/atualizar_grupo.php', 
						dataType: 'html',
							data: { 	
									"grupo"		:	grupo.val(),
									"codigo"	:	codigo.val(),
								   },
							type: 'POST',
					  beforeSend: function(){
						  				$('.retorno_produto_grupo').html('<img src="img/aguarde.gif" width="80" height="15" alt="Aguarde">');
						  			},
						 success: function(data) {
										$('.retorno_produto_grupo').html(data);
										$('#retorno_produto_grupo').load('php/cadastro/produto_grupo_sub/lista_de_grupos.php');
				
										limparTodos('form[name="form_produto_grupo"] input[type="text"]');
										grupo.focus();
										setTimeout(function(){$('.retorno_produto_grupo').html('');},5000);
										setInterval($('#cadastro_produto_grupo_sub').load('cadastro_produto_grupo_sub.php'),5000);
									},
							error: function(xhr,er) {
										$('.retorno_produto_grupo').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
			
									}		
					});
					
				}
			});
			//==================================================================================================
			
			// EFEITO BOTÃO CANCELAR GRUPO =====================================================================	
			$('input[name="bt_produto_grupo_cancelar"]').click( function(){
				$('#cadastro_produto_grupo_sub').load('cadastro_produto_grupo_sub.php');				
			});
			// =================================================================================================
        
        </script>    
	</head>
    <body>
		<div id="formulario_produto_grupo" style="width:280px; float:left; margin:0;">
		<form name="form_produto_grupo">
            <fieldset class="fieldset">
                <legend>Cadastro</legend>
                
                <input type="hidden" name="produto_grupo_codigo" value="<?php echo $row->CODIGO;?>"  />
                
                <br>
                
                <label for="produto_grupo_descricao">Grupo: </label>
                <input type="text" name="produto_grupo_descricao" value="<?php echo $row->GRUPO;?>" maxlength="50">
                
                <br>
                <br>
                
                <input type="button" value="Salvar"   name="bt_produto_grupo_gravar"   class="k-button" style="float:right">
                &nbsp;
                <input type="button" value="Cancelar" name="bt_produto_grupo_cancelar" class="k-button" style="float:right">			
                
                <br>
                <br>
                
                <div class="retorno_produto_grupo"></div>
            </fieldset>
       	</form>
        </div>
 	</body>
</html>