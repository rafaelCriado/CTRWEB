<style>
	#tela_pessoa_texto_pesquisa span{ float:left;}
	#tela_pessoa_tipo_pesquisa{ padding-top:1%; width:99%; height:40px; text-align:left; text-align:left; border:0px solid red; }
	#tela_pessoa_tipo_pesquisa input{ text-align:left;}
	#entidade_pesquisa_aba_dois_table{ width:100%}
	#entidade_pesquisa_tabela{ padding:0px 2px;}
	.botao_ativado{
		border-color: #7ec6e3;
		background-color: #7bd2f6;
	}
	.tr_selecionada{ background:#09C; color:#fff;} 
</style>
<div id="tela_pessoa_tipo_pesquisa">
    <input type="button" value="Nome" 		class="k-button" name="tipo_pesquisa_entidade_nome" 	style="float:left"/>
    <input type="button" value="N. Fantasia"class="k-button" name="tipo_pesquisa_entidade_fantasia" style="float:left" />
    <input type="button" value="Endereco" 	class="k-button" name="tipo_pesquisa_entidade_endereco" style="float:left"/>
    <input type="button" value="Cidade" 	class="k-button" name="tipo_pesquisa_entidade_cidade" 	style="float:left"/>
    <input type="button" value="Codigo" 	class="k-button" name="tipo_pesquisa_entidade_codigo" 	style="float:left"/>
   <!-- <input type="button" value="Telefone" 	class="k-button" name="tipo_pesquisa_entidade_telefone" style="float:left"/> -->
    <input type="button" value="CPF" 		class="k-button" name="tipo_pesquisa_entidade_cpf" 		style="float:left"/>
    
    <input type="hidden" value="Nome" name="tipo_pesquisa_entidade_selecionada" />
    
    
    <!-- QUANDO PREENCHIDO INPUT ABAIXO RETORNA UM VALOR PARA A TELA INFORMADA. -->
    	<input type="hidden" value="0" name="tipo_pesquisa_tela_retorno" />
    <!-- -->
</div>    

<div id="tela_pessoa_texto_pesquisa">
    <fieldset>
    <span>
        Pesquisar: <br />
        <input type="text" name="entidade_texto_pesquisa" value="" placeholder="Escreva sua pesquisa" size="80">
    </span>
    
    <span>
    
    	 &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
    	Exibir Endereço:<br />
		 &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;<input type="radio" name="entidade_endereco_pesquisa"  value="principal" checked="checked"/>Principal
        &nbsp;&nbsp;&nbsp;
		<input type="radio"  name="entidade_endereco_pesquisa" value="cobranca"/>Cobrança
    </span>
    </fieldset>
</div>  
<br />
<div id="entidade_pesquisa_tabela">
    <table id="entidade_pesquisa_aba_dois_table">
        <tr class="k-header">
            <td>Código</td>
            <td>Nome</td>
            <td>Telefone</td>
            <td>Endereço</td>
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