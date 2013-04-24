<style>
	#tela_produto_texto_pesquisa span{ float:left;}
	#tela_produto_tipo_pesquisa{ padding-top:1%; width:99%; height:40px; text-align:left; text-align:left; border:0px solid red; }
	#tela_produto_tipo_pesquisa input{ text-align:left;}
	#entidade_pesquisa_aba_dois_table{ width:100%}
	#entidade_pesquisa_tabela{ padding:0px 2px;}
	.botao_ativado{
		border-color: #7ec6e3;
		background-color: #7bd2f6;
	}
	.tr_selecionada{ background:#09C; color:#fff;} 
</style>
<div id="tela_produto_tipo_pesquisa">
    <input type="button" value="Descricao"	class="k-button" name="tipo_pesquisa_produto_descricao"	style="float:left"/>
    <input type="button" value="Codigo" 	class="k-button" name="tipo_pesquisa_produto_codigo" 	style="float:left"/>
    <input type="button" value="Grupo" 		class="k-button" name="tipo_pesquisa_produto_grupo"		style="float:left"/>
    
    <input type="hidden" value="Descricao" name="tipo_pesquisa_produto_selecionada" />
    <input type="hidden" value="0" name="tipo_pesquisa_produto_tela_retorno" />
</div>    

<div id="tela_produto_texto_pesquisa">
    <fieldset>
    <span>
        Pesquisar: <br />
        <input type="text" name="produto_texto_pesquisa" value="" placeholder="Escreva sua pesquisa" size="80">
    </span>
    
    
    <!-- vinculos de tela -->
    <input name="produto_pesquisa_vinculo_tela" type="hidden"> 
    
    </fieldset>
</div>  
<br />
<div id="produto_pesquisa_tabela">
    <table id="produto_pesquisa_aba_dois_table">
        <tr class="k-header">
            <td>Código</td>
            <td>Descrição</td>
            <td>Grupo</td>
            <td>Subgrupo</td>
            <td></td>
        </tr>
        
        <tr height="150px">
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>