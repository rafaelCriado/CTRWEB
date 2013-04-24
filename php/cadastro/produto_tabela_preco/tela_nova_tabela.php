<!-- DIV TELA NOVA TABELA FORMULARIO-->
<div id="tabela_preco_form_nova" style="height:100%; border:1px solid #94C0D2; margin-right:2px;">
	<form name="form_tabela_preco_nova">
		
        <h3>Nova tabela de Preços&nbsp;</h3>
        
       
	
		
        <label for="tabela_preco_nome">Tabela: </label><br />

        <input type="text" name="tabela_preco_nome"   value="" placeholder="PREÇO 1" maxlength="50">
        <br /><br />


        <label for="tabela_preco_indice">Índice de Venda: </label><br />

        <input type="text" name="tabela_preco_indice" value="" placeholder="1,2" 	 maxlength="4">
		
        <br>
		<br>
	
    	<input type="button" name="tabela_preco_nova_bt_gravar" value="Gravar" class="k-button">
        
        <br />
		<br />
		<span class="retorno_tabela_preco_nova"></span>
    </form>
</div>
<!-- FIM DIV -->


<div id="tabela_preco_lista">
	<?php	
		//Listas de tabelas cadastradas
		include('php/cadastro/produto_tabela_preco/lista_de_tabelas_de_preco.php');
	?>
</div>