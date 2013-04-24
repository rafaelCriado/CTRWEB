<?php 
	include('../../classes/bd_oracle.class.php');  
	$query = oci_parse($conecta, "select 
									  c.cidcod codigo,
									  c.cidnom cidade,
									  c.cidnac codigo_nacional,
									  c.cidibg codigo_ibge,
									  c.cidufcod cod_estado,
									  u.ufnom nome
									from 
									  cidade c, uf u WHERE c.cidufcod = u.ufcod and c.cidcod =".$_GET['id']);
	
	oci_execute($query);
	
	$cid = oci_fetch_object($query);

	//Consulta Estados Cadastrados
	$query_cidade = oci_parse($conecta, 
		'SELECT 
			UFCOD AS CODIGO, 
			UPPER(UFNOM) AS ESTADO, 
			UPPER(UFABREV) AS ABREVIATURA, 
			UFCODPAIS AS PAIS_CODIGO 
		 FROM 
			UF
		 ORDER BY
			ABREVIATURA'
		);
	oci_execute($query_cidade);
	?>	
	<h3>Atualizar Cidade</h3>
	<form name="nova_cidade">
		<input type="hidden" value="<?php echo $_GET['id'];?>" name="nova_cidade_codigo" />          
		Estado:	
        <select name="nova_cidade_estado">
			<?php
                while ($row = oci_fetch_object($query_cidade)) {
                    echo '<option value="'.$row->CODIGO.'">'.$row->ABREVIATURA.'</option>';
                }
            ?>
        </select>
        <br>
		
        Cidade: 			
	   	<input type="text" name="nova_cidade_cidade" placeholder="Mirassol"   value="<?php echo $cid->CIDADE;?>" maxlength="100">
		<br>
		
        Código Nacional: 	
		<input type="text" name="nova_cidade_codigo_nacional" placeholder="30300"  value="<?php echo $cid->CODIGO_NACIONAL;?>" >
		<br>
		
        Código IBGE: 			
		<input type="text" name="nova_cidade_codigo_ibge" placeholder="35"   value="<?php echo $cid->CODIGO_IBGE;?>">
		
        <br>
		<br>
        <br>
		
        <input type="button" value="CANCELAR" name="nova_cidade_bt_cancelar" class="k-button">
		<input type="button" value="SALVAR" name="nova_cidade_bt_salvar" class="k-button">
	</form>
	<br><br>
	<span class="resultado_nova_cidade"></span>
	<script>

$('select[name="nova_cidade_estado"]').val('<?php echo $cid->COD_ESTADO;?>')	

//EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR===================================================
$('input[name="nova_cidade_bt_salvar"]').click( function(){
	
	var codigo			= $('input[name="nova_cidade_codigo"]');
	var estado			= $('select[name="nova_cidade_estado"]');
	var cidade			= $('input[name="nova_cidade_cidade"]');
	var codigo_nacional	= $('input[name="nova_cidade_codigo_nacional"]');
	var codigo_ibge		= $('input[name="nova_cidade_codigo_ibge"]');
	
	
	if(estado.val() == '' || estado.val() == null){
		erro(estado,'Escreva o estado');
	}else{
		if(cidade.val() == '' || cidade.val() == null){
			erro(cidade, 'Escreva a cidade');
		}else{
			if(codigo_nacional.val() == '' || codigo_nacional.val() == null){
				erro(codigo_nacional, 'Escreva o código nacional');
			}else{
				if(codigo_ibge.val() == '' || codigo_ibge.val() == null){
					erro(codigo_ibge, 'Escreva o código IBGE');
				}else{
					//Caso todos os campos estiverem preenchidos faça
					$.ajax({
						url: 'php/cadastro/cidade/atualizar_cidade.php', 
						dataType: 'html',
						data: { 
								cod:		codigo.val(),
								uf:			estado.val(),
								cid:		cidade.val(),
								cnacional:	codigo_nacional.val(), 
								cibge:		codigo_ibge.val(), 
							},
						type: 'POST',
						success: function(data) {
									$('.resultado_nova_cidade').html(data);
									$('#retorno_nova_cidade').load('php/cadastro/cidade/lista_de_cidades.php');
									
									limparTodos('form[name="nova_cidade"] input[type="text"]');
									cidade.focus();
									setTimeout(function(){$('.resultado_nova_cidade').html('');},5000);
									$('#cadastro_cidade').load('cadastro_cidade.php');
								 },
						error: function(xhr,er) {
									$('.resultado_nova_cidade').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
									
								 }		
								 
					});
				}
			}
		}
	}
});

$('input[name="nova_cidade_bt_cancelar"]').click( function(){
	$('#cadastro_cidade').load('cadastro_cidade.php');
});
</script>