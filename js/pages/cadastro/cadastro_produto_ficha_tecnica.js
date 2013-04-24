    //EFEITO DE ABAS ============================================================
    $("#tabstrip_ficha_tecnica").kendoTabStrip({
        animation:	{
            open: {
                
                effects: "fadeIn"
            }
        }
    
    });
    // ==========================================================================
	
	// Menu Superior ============================================================
		$('#fc_menu').kendoMenu();
	// ==========================================================================
	
	
	
	
	// BOTÃO SETA (PESQUISAR POR CODIGO) ========================================
		$('input[name="ft_bt_seta"]').click(function(e){
			e.preventDefault();
			
			
			
		});		
	// ==========================================================================
	
	// BOTÃO MENU PESQUISAR =====================================================
		$('a[name="ft_bt_pesquisar"]').click(function(e){
			e.preventDefault();
			$('#tabela_ficha_tecnica').load('php/cadastro/produto_ficha_tecnica/select_ficha_tecnica.php');
			$('	form[name="ficha_tecnica_adicionar"] input,	form[name="ficha_tecnica_adicionar"] textarea').attr('disabled','disabled').val('0');
			$(' form[name="ficha_tecnica_adicionar"] input:eq(0)').removeAttr('disabled');
			//Oculta abas
			$('#tela_total').css({display:'none'});
			//Mostra tabela
			$('#tabela_ficha_tecnica').css({display:'block'});
			$('input[name="insert_item_ficha"]').attr('disabled',true);
			
			
			
		});		
	// ==========================================================================
	
	// BOTÃO SALVAR =============================================================
		$('a[name="ft_bt_salvar"]').click(function(e){
			e.preventDefault();
			
			//Variaveis
			var produto = $('input[name="ft_produto_codigo_selecionado"]').val();
			var produto_selecionado = $('input[name="ft_codigo_selecionado"]').val();
			
			
			if(produto_selecionado == ''){
			
				$.ajax({
					url			: 	'php/cadastro/produto_ficha_tecnica/insert_ficha_tecnica.php', 
					dataType	: 	'json',
					data		: 	{	"produto"	: produto	},
					type		: 	'POST',
					success		: 	function(data) {
										//alert(data);
										
										var msg 	= data[0].texto;
										var codRet = data[0].codigo_retorno;
										
										if(codRet != 0){
											$('input[name="ft_codigo"]').val(codRet);
											$('input[name="ft_codigo_selecionado"]').val(codRet);
											alert(msg);
										}else{
											alert(msg);
										}
									},
					error		: 	function() {
										alert('Erro de requisição');	
									}		
				});	
				
			}else{
				
				alert('Clique em NOVO, para incluir uma nova ficha tecnica!');
				
			}
			
		});		
	// ==========================================================================
	
	// BOTÃO MENU NOVO ==========================================================
		$('a[name="ft_bt_novo"]').click(function(e){
			e.preventDefault();
			
			$.post(
				'php/cadastro/produto_ficha_tecnica/tela_itens_ficha_tecnica.php/',
				{ "ficha_tecnica": ''},
				function(data){
					$('#itens_ficha_tecnica').html(data);
				}
			);
			
			$('#tabstrip_ficha_tecnica ul li:eq(0)').addClass('k-state-active');
			$('#tabstrip_ficha_tecnica ul li:eq(1)').removeClass('k-state-active');
			
			$('input[name="ft_produto_codigo"]').removeAttr('disabled');
			$('input[name="insert_item_ficha"]').attr('disabled',false);
			$('	form[name="ficha_tecnica_adicionar"] input,	form[name="ficha_tecnica_adicionar"] textarea').val('');
			$('input[name="ft_produto_codigo_selecionado"]').val('0');
			
			//Esconde tabelas
			$('#tabela_ficha_tecnica').css({display:'none'});
			
			//Mostra tela
			$('#tela_total').css({display:'block'});
			
			var produto_codigo = $('input[name="ft_produto_codigo_selecionado"]').val();
			
			if( produto_codigo == 0 ){
				$('a[name="cadastro_produto_pesquisa"]').click();
				setTimeout(function(){
					$('input[name="tipo_pesquisa_produto_tela_retorno"]')
						.val('cadastro_produto_ficha_tecnica|CODIGO:ft_produto_codigo_selecionado,CODIGO:ft_produto_codigo,DESCRICAO:ft_produto_nome,CODIGO_GRUPO:ft_produto_grupo_codigo,GRUPO:ft_produto_grupo_nome,CODIGO_SUBGRUPO:ft_produto_subgrupo_codigo,SUBGRUPO:ft_produto_subgrupo_nome,CODIGO_EMPRESA:ft_produto_empresa_codigo,EMPRESA:ft_produto_empresa_nome')},2000);
			}
			
			
		});		
	// ==========================================================================

	
	//	EFEITO EM TABELAS ======================================================= 
	$('.tr_table_fc_tecnicas').live('click',function(){

		var id = $(this).attr('id');
		
		$('tr[id!="'+id+'"], tr[id!="'+id+'"] td').removeClass('tr_selecionada');
		$('tr[id="'+id+'"], tr[id="'+id+'"] td').addClass('tr_selecionada');
	});
	// ==========================================================================
	
	// DUPLO CLICK EM ITENS DA TABELA ===========================================
	$('.tr_table_fc_tecnicas').live('dblclick',function(e){
		e.preventDefault();
		
		//Variaveis
		var ficha_tecnica = $(this).attr('id');
		
		
		if(ficha_tecnica != ''){
			
			//Consulta informações do produto da ficha tecnica.
			$.getJSON(
				"php/cadastro/produto_ficha_tecnica/info_ficha_tecnica.php", 
				{ "codigo"	: ficha_tecnica	},
				function(data) {
					if(data.codigo_retorno == 1){
						
						$('input[name="ft_codigo_selecionado"]').val(data.CODIGO_FICHA_TECNICA);
						$('input[name="ft_codigo"]').val(data.CODIGO_FICHA_TECNICA);
						$('input[name="ft_produto_codigo_selecionado"]').val(data.CODIGO_PRODUTO);
						$('input[name="ft_produto_codigo"]').val(data.CODIGO_PRODUTO);
						$('input[name="ft_produto_nome"]').val(data.PRODUTO);
						$('input[name="ft_produto_grupo_codigo"]').val(data.CODIGO_GRUPO);
						$('input[name="ft_produto_grupo_nome"]').val(data.GRUPO);
						$('input[name="ft_produto_subgrupo_nome"]').val(data.SUBGRUPO);
						$('input[name="ft_produto_subgrupo_codigo"]').val(data.CODIGO_SUBGRUPO);
						$('input[name="ft_observacao"]').val(data.OBSERVACAO_FICHA_TECNICA);
						$('input[name="ft_produto_empresa_codigo"]').val(data.CODIGO_EMPRESA);
						$('input[name="ft_produto_empresa_nome"]').val(data.EMPRESA);
						
						$('#ft_observacao ul li:eq(0)').addClass('active');
						$('#tabela_ficha_tecnica').css({display:'none'});
						$('#tela_total').css({display:'block'});
						
						$.post(
							'php/cadastro/produto_ficha_tecnica/tela_itens_ficha_tecnica.php/',
							{ "ficha_tecnica": data.CODIGO_FICHA_TECNICA},
							function(data){
								$('#itens_ficha_tecnica').html(data);
							}
						);
						
						
						
					}else{
						alert(data.texto);
					}
				}
			);
			
		}
		
	});
	// ==========================================================================
	
	// AO PREENCHER CODIGO ALIMENTA OS ITENS ================================
		
	//=======================================================================
	
	//EVENTO AO CLICAR NO BOTÃO =================================================
		$('input[name="insert_item_ficha"]').live('click',function(e){
			e.preventDefault();
			
				$.get(
					'php/cadastro/produto_ficha_tecnica/line_item_ficha_tecnica.php',
					function(data){
						$('#tb_itens_ficha').append(data);
					}
				)
			
		});
	// ==========================================================================
	
	
	