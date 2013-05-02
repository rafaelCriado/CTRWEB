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

<!-------------------- CHAMADA DO ESTILO E DO jAVASCRIPT--------------------->
<link rel="stylesheet" href="css/pages/financeiro/financeiro_contas_a_receber.css" />

<script type="text/javascript" src="js/pages/financeiro/financeiro_contas_a_receber.js" >	</script>

<!------------------------------------------------------------------------------>

<!--------DIV PARA COR E TAMANHO DO FUNDO----------->
<div class="Fundo_total">
    
    <!-------FORMULARIO SUPERIOR --------->
        <div class="Filtros_top">
        
            <fieldset>
                <legend> <strong> Filtros </strong> </legend>
                    <span  class="ConRec_lb_descricao"> Descrição: </span>
                    <input type="text" name="ConRec_descricao" id="ConRec_descricao" placeholder="Coloque uma descrição."/>
                    
                    <span   class="ConRec_lb_campo"> Campo: </span>
                    <select name="ConRec_select_campo" id="ConRec_select_campo">
                        <option> Selecione </option>
                            <?php    ?>
                    </select> <br />    
                    
                    <span   class="ConRec_lb_data"> Data: </span>
                    <select name="ConRec_select_data">
                        <option value="venc"> Vencimento</option>
                        <option value="venc"> Entrada</option>
                        <option value="venc"> Recebimento</option>
                    </select>
                    
                    <span   class="ConRec_lb_data_ini"> De: </span>
                    <input  type="text" name="ConRec_data_ini" placeholder="00/00/0000"/>
                    
                    <span   class="ConRec_lb_data_fin"> Até: </span>
                    <input  type="text" name="ConRec_data_fin" placeholder="00/00/0000">
                    
                    <span  class="ConRec_lb_empresa"> Empresa: </span>
                    <input type="text" name="ConRec_empresa" id="ConRec_empresa" disabled="disabled" value="<?php   ?>" />
            </fieldset>
            
        </div>
    <!-------------------------------------->
    
    <!-----CAMPO DA TABELA-------->
    <div class="Contas"> 
                    
    </div>
    <!-------------------------------->
    
    <!--------INFERIOR DA TELA-------->
        <!----FORMULARIO INFERIOR1----->
        <div class="Func_botton1">
        
       	  <input type="button" name="ConRec_bt_desconto"  id="ConRec_bt_desconto"  value="Desconto" />
       	  <input type="button" name="ConRec_bt_lanCheque" id="ConRec_bt_lanCheque" value="Lançamento Cheque" />
       	  <input type="button" name="ConRec_bt_recCheque" id="ConRec_bt_recCheque" value="Recebimento Cheque" />
              <div class="quant_total">
              
                  <span  class="ConRec_lb_quantidade" > Quantidade: </span>
                  <input type="text" name="ConRec_quantidade" disabled="disabled"	id="ConRec_quantidade" value="<?php  ?>" />
                  
                  <span  class="ConRec_lb_ttselecionado"> Total Selecionado: </span>
                  <input type="text" name="ConRec_ttselecionado" disabled="disabled" id="ConRec_ttselecionado" value="<?php  ?>" />
                  
              </div>
          <input type="button" name="ConRec_bt_baixar" id="ConRec_bt_baixar" value="Baixar" />
          
        </div>
        <!---------------------------->
        <!----FORMULARIO INFERIOR2----->
        <div class="Func_botton2">
        
        	<fieldset>
            	<legend><strong> Informação do Documento </strong> </legend>
                	<span  class="ConRec_lb_numero"> Numero: </span> 
                    <input type="text" name="ConRec_numero" id="ConRec_numero" placeholder="Informe o Número"/>
                    
                    <span  class="ConRec_lb_venda" > Venda/Representante: </span>
                    <input type="text" name="ConRec_cod"    id="ConRec_cod" placeholder="Cod"/>
                    <input type="text" name="ConRec_nome"   id="ConRec_nome" placeholder="Nome representante"/>
                    
            </fieldset>
            
        </div>
        <!---------------------------->
    
    
        <!----FORMULARIO INFERIOR3----->
        <div class="Func_botton3">
        
       	  <fieldset>
            	<legend><strong> Status </strong></legend>
                <input type="radio"  value="aberto/parcial" name="ConRec_ck"  id="ConRec_ck1" checked="checked"/> Aberto/Parcial
                <input type="radio"  value="baixa_total"    name="ConRec_ck"  id="ConRec_ck2"/> Baixa Total
                <input type="radio"  value="adiantamento"   name="ConRec_ck"  id="ConRec_ck2"/> Adiantamento
                <input type="radio"  value="todos"          name="ConRec_ck"  id="ConRec_ck4"/> Todos
          </fieldset>
            
        </div>
        <!---------------------------->
    
</div>