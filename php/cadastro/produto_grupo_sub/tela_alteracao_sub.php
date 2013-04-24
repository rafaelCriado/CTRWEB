<?php 
	include('../../classes/bd_oracle.class.php');  
	include('../../classes/session.class.php');  
	$sessao = new Session();

	$query = oci_parse($conecta, 
		'SELECT	
				PG.EMPCOD AS CODIGO_EMPRESA, 
				PG.PROSUBGRUCOD AS CODIGO_SUBGRUPO, 
				PG.PROSUBGRUDEN AS SUBGRUPO, 
				PG.PROGRUCOD AS CODIGO_GRUPO,
				PGR.PROGRUDEN AS GRUPO
		   FROM PRODUTO_SUBGRUPO PG, PRODUTO_GRUPO PGR
		  WHERE PGR.PROGRUCOD = PG.PROGRUCOD 
			AND PG.PROSUBGRUCOD = '.$_GET['id']
	);

	oci_execute($query);
	
	$row = oci_fetch_object($query)
?>		
<form name="form_produto_subgrupo">
	<fieldset class="fieldset">
        <legend>Cadastro</legend>
        
        <br>
        
        <label for="produto_subgrupo_grupo">Grupo: </label>
        <input name="produto_subgrupo_grupo_codigo_desc" value="<?php echo $row->GRUPO;?>" type="text" disabled="disabled">
        <input name="produto_subgrupo_grupo_codigo" value="<?php echo $row->CODIGO_GRUPO;?>" type="hidden">
        
        <br>
        <br>
        
        <label for="produto_subgrupo_descricao">Sub-Grupo: </label>
        <input type="text" name="produto_subgrupo_descricao" value="<?php echo $row->SUBGRUPO;?>" maxlength="50">
        <input type="hidden" name="produto_subgrupo_codigo" value="<?php echo $row->CODIGO_SUBGRUPO;?>">
        
        <br>
        <br>
        <br>
        
        <input type="button" value="Salvar" name="bt_produto_subgrupo_gravar" class="k-button" style="float:right">			
        &nbsp;<input type="button" value="Cancelar" name="bt_produto_subgrupo_cancelar" class="k-button" style="float:right">			

        <br>
        <div class="retorno_produto_subgrupo"></div>
    </fieldset>
</form>

<script>
	//EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR ===================================================
	$('input[name="bt_produto_subgrupo_gravar"]').click( function(){
		
		var grupo			= $('input[name="produto_subgrupo_grupo_codigo"]');
		var codigo_subgrupo	= $('input[name="produto_subgrupo_codigo"]');
		var subgrupo		= $('input[name="produto_subgrupo_descricao"]');
		
		
		if(subgrupo.val() == '' || subgrupo.val() == null){
			erro(subgrupo,'Escreva o grupo');
		}else{
			$.ajax({
				url: 'php/cadastro/produto_grupo_sub/atualizar_subgrupo.php', 
				dataType: 'html',
				data: { 	
						"grupo"				:	grupo.val(),
						"subgrupo"			:	subgrupo.val(),
						"codigo_subgrupo"	:	codigo_subgrupo.val(),
					},
				type: 'POST',
				success: function(data) {
							$('.retorno_produto_subgrupo').html(data);
							$('#div_produto_lista_sub').load('php/cadastro/produto_grupo_sub/lista_de_grupos.php');
							
							limparTodos('form[name="form_produto_subgrupo"] input[type="text"]');
							grupo.focus();
							setTimeout(function(){$('.retorno_produto_subgrupo').html('');},5000);
							setInterval($('#cadastro_produto_grupo_sub').load('cadastro_produto_grupo_sub.php'),5000);
						 },
				error: function(xhr,er) {
							$('.retorno_produto_grupo').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
							
						 }		
						 
			});
			
		}
	});
	// ============================================================================================
	
	// Evento do botão cancelar ===================================================================
	$('input[name="bt_produto_subgrupo_cancelar"]').click( function(){
		$('#cadastro_produto_grupo_sub').load('cadastro_produto_grupo_sub.php');
	});
	// ============================================================================================
</script>