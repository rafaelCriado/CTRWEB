
<?php
 
error_reporting(0);

	if(!isset($sessao)){
		//Inclui classe de sessão
		include('../../../../php/classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('../../../../php/functions.php');
		
		//Inclui banco de dados
		include('../../../../php/classes/bd_oracle.class.php');
	}

?>

<table width="100%">
    <tr>
        <td colspan="10" class="k-header title">
            Formas Cadastradas
        </td>
    </tr>
    
    <?php
		
		//Consulta Estados Cadastrados
		$query = oci_parse($conecta,'SELECT FORPAGNUM AS CODIGO, FORPAGDES AS NOME FROM FORMAS_PAGAMENTO WHERE EMPCOD = '.$sessao->getNode('empresa_acessada'));
			
		oci_execute($query);

        while ($row = oci_fetch_object($query)) {
            ?>
            <tr id="<?php echo utf8_encode($row->CODIGO); ?>" class="linha_fp">
                <td><?php echo utf8_encode($row->NOME); ?></td>
            </tr> 
            <?php
        }
    ?>
</table>
<script>
var seleciona_forma_de_pagamento = function(classe){
	$(classe).click(function(e){
		e.preventDefault();
		var valor = classe;
		
		//Efeito visual;
		efeito_cor_linha_tabela(valor);
		
		
		//Evento;
		var id = $(this).attr('id');
		
		$.post(
			'php/cadastro/financeiro/forma_pagamento/formulario.php',
			{'id':id},
			function(data){
				$('div#fp_form_sup').html(data);
			}
		);
		
		
	});
}


var efeito_cor_linha_tabela = function(classe){
	
		var id = $(classe).attr('id');
		
		$('tr[id!="'+id+'"], tr[id!="'+id+'"] td').removeClass('tr_selecionada');
		$('tr[id="'+id+'"],  tr[id="'+id+'"]  td').addClass('tr_selecionada');
		
	
}
seleciona_forma_de_pagamento('.linha_fp');
</script>