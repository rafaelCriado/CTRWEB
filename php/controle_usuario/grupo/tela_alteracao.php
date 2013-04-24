<?php 
	include('../../classes/bd_oracle.class.php');  
	$query = oci_parse($conecta, "SELECT USUGRUCOD AS CODIGO, USUGRUDESC AS DESCRICAO FROM USUARIO_GRUPO WHERE USUGRUCOD = ".$_GET['id']);
	
	oci_execute($query);
	
	$row = oci_fetch_object($query);
?>		
	<h3>Alterar Grupo de Usuário</h3>
	<form name="novo_grupo_usuario">
		<input type="hidden" value="<?php echo $row->CODIGO?>" name="novo_grupo_usuario_codigo" />	 
		Descrição: 			
		<input type="text" name="novo_grupo_usuario_descricao" placeholder="Grupo X" maxlength="100"  value="<?php echo $row->DESCRICAO?>">
		
		<br>
		<br>
        <br>
        
		<input type="button" value="CANCELAR"  	name="novo_grupo_usuario_bt_cancelar"    class="k-button">
		<input type="button" value="SALVAR" 	name="novo_grupo_usuario_bt_salvar" 	 class="k-button">
	</form>
	<br><br>
	<span class="resultado_novo_grupo_usuario"></span>
        	<script>
		//EVENTO DO BOTÃO NO GRUPO DE USUARIO BT SALVAR ===================================================
		$('input[name="novo_grupo_usuario_bt_salvar"]').click( function(){
			
			var codigo		= $('input[name="novo_grupo_usuario_codigo"]');
			var descricao	= $('input[name="novo_grupo_usuario_descricao"]');
			
			
			if(descricao.val() == '' || descricao.val() == null){
				erro(descricao, 'Escreva a descrição');
			}else{

				//Caso todos os campos estiverem preenchidos faça
				$.ajax({
					url: 'php/controle_usuario/grupo/atualizar_grupo_usuario.php', 
					dataType: 'html',
					data: { 
							"codigo"	:codigo.val(),
							"descricao"	:descricao.val(), 
						},
					type: 'POST',
					success: function(data, textStatus) {
								$('.resultado_novo_grupo_usuario').html('<p>' + data + '</p>');
								$('#retorno_novo_grupo_usuario').load('php/controle_usuario/grupo/lista_de_grupo_usuarios.php');
								
								limparTodos('form[name="novo_grupo_usuario"] input[type="text"]');
								descricao.focus();
								setTimeout(function(){$('.resultado_novo_grupo_usuario').html('');},5000);
								$('#controle_usuario_grupo_sub').load('controle_usuario_grupo_sub.php');
							 },
					error: function(xhr,er) {
								$('.resultado_novo_grupo_usuario').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
								alert('erro');
							 }		
							 
				});						
			}
		});
		
		//botão cancelar
		$('input[name="novo_grupo_usuario_bt_cancelar"]').click( function(){
			$('#controle_usuario_grupo_sub').load('controle_usuario_grupo_sub.php');
		});
		</script>