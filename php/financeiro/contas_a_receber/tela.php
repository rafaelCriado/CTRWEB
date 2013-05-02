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
<link rel="stylesheet" href="../../../css/pages/financeiro/contas_a_receber.css" />

<script type="text/javascript" src="../../../js/pages/financeiro/contas_a_receber.js" >	</script>

<!------------------------------------------------------------------------------>

<style>

	div#contas_a_receber{
		padding:0 0 0 0;	
	}
	.Fundo_total{
		width:100%; height:100%; background:#E4E4E4; margin:auto;
	}
	.Filtros_top{
		width:100%;text-align:left;
	}
	Filtros_top_form{
		margin:5px 5px 5px 5px;	
	}
	#ConRec_descricao{
		width:400px;	
	}
	#ConRec_select_campo{
		width:250px;
	}
	select[name^='ConRec_select_data']{
		width:100px;	
	}
	.Contas{
		height:60%; width:99%; overflow:auto; border:1px solid #000; margin:auto; margin-top:2px;
	}
	.Func_botton1, .Func_botton3{
		width:100%; height:5%; margin-top:1px; float:left;
	}
	.Func_botton2{
		width:100%; height:10%; margin-top:2px; float:left;	
	}
	#ConRec_quantidade, #ConRec_ttselecionado{
		width:60px;	
	}
	input[id^='ConRec_bt']{
		float:left; padding:5px 5px 5px 5px; margin-right:10px;
	}
	#ConRec_bt_baixar{
		float:right;	
	}
</style>

<!--------DIV PARA COR E TAMANHO DO FUNDO----------->
<div class="Fundo_total">
    
    <!-------FORMULARIO SUPERIOR --------->
        <div class="Filtros_top">
        
            <fieldset>
                <legend><strong> Filtros </strong></legend>
                    Descrição: 
                    <input type="text" name="ConRec_descricao" id="ConRec_descricao"/>
                    Campo: 
                    <select name="ConRec_select_campo" id="ConRec_select_campo">
						<?php    ?>
                    </select> <br />    
                    Data:
                    <select name="ConRec_select_data">
                        <option></option>
                    </select>
                    De:
                    <select name="ConRec_select_data.ini">
                        <option></option>
                    </select>
                    Até:
                    <select name="ConRec_select_data.fin">
                        <option></option>
                    </select>
                    Empresa:
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
        
       	  <input type="button" name="ConRec_bt_desconto" id="ConRec_bt_desconto" value="Desconto" />
       	  <input type="button" name="ConRec_bt_lanCheque" id="ConRec_bt_lanCheque" value="Lançamento Cheque" />
       	  <input type="button" name="ConRec_bt_recCheque" id="ConRec_bt_recCheque" value="Recebimento Cheque" />
            Quantidade:
          <input type="text" name="ConRec_quantidade" disabled="disabled"	id="ConRec_quantidade" value="<?php  ?>" />
            Total Selecionado:
          <input type="text" name="ConRec_ttselecionado" disabled="disabled" id="ConRec_ttselecionado" value="<?php  ?>" />
          <input type="button" name="ConRec_bt_baixar" id="ConRec_bt_baixar" value="Baixar" />
          
        </div>
        <!---------------------------->
        <!----FORMULARIO INFERIOR2----->
        <div class="Func_botton2">
        
        	<fieldset>
            	<legend><strong> Informação do Documento </strong> </legend>
                	Numero: 
                    <input type="text" name="ConRec_numero" id="ConRec_numero"/>
                    Venda/Representante:
                    <input type="text" name="ConRec_venda" id="ConRec_venda"/>
                    <input type="text" name="ConRec_nome" id="ConRec_nome"/>
            </fieldset>
            
        </div>
        <!---------------------------->
    
    
        <!----FORMULARIO INFERIOR3----->
        <div class="Func_botton3">
        
        	<fieldset>
            	<legend><strong> Status </strong></legend>
                <input type="checkbox" value="aberto/parcial" name="ConRec_ck1" /> Aberto/Parcial
                <input type="checkbox" value="baixa_total" name="ConRec_ck2" /> Baixa Total
                <input type="checkbox" value="adiantamento" name="ConRec_ck3" /> Adiantamento
                <input type="checkbox" value="todos" name="ConRec_ck4" /> Todos
            </fieldset>
            
        </div>
        <!---------------------------->
    
</div>