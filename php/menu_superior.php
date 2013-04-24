<style>
	#megaStore {
		width: 100%;
		margin: 0px auto;
		padding-top: 0px;
		
	}
	#menu h2 {
		font-size: 1em;
		text-transform: uppercase;
		padding: 5px 10px;
	}
	#template img {
		margin: 5px 20px 0 0;
		float: left;
	}
	#template {
		width: 380px;
	}
	#template ol {
		float: left;
		margin: 0;
		padding: 10px 10px 0 10px;
	}
	#template:after {
		content: ".";
		display: block;
		height: 0;
		clear: both;
		visibility: hidden;
	}
	#template .k-button {
		float: left;
		clear: left;
		margin: 5px 0 5px 12px;
	}
</style>
<script>
	$('#megaStore a').live('click',function(){

		var tela = $(this).attr('name');
		var codigo_tela = $(this).attr('id');
		
		if(tela != 'sair'){
			$('#'+tela+ ' input[type="text"],#'+tela+ ' input[type="hidden"]').val('');
			$.getJSON( 'php/verifica_sessao.php',
				{},
				function(data){
					
					if(data == 0){
						alert('Você deslogou do sistema!');
						window.location.href="sair.php";
					}else{
						
						//Verifica permissão de tela.
						$.getJSON(
							'php/verifica_permissao.php',
							{	
								"tela":tela,
								"codigo": codigo_tela
							},
							function(data){
								if(!data.permissao){
									$('#'+ tela).html('<br><br><br><center><h3>Acesso negado para usuário!</h3><center>');
								}else{
									//$('#'+ tela).load(tela+'.php');
								}
							}
						);
						
					}
				}	
			)
		}else{
			$('a[name="sair"]').click();
		}
	});
</script>


