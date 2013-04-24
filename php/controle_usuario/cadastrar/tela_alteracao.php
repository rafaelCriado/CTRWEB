<?php 
	include('../../classes/bd_oracle.class.php');  
	$query = oci_parse($conecta, 
			"SELECT 
					U.USUCOD AS CODIGO, 
					U.USUNOM AS NOME, 
					U.USUPASS AS SENHA, 
					U.USUCAR AS CARGO,
					U.USUGRUCOD AS GRUPO
				FROM 
					USUARIO U 
				WHERE 
					U.USUCOD = '".$_GET['id']."'"
			);
	
	oci_execute($query);
	
	$row = oci_fetch_object($query);
?>		
<h3>Atualizar Usuário</h3>
<form name="novo_usuario">
    
    <input type="hidden" name="novo_usuario_codigo" value="<?php echo $row->CODIGO;?>" />
              
    Nome:
    <input type="text" name="novo_usuario_nome" placeholder="usuario" maxlength="12" value="<?php echo $row->NOME; ?>">
    <br><br>
    
    Senha: 			
    <input type="password" name="novo_usuario_senha" placeholder="senha" maxlength="8" value="<?php echo $row->SENHA;?>">
    <br><br>
    
    Cargo: 	
    <input type="text" name="novo_usuario_cargo" placeholder="Operador" maxlength="50" value="<?php echo $row->CARGO;?>">
    <br><br>

    Grupo:
    <select name="novo_usuario_grupo">
      	<option value="">Sem Grupo</option>

        <?php
            //Consulta grupos de usuario
            $query_grupo = oci_parse($conecta,"SELECT USUGRUCOD AS CODIGO, USUGRUDESC AS DESCRICAO FROM USUARIO_GRUPO");
            
            //Executa
            oci_execute($query_grupo);
            
            //Recebe Resultado
            while($row_grupo = oci_fetch_object($query_grupo)){
                echo '<option value="'.$row_grupo->CODIGO.'">'.$row_grupo->DESCRICAO.'</option>';
            }
        ?>
    </select>

    <br>
    <br>
    <br>
        
    <input type="button" value="CANCELAR" 	name="novo_usuario_bt_cancelar" class="k-button">
    <input type="button" value="SALVAR" 	name="novo_usuario_bt_salvar" 	class="k-button">
</form>
<br><br>
<span class="resultado_novo_usuario"></span>
<script>
	$('select[name="novo_usuario_grupo"]').val('<?php echo $row->GRUPO;?>');
	
	//EVENTO DO BOTÃO NOVO USUARIO BT SALVAR ===================================================
	$('input[name="novo_usuario_bt_salvar"]').click( function(){
		
		var nome 		= $('input[name="novo_usuario_nome"]');
		var senha		= $('input[name="novo_usuario_senha"]');
		var cargo		= $('input[name="novo_usuario_cargo"]');
		var codigo		= $('input[name="novo_usuario_codigo"]');
		var grupo		= $('select[name="novo_usuario_grupo"]');
		
		if(nome.val() == '' || nome.val() == null){
			erro(nome,'Escreva o nome');
		}else{
			if(senha.val() == '' || senha.val() == null){
				erro(senha, 'Escreva a senha');
			}else{
				if(cargo.val() == '' || cargo.val() == null){
					erro(cargo, 'Escreva o cargo');
				}else{
					//Caso todos os campos estiverem preenchidos faça
					$.ajax({
						url: 'php/controle_usuario/cadastrar/atualizar_novo_usuario.php', 
						dataType: 'html',
						data: { 
								"codigo":	codigo.val(),
								"nome"	: 	nome.val(),
								"senha"	:	senha.val(), 
								"cargo"	:	cargo.val(),
								"grupo"	:	grupo.val()
							},
						type: 'POST',
						success: function(data, textStatus) {
									$('.resultado_novo_usuario').html('<p>' + data + '</p>');
									$('#retorno_novo_usuario').load('php/controle_usuario/cadastrar/lista_de_usuarios.php');
									
									limparTodos('form[name="novo_usuario"] input[type="text"]');
									limparTodos('form[name="novo_usuario"] input[type="password"]');
									nome.focus();
									
									//Atualização de telas
									$('#controle_usuario_restricao').load('controle_usuario_restricao.php');
									
									setTimeout(function(){$('.resultado_novo_usuario').html('');},5000);
									setInterval(function(){$('#controle_usuario_cadastrar').load('controle_usuario_cadastrar.php');},5000);
								 },
						error: function(xhr,er) {
									$('.resultado_novo_usuario').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
									alert('erro');
								 }		
								 
					});	
				}
			}
		}
	});
	// =========================================================================================
	
	//BOTÃO CANCELAR ===========================================================================
	$('input[name="novo_usuario_bt_cancelar"]').click( function(){
		$('#controle_usuario_cadastrar').load('controle_usuario_cadastrar.php');
	});
	// =========================================================================================
</script>