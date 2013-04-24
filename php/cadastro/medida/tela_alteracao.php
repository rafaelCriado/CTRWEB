<?php 
	error_reporting(0);
	include('../../classes/bd_oracle.class.php');  
	$query = oci_parse($conecta, 
			"SELECT 
				UM.UNIMEDCOD AS CODIGO, 
				UM.UNIMEDDES AS DESCRICAO 
			 FROM 
			 	UNIDADE_MEDIDA UM 
			WHERE 
				UM.UNIMEDCOD = '".$_GET['id']."'"
			);
	
	oci_execute($query);
	
	$row = oci_fetch_object($query);
?>		

<h3>Atualizar Medida</h3>
<form name="nova_medida">
                
    Medida:	<br />
    <input type="text" name="nova_medida_codigo" placeholder="M" maxlength="5" value="<?php echo $row->CODIGO; ?>">
	<br />
    <br />
    
    Descrição: 			<br />

    <input type="text" name="nova_medida_descricao" placeholder="Metro" maxlength="100"  value="<?php echo $row->DESCRICAO; ?>" >
    
    <br>
    <br>
    <br>
    
    <input type="button" value="CANCELAR" name="nova_medida_bt_cancelar"  class="k-button">
    <input type="button" value="SALVAR" name="nova_medida_bt_salvar" class="k-button">
</form>

<br>
<br>

<span class="resultado_nova_medida"></span>

<script>
    //EVENTO DO BOTÃO NOVA_EMPRESA_BT_ATUALIZAR ========================
    $('input[name="nova_medida_bt_salvar"]').click( function(){
        
        var medida		= $('input[name="nova_medida_codigo"]');
        var descricao	= $('input[name="nova_medida_descricao"]');
        
        
        if(medida.val() == '' || medida.val() == null){
            erro(medida,'Escreva a medida');
        }else{
            if(descricao.val() == '' || descricao.val() == null){
                erro(descricao, 'Escreva a descrição');
            }else{

                //Caso todos os campos estiverem preenchidos faça
                $.ajax({
                    url: 'php/cadastro/medida/atualizar_medida.php', 
                    dataType: 'html',
                    data: { 
                            med:medida.val(),
                            des:descricao.val(), 
                        },
                    type: 'POST',
                    success: function(data, textStatus) {
                                $('.resultado_nova_medida').html('<p>' + data + '</p>');
                                $('#retorno_nova_medida').load('php/cadastro/medida/lista_de_medidas.php');
                                
                                limparTodos('form[name="nova_medida"] input[type="text"]');
                                medida.focus();
                                setTimeout(function(){$('.resultado_nova_medida').html('');},5000);
                                $('#cadastro_medida').load('cadastro_medida.php');
                             },
                    error: function(xhr,er) {
                                $('.resultado_nova_medida').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>');
                                alert('erro');
                             }		
                             
                });						
            }
        }
    });
    // =================================================================
    
    //BOTÃO CANCELAR ===================================================
    $('input[name="nova_medida_bt_cancelar"]').click( function(){
        $('#cadastro_medida').load('cadastro_medida.php');
    });
    // =================================================================
</script>