<div id="megaStore">
    <ul id="menu">
    	<!-- Menu Cadastro -->
        <li>
            Cadastros
            <ul>
            
                        <!-- Sub-Menu Entidades -->
                        <li>
                            Pessoas
                            <ul>
                                <li><a href="#" id="130" name="cadastro_entidade_tipo" 				title="Cadastro de Tipo"><img src="img/typeclient.png" />Tipo</a></li>
                                <li><a href="#" id="129" name="cadastro_entidade_pessoa" 			title="Cadastro de Pessoas"><img src="img/client.png" />Pessoa</a></li>
                                <li><a href="#" id="129" name="cadastro_entidade_pesquisa_pessoa" 	title="Pesquisa de Pessoas"><img src="img/searchclient.png" />Pesquisa Pessoa</a></li>
                            </ul>
                        </li>
                		<!-- Fim Meno Entidades -->  


						<li>
                        	Produto
                            <ul>
                                <li><a  href="#" id="135" name="cadastro_produto" 				title="Cadastro de Produtos"><img src="img/product.png"  />Produtos</a></li>
                                <li><a  href="#" id="135" name="cadastro_produto_pesquisa" 		title="Pesquisa de Produtos"><img src="img/searchproduct.png" />Pesquisa Produtos</a></li>
                                <li><a  href="#" id="136" name="cadastro_produto_grupo_sub" 	title="Cadastro de Grupos e Sub-Grupos"><img src="img/groupproduct.png" />Grupo\Sub-Grupo</a></li>
                                <li><a  href="#" id="158" name="cadastro_produto_tabela_preco" 	title="Tabela de Preços"><img src="img/tabela_preco.png" />Tabela de Preços</a></li>
                                <li><a  href="#" id="197" name="cadastro_produto_ficha_tecnica" title="Cadastro de Ficha Técnica"><img src="img/fichatecnica.png" />Ficha Técnica</a></li>
                            </ul>
                        </li>
                        
                        <!-- Sub-Menu Controle de Usuários -->
                        <li>
                            Controle de Usuário
                            <ul>
                                <li><a href="#" id="131" name="controle_usuario_cadastrar" 		title="Cadastrar Usuário">Cadastro de Usuários</a></li>                
                                <li><a href="#" id="132" name="controle_usuario_acesso" 		title="Cadastro de Acessos">Cadastro de Acessos</a></li>
                                
                                <li><a href="#" id="133" name="controle_usuario_restricao" 		title="Controle de Usuário - Restrições">Restrições</a></li>
                                <li><a href="#" id="134" name="controle_usuario_grupo_sub" 		title="Cadastro de Grupos de Usuários">Cadastro de Grupos de Usuários</a></li>
                            </ul>
                        </li>
                		<!-- Fim Meno Controle de Usuários --> 
                        
                        
                        
                        
                        <!-- Sub-Menu Localidade -->
                        <li>Localidade
                            <ul>
                                <li><a  href="#" id="128" name="cadastro_cidade" title="Cadastro de Cidades">Cidades</a></li>
                                <li><a  href="#" id="127" name="cadastro_estado" title="Cadastro de Estados">Estados</a></li>
                            </ul>
                        </li>
                        <!-- Fim Meno Localidade --> 
                        
                        
                        <!-- FINANCEIRO -->
                        <li>Financeiro
                        	<ul>
                            	<li><a  href="#" id="278" name="cadastro_financeiro_tipo_pagamento" 		title="Tipos de Pagamento">Tipos de Pagamento</a></a></li>
                            	<li><a  href="#" id="277" name="cadastro_financeiro_forma_pagamento" 		title="Cadastro de Formas de Pagamento">Formas de Pagamento</a></a></li>
                            	<li><a  href="#" id="257" name="cadastro_financeiro_financeira" 			title="Tabelas Financeira">Financeira</a></a></li>
                            	<li><a  href="#" id="258" name="cadastro_financeiro_parametros_financeira" 	title="Parametrização de Financeiras"> Parametros Financeira</a></a></li>
                                <li><a href="#" id="137"  name="cadastro_financeiro_condicaopagamento" 		title="Cadastro de Condição de Pagamento">Condição de Pagamento</a></li>
                                <li style="display:none"><a href="#" id="137" name="pesquisa_financeira" 		 title="Pesquisa"></a></li>
                                <li style="display:none"><a href="#" id="177" name="pesquisa_condicao_pagamento" title="Pesquisa"></a></li>
                            </ul>
                        </li>
                        <!-- FIM FINANCEIRO-->
                        
                        
                        
                        
                        
                        
                        
                        
                        <!-- Confiugações -->
                        <li>Configurações
                        	<ul>
                            	<li><a  href="#" id="136" name="cadastro_configuracao_empresa" title="Configuração de Empresa">Loja</a></a></li>
                            	<li><a  href="#" id="317" name="cadastro_configuracao_filial"  title="Configuração de Filial">Filial</a></a></li>
                            </ul>
                        </li>
                        
                        <li>Marketing
                        	<ul>
                            	<li><a  href="#" id="136" name="cadastro_marketing_perguntas" title="Marketing - Perguntas">Perguntas</a></a></li>
                            </ul>
                        </li>
                        
                        
                        
                        <li><a  href="#" id="126" name="cadastro_empresa" title="Cadastro de Empresas">Empresas</a></li>
                        <li><a  href="#" id="125" name="cadastro_medida" title="Cadastro de Unidade de Medida">Unidade de Medida</a></li>
                                                                  
            </ul>
        </li>
        <!-- Fim Menu Cadastro -->
        
        
        <li>
        	Financeiro
            <ul>
            	<li>
                	Cartões
                    <ul>
                    	<li><a href="#" id="297" name="financeiro_cartoes_parametros" title="Parametros de Transações com Cartão de Crédito" >Parametros das Transações</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        
        
        
        
        <!-- Menu Orçamentos -->
        <li>
        	Orçamentos
        	<ul>
            	<li><a href="#" id="177" name="pedido_orcamento" title="Orçamentos" >Inclusão</a></li>                
            	<li><a href="#" id="177" name="pedido_orcamento_pesquisar" title="Consulta de Pedidos/Orçamento" >Pesquisa</a></li>                
            </ul>
        </li>
        <!-- Fim Menu Orçamentos -->

        <!-- Menu Pedidos -->
        <li>
        	Pedido
        	<ul>
            	<li><a href="#" id="337" name="pedido_pedidos_enviar" title="Pedidos a Enviar" >Pedidos a enviar</a></li>                
            	<li><a href="#" id="338" name="pedido_pedidos_enviados" title="Pedidos Enviados" >Pedidos enviados</a></li>                
            </ul>
        </li>
        <!-- Fim Menu Orçamentos -->


	

        <!-- Menu Relatórios -->
        <li>
        	Relatórios
        	<ul>
            	<li>
            		Vendedores
                    <ul>
                        <li><a href="#" id="237" name="relatorios_vendedores_carteira_cliente" title="Carteira de Clientes" >Carteira de Clientes</a></li>                
                    </ul>    
                </li>
                
            </ul>
        </li>
        <!-- Fim Menu Relatórios -->
        
        
        
        
        
        
        <li>
        	Geo-Marketing
            <ul>
            	<li><a href="#" id="137" name="geo" title="GEO LOCALIZAÇÃO DOS CLIENTES">Localização dos Clientes</a></li>
            </ul>
        </li>
        
        
        
        
        
        
        
        <li style="display:none"><a href="#" id="177" name="salvar_imagem" title="Imagem"></a></li>
        
        
        <li>
            <a id="sair" name="sair" href="sair.php">Sair</a>
        </li>
    </ul>
</div>