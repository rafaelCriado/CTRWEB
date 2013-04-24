// Página de Cadastro de Estados
	
	function erro(variavel, texto){
		variavel.attr('placeholder',texto);
		variavel.focus();
		variavel.css({background:'#FBB5BF', color:'red', fontWeight:'bold'});
		variavel.keypress(function(){ $(this).css({background:'#fff', color:'red', fontWeight:'normal'});});
	}
	
	//Limpa todos os campos
	function limparTodos(seletor){
		$(seletor).each(function(){
			$(this).val('');
		});
	}
	
	
	
	
	
	//EVENTO DO BOTÃO novo_tipo_pagamento_BT_CADASTRAR===================================================
	$('input[name="novo_tipo_pagamento_bt_cadastrar"]').live('click',function(e){
		e.preventDefault();
		var nome 		= $('input[name="novo_tipo_pagamento_nome"]');
		
		if(nome.val() == '' || nome.val() == null){
			erro(nome,'Escreva o nome');
		}else{
					
			//Caso todos os campos estiverem preenchidos faça
			$.ajax({
				url: 'php/cadastro/financeiro/tipo_pagamento/add_novo_tipo_pagamento.php', 
				dataType: 'html',
				data: { nome_: nome.val()},
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_novo_tipo_pagamento').html('<p>' + data + '</p>');
							$('#retorno_novo_tipo_pagamento').load('php/cadastro/financeiro/tipo_pagamento/lista_de_tipo_pagamento.php');
							
							//Atualização de telas.
							//$('#cadastro_cidade').load('cadastro_cidade.php');
							
							limparTodos('form[name="novo_tipo_pagamento"] input[type="text"]');
							nome.focus();
							setTimeout(function(){$('.resultado_novo_tipo_pagamento').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.resultado_novo_tipo_pagamento').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
						 
			});						
		}
	});
	//===========================================================================================
	

	
	
	//EVENTO DO BOTÃO novo_tipo_pagamento_BT_LIMPAR======================================================
	$('input[name="novo_tipo_pagamento_bt_limpar"]').live("click", function(e){
		e.preventDefault();
		//Inicio
		limparTodos('form[name="novo_tipo_pagamento"] input[type="text"]');
		//Fim
	});
	//===========================================================================================



	
	
	//EVENTO DO BOTÃO novo_tipo_pagamento_BT_EXCLUIR ====================================================
	$('a[name="novo_tipo_pagamento_bt_excluir"]').live('click',function(e){
		e.preventDefault();
		var id_ = $(this).attr("title");
		decisao = confirm("Deseja realmente excluir?");
		if (decisao){
			$.ajax({
				url: 'php/cadastro/financeiro/tipo_pagamento/excluir_tipo_pagamento.php', 
				dataType: 'html',
				data: { id:id_},
	
				type: 'POST',
				success: function(data, textStatus) {
							$('.resultado_novo_tipo_pagamento').html('<p>' + data + '</p>');
							$('#retorno_novo_tipo_pagamento').load('php/cadastro/financeiro/tipo_pagamento/lista_de_tipo_pagamento.php');
							
							//Atualização de telas.
							//$('#cadastro_cidade').load('cadastro_cidade.php');

							
							setTimeout(function(){$('.resultado_novo_tipo_pagamento').html('');},5000);
						 },
				error: function(xhr,er) {
							$('.resultado_novo_tipo_pagamento').html('<p class="destaque">Error ' + xhr.status + ' - ' + xhr.statusText + '<br />Tipo de erro: ' + er +'</p>')	
						 }		
			});
		}	
		
	});
	//===========================================================================================
	
	
	//EVENTO DO BOTÃO NOVA_ESTADO_BT_ALTERAR ====================================================
	$('a[name="novo_tipo_pagamento_bt_alterar"]').click(function(e){
		e.preventDefault();
		
		var codigo = $(this).attr("id");
		
		$.get("php/cadastro/financeiro/tipo_pagamento/tela_alteracao.php", 
			{id: codigo},
			function(data){
				$('#input_novo_tipo_pagamento').html(data);
			}
		);
	});
	//===========================================================================================
	
	
	function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){
    var sep = 0;
    var key = '';
    var i = j = 0;
    var len = len2 = 0;
    var strCheck = '0123456789';
    var aux = aux2 = '';
    var whichCode = (window.Event) ? e.which : e.keyCode;
    if (whichCode == 13) return true;
    key = String.fromCharCode(whichCode); // Valor para o código da Chave
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida
    len = objTextBox.value.length;
    for(i = 0; i < len; i++)
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;
    aux = '';
    for(; i < len; i++)
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);
    aux += key;
    len = aux.length;
    if (len == 0) objTextBox.value = '';
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;
    if (len > 2) {
        aux2 = '';
        for (j = 0, i = len - 3; i >= 0; i--) {
            if (j == 3) {
                aux2 += SeparadorMilesimo;
                j = 0;
            }
            aux2 += aux.charAt(i);
            j++;
        }
        objTextBox.value = '';
        len2 = aux2.length;
        for (i = len2 - 1; i >= 0; i--)
        objTextBox.value += aux2.charAt(i);
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);
    }
    return false;
}