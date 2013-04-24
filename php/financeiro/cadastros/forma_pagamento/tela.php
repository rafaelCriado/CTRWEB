<?php 
	//Inclui banco de dados
	error_reporting(0);
	include('php/classes/bd_oracle.class.php');
	
	
	include "../../../functions.php";
	
	
	
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
?>
	<script src="js/pages/financeiro/cadastro_financeiro_condicaopagamento.js"></script>
    <link href="css/pages/financeiro/cadastro_financeiro_condicaopagamento.css" rel="stylesheet" type="text/css" />

    <div id="tabstrip_FC_formapagamento">
        
        <!-- Abas -->
        <ul>
            <li class="k-state-active">
                Novo
            </li>
            <li>
                Condições Cadastradas
            </li>
        </ul>
        <!-- Fim Abas -->

        <!-- Primeira Aba (NOVO)-->
        <div id="FC_formapagamento_aba_um">
            <div id="FC_formapagamento_superior">
                <?php 
                    if(isset($_REQUEST['condigo_condicao_pagamento']) and !empty($_REQUEST['condigo_condicao_pagamento'])){
                        //Pesquisa dados
                        $sql = "SELECT CP.CONPAGCOD AS CODIGO,
									   CP.CONPAGDEN AS NOME,
									   CP.CONPAGQTDPAR AS PARCELAS,
									   CP.CONPAGDIAPAR AS DIFERENCA_PARCELA,
									   CP.CONPAGDIAPRIPAR AS PRIMEIRA_PARCELA,
									   (CP.FINPARNUM || '|' || CP.FINPARCAR || '|' || CP.FINCOD) AS FINANCEIRA_CODIGO,
									   CP.FORPAGNUM AS FORMA_PAGAMENTO,
									   F.FINNOM AS FINANCEIRA
								  FROM COND_PAG CP, FINANCEIRAS F
								 WHERE CP.FINCOD = F.FINCOD
								   AND CP.CONPAGCOD =".$_REQUEST['condigo_condicao_pagamento'].
								  "AND CP.EMPCOD = ".$sessao->getNode('empresa_acessada');
								   
                                  
                        $query_condicao = oci_parse($conecta,$sql);
                        
                        oci_execute($query_condicao);
                        
                        $condicao = oci_fetch_object($query_condicao);
                        
                        
                    }
                ?>
            
                <form name="FC_formapagamento">
                <fieldset>
                
                    
                    <input type="hidden" name="codigo_condicao_pagamento" 
                        value="<?php echo (isset($condicao->CODIGO))? $condicao->CODIGO:'';?>">
                
                    <legend>Condições</legend>
                    <label for="FC_formapagamento_descricao">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descrição: </label>
                    <input type="text" name="FC_formapagamento_descricao" 
                        value="<?php echo (isset($condicao->NOME))? $condicao->NOME:'';?>" maxlength="100" placeholder="30x60x90" size="8">
                    
                    
                    <label for="FC_formapagamento_qtde_parcelas">Qtde. Parcelas: </label>
                    <input type="text" name="FC_formapagamento_qtde_parcelas" 
                        value="<?php echo (isset($condicao->PARCELAS))? $condicao->PARCELAS:'';?>" maxlength="2" size="8">
                    
                    
                    <label for="FC_formapagamento_primeira_parcela">Dia da 1ª Parcela: </label>
                    <input type="text" name="FC_formapagamento_primeira_parcela"  maxlength="3" 
                        value="<?php echo (isset($condicao->PRIMEIRA_PARCELA))? $condicao->PRIMEIRA_PARCELA:'';?>" size="8" >
                    <br />

                    
                    <label for="FC_formapagamento_diferenca_parcela">Dif. das Parcelas: </label>
                    <input type="text" name="FC_formapagamento_diferenca_parcela" maxlength="3"
                        value="<?php echo (isset($condicao->DIFERENCA_PARCELA))? $condicao->DIFERENCA_PARCELA:'';?>" size="8">
                        
                        
                        
                   <span>
                       <label for="FC_formapagamento_bt_financeira">&nbsp;&nbsp;&nbsp;&nbsp;Financeiras:</label>     
                       <input type="button" name="FC_formapagamento_bt_financeira" value="Localizar" style="float:none"/>			   
                       <input type="text" disabled name="FC_formapagamento_financeira" value="<?php echo (isset($condicao->FINANCEIRA))? $condicao->FINANCEIRA:'';?>">
                       <input type="hidden" name="FC_formapagamento_financeira_codigo" value="<?php echo (isset($condicao->FINANCEIRA_CODIGO))? $condicao->FINANCEIRA_CODIGO:'';?>">
                       <script>
					   	$('input[name="FC_formapagamento_bt_financeira"]').click(function(e){
							e.preventDefault();
							$('a[name="pesquisa_financeira"]').click();
							
							setTimeout(function(){$.post('pesquisa_financeira.php',
									{'parametro': 1},
									function(data){
										$('#pesquisa_financeira').html(data);
										setTimeout(function(){$('input[name="pesquisa_financeira_tela_retorno"]').val('cadastro_financeiro_condicaopagamento|NOME:FC_formapagamento_financeira,CODIGO:FC_formapagamento_financeira_codigo')},1000);;
										
							});},1000);
							
						});
                       </script>
                   </span>     
                    <br /><br />

    
                   <label for="FC_form_pagamento">Vincular Forma de Pagamento: </label>
                   <select name="FC_form_pagamento">
                   		<option value=""></option>
                   		<?php 
							//Lista forma de pagamento
							$sql_fp = 'SELECT FORPAGNUM AS CODIGO, FORPAGDES AS NOME FROM FORMAS_PAGAMENTO WHERE EMPCOD = '.$sessao->getNode('empresa_acessada');
							
							$query_fp = oci_parse($conecta,$sql_fp);
							
							if(oci_execute($query_fp)){
								while($fp = oci_fetch_object($query_fp)){
									echo '<option value="'.$fp->CODIGO.'">'.$fp->NOME.'</option>';
								}
							}
						?>
                   </select>
                   <script>
				   	$('select[name="FC_form_pagamento"]').val(<?php echo (isset($condicao->FORMA_PAGAMENTO))? $condicao->FORMA_PAGAMENTO:'';?>);
                   </script>     
                        
                        
                </fieldset>
                
            </div>
            <div id="FC_formapagamento_inferior" >
                <fieldset>
                    <legend>Parcelas</legend>
                    <table id="FC_formapagamento_table_parcelas" style="overflow:auto; max-height:200px;">
                        <tr class="k-header">
                            <td>Condição de Pagamento</td>
                            <td>Número da Parcela</td>
                            <td>Dia da Parcela</td>
                            <td></td>
                        </tr>
                        <?php
                            if(isset($_REQUEST['condigo_condicao_pagamento']) and !empty($_REQUEST['condigo_condicao_pagamento'])){
                                //Consulta parcelas
                                $sql = 'SELECT CPP.CONPAGCOD    AS CODIGO,
                                               CP.CONPAGDEN     AS DESCRICAO,
                                               CPP.CONPAGPARSEQ AS SEQUENCIA_PARCELA,
                                               CPP.CONPAGPARDIA AS DIA_PARCELA
                                          FROM COND_PAG_PARC CPP, 
                                               COND_PAG CP
                                         WHERE CPP.CONPAGCOD = CP.CONPAGCOD
                                           AND CPP.CONPAGCOD = '.$_REQUEST['condigo_condicao_pagamento'];
                                //Prepara query
                                $query_parcelas = oci_parse($conecta,$sql);
                                
                                //Executa
                                oci_execute($query_parcelas);
                                
                                //Recebe valores
                                while($parcela = oci_fetch_object($query_parcelas)){
                                    echo '<tr>';
                                    echo 	'<td title="'.$parcela->DESCRICAO.'">'.textoFORMAT($parcela->CODIGO.' - '.$parcela->DESCRICAO,25).'</td>';
                                    echo 	'<td>'.$parcela->SEQUENCIA_PARCELA.'</td>';
                                    echo 	'<td id="id_'.$parcela->SEQUENCIA_PARCELA.'">'.$parcela->DIA_PARCELA.'</td>';
                                    echo 	'<td><a href="#" id="'.$parcela->SEQUENCIA_PARCELA.'" name="FC_formapagamento_bt_editar">Editar</a></td>';
                                    echo '</tr>';
                                }
                                
                            }
                        ?>
                        
                    </table>
                </fieldset>
            </div>
            <div id="FC_botoes">
                <input type="button" name="FC_formapagamento_bt_incluir" value="Salvar" class="k-button">
                &nbsp;&nbsp;&nbsp;
                <input type="button" name="FC_formapagamento_bt_novo" value="Novo" class="k-button">
                <span class="retorno_FC_formapagamento"></span>

            </form>
            </div>                   
            
            <div style="clear:both"></div>
        </div>
        <!-- Fim Primeira aba-->
        
        
        <!-- Segunda Aba (CONDIÇÕES CADASTRADAS)-->
        <div id="FC_formapagamento_aba_dois">
            <fieldset>
            <legend>Condições de Pagamento</legend>
            <table id="FC_formapagamento_aba_dois_table" height="200px" cellpadding="0" cellspacing="0">
                <tr class="k-header">
                    <td>Código</td>
                    <td>Descrição</td>
                    <td>Parcelas</td>
                    <td>Diferença</td>
                    <td>Primeira Parcela</td>
                    <td></td>
                </tr>
                
                <?php 
                    //Pesquisa de condições de pagamento
                    $sql = "SELECT CP.CONPAGCOD AS CODIGO,
                                   CP.CONPAGDEN AS DESCRICAO,
                                   CP.CONPAGQTDPAR AS PARCELAS,
                                   CP.CONPAGDIAPAR AS DIFERENCA,
                                   CP.CONPAGDIAPRIPAR AS PRIMEIRA_PARCELA
                              FROM COND_PAG CP 
							 WHERE CP.EMPCOD = ".$sessao->getNode('empresa_acessada');
                    
                    $query_pagamento = oci_parse($conecta,$sql);
                    
                    oci_execute($query_pagamento);
                    
                    while($forma_pagamento = oci_fetch_object($query_pagamento)){
                    
                        ?>
                        <tr id="<?php echo $forma_pagamento->CODIGO;?>">
                            <td><?php echo $forma_pagamento->CODIGO;			?></td>
                            <td title="<?php echo $forma_pagamento->DESCRICAO;?>"><?php echo textoFORMAT($forma_pagamento->DESCRICAO,22);	?></td>
                            <td><?php echo $forma_pagamento->PARCELAS;			?></td>
                            <td><?php echo $forma_pagamento->DIFERENCA;			?></td>
                            <td><?php echo $forma_pagamento->PRIMEIRA_PARCELA;	?></td>
                            <td><a href="#" id="<?php echo $forma_pagamento->CODIGO;?>" name="FC_formapagamento_bt_editar_forma">Editar</a> &nbsp;&nbsp;<a href="#" id="<?php echo $forma_pagamento->CODIGO;?>" name="FC_formapagamento_bt_excluir_forma">Excluir</a></td>
                        </tr>
                        <?php
                    }
                    ?>
            </table>
            
            </fieldset>
        </div>
        <!-- Fim Segunda aba-->
    
        
    </div>
