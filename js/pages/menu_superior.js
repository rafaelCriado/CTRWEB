// Menu superior
	//CADASTROS
		
		//EMPRESA
		//PESSOAS
		//PRODUTOS
		//CONDIÇÕES DE PAGAMENTO
		//GRUPO/SUBGRUPO
		//UNIDADE DE MEDIDA
		
		//LOCALIDADE
			//CIDADE
			//ESTADO
	
	//CONTROLE DE USUARIO
		//CADASTRO DE USUÁRIOS ========================================================
		$('a[name="controle_usuario_restricao"]').live("click",function(){
			$('#controle_usuario_restricao').load('controle_usuario_restricao.php');
		});
		//=============================================================================
		//CADASTRO DE ACESSO ==========================================================
		$('a[name="controle_usuario_acesso"]').click("click",function(e){
			//$('#controle_usuario_acesso').load('controle_usuario_acesso.php');
			$.ajax({
				url: "controle_usuario_acesso.php",
				type: 'POST',
				success: function(data){
					//removendo todos os filhos do menu
					//$('#controle_usuario_acesso').find('li').remove();
					//incluindo novos itens no menu
					//$('#controle_usuario_acesso').append(data);
					//adicionando a função aos novos elementos
					//$('#controle_usuario_acesso a').click(trataClick);
				},
				error: function(){
				alert("Não foi possível recuperar o menu");
				}
			});
		});
		//=============================================================================
		//RESTRIÇÕES RESTRIÇÃO ========================================================
		$('a[name="controle_usuario_restricao"]').live("click",function(){
			$('#controle_usuario_restricao').load('controle_usuario_restricao.php');
		});
		//=============================================================================