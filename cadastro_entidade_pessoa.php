<?PHP 
	//Caso não exista sessão faça (Necessário devido efeito de alteração
	if(!isset($sessao)){
		//Inclui classe de sessão
		include('php/classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('php/functions.php');
		
		//Inclui banco de dados
		include('php/classes/bd_oracle.class.php');
	}

	//CONTROLE DE ACESSO
	$acessar = acessaTela(129, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						


	//Banco de dados
	include("php/classes/bd_oracle.class.php");
?>
<html>
	<head>
    	<link rel="stylesheet" type="text/css" href="css/pages/entidade/cadastro_entidade_pessoa.css">
    	<script type="text/javascript" src="js/pages/entidade/cadastro_entidade_pessoa.js"></script>
    </head>
    
	<body> 
    
    	<div id="marketing_pessoa" class="marketing_fechar">
        	
            <div id="cp_marketing_pessoa"> 
                <div id="marketing_pessoa_pergunta">
                    Como o cliente conheceu a RIOLAX?
                </div>
                
                <div id="marketing_pessoa_resposta">
                    <?php
                        $sql_respostas = '    SELECT PESPERCOD   AS PERGUNTA,
                                                     PESPEROPCOD AS CODIGO,
                                                     PESPEROPDES AS DESCRICAO,
                                                     USUCOD      AS USUARIO
                                                FROM PESQUISAS_PERGUNTAS_OPCOES
                                               WHERE PESPERCOD = 1';
                        
                        $query_respostas = oci_parse($conecta,$sql_respostas);
                        $query_respostas2 = oci_parse($conecta,$sql_respostas);
                        
                        
                        if(oci_execute($query_respostas)){
                            
                            $opcoes = oci_fetch_object($query_respostas);
                            
                            oci_execute($query_respostas2);
                            if(isset($opcoes->CODIGO) and !empty($opcoes->CODIGO)){
                                
                                echo '<select name="marketing_resposta">';
                                echo '<option value=""></option>';
                                
                                while($opt = oci_fetch_object($query_respostas2)){
                                    
                                    echo '<option name="'.$opt->CODIGO.'">'.$opt->DESCRICAO.'</option>';
                                    
                                    
                                    
                                }
                                
                                echo '</select>';
                            }else{
                                
                                echo '<input type="text" name="marketing_resposta" value="">';
                                
                            }
                            
                        }
                        
                    ?>
                    <input type="button" name="bt_marketing_entidade_gravar" value="Concluir">
                    
                </div>
            </div>
        </div>
    	
    
    
    	
    	<div id="cadastro_pessoa_principal">
            <div id="pesquisa"></div>
            <div id="tabstrip">
                
                <!-- Abas -->
                <ul id="menu_entidade_pessoa">
                    <li class="k-state-active">
                        Principal
                    </li>
                    
                    <li class="k-state-disabled">
                        Vínculos
                    </li>
                    
                    <li class="k-state-disabled">
                        Endereços
                    </li>
                    
                    <li class="k-state-disabled">
                        Crediário
                    </li>
                    
                    <li class="k-state-disabled">
                        Complementos
                    </li>
                </ul>
                <!-- Fim Abas -->
    
    
                <!-- Conteudo da Aba Pessoa -->
                <div id="form_pessoa">
                    <?php include('php/entidade/pessoa/tela_principal.php'); ?>
                </div>
                <!-- Fim do conteudo da aba pessoa-->
    
                <!-- Conteudo da Aba Vinculos -->
                <div id="form_vinculos">
                    <?php include('php/entidade/pessoa/tela_vinculos.php'); ?>
                </div>
                <!-- Fim do conteudo da aba vinculos-->
    
               
                <!-- Conteudo da Aba Endereço -->
                <div id="form_endereco">	
                    <?php include('php/entidade/pessoa/tela_enderecos.php');?>
                </div>
                <!-- Fim do conteudo da aba Endereço-->
    
                <!-- Conteudo da Aba Endereço -->
                <div id="form_crediario">	
                    <?php include('php/entidade/pessoa/tela_crediario.php');?>
                </div>
                <!-- Fim do conteudo da aba Endereço-->
                
    
                <!-- Conteudo da Aba Complementos -->
                <div id="form_complementos">
                    <?php include('php/entidade/pessoa/tela_complementos.php');?>
                </div>
                <!-- Fim do conteudo da aba Complementos-->
    
            </div>
    
            <!-- BOTÕES INFERIORES -->
            <div class="entidade_bt_inferior">
                <a href="#" class="k-button" name="bt_entidade_nova" >Novo</a>
                <span class="bt_editar"><a href="#" class="k-button" name="bt_entidade_editar" >Salvar Alterações</a></span>
                <span class="bt_gravar"><a href="#" class="k-button" name="bt_entidade_gravar" >Gravar</a></span>
                </span>
            </div>
            <!-- FIM BOTÕES INFERIORES-->
            <div id="resposta_entidade_pessoa"></div>
        </div>
	</body>
</html>

<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><span>";	
		
	}
?>
