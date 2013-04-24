<?php 
	include('../../../classes/bd_oracle.class.php');  
	
	$id = isset($_POST['id'])?(int)$_POST['id']:0;
	
	
	$query = oci_parse($conecta, "SELECT PESPERCOD AS CODIGO, PESPERDES AS DESCRICAO FROM PESQUISAS_PERGUNTAS WHERE PESPERCOD = ".$id);
	
	oci_execute($query);
	
	$pergunta = oci_fetch_object($query);

	//Consulta Estados Cadastrados
	$sql = "SELECT PESPEROPDES AS DESCRICAO FROM PESQUISAS_PERGUNTAS_OPCOES WHERE PESPERCOD = ".$id;
	$query_opcoes = oci_parse($conecta,$sql );
	oci_execute($query_opcoes);
	
	$opcao = array();
	$x=0;
	while($opt = oci_fetch_object($query_opcoes)){
		$opcao[$x]= (string)$opt->DESCRICAO;
		$x++;
	}
	$opcao = implode(',',$opcao);
	?>	
	<h3>Perguntas</h3>
    <form>
        Descrição da Pergunta:<br>
        <input type="text" name="CMP_pergunta" value="<?php echo isset($pergunta->DESCRICAO)?$pergunta->DESCRICAO:''; ?>">
        
        <br><br>
    
        <input type="checkbox" name="CMP_opcao" <?php if($id != 0){echo 'checked'; }?>> Resposta com opções
        <div class="CMP_opcao">
        	<?php if($id != 0){echo '<input type="text" value="'.$opcao.'" name="CMP_checkbox"><br>Digite as opções <br>separando-as por vírgula(,)'; }?>
        </div>
        
        <br>
        
        <input type="button" class="k-button" value="Salvar"  name="CMP_bt_salvar">
        <input type="button" class="k-button" value="Cancelar" name="CMP_bt_cancelar">
    </form>	
    <br><br>
	<span class="resultado_nova_cidade"></span>
	<script>

//EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR===================================================
$('input[name="CMP_bt_salvar"]').click( function(){
	
	var pergunta		= $('input[name="CMP_pergunta"]');
	var opcao			= $('input[name="CMP_checkbox"]');
	
	
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

$('input[name="CMP_bt_cancelar"]').click( function(){
	$.post('php/cadastro/marketing/perguntas/form_incluir_perguntas.php',{}, function(data){$('div#CMP_left').html(data)});
});
</script>