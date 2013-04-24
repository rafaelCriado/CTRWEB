
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

<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
        <td class="k-header title">Cód.</td>
        <td class="k-header title">Rede</td>
        <td class="k-header title">D/C/E</td>
        <td class="k-header title">Descrição do tipo da Transação</td>
    </tr>
    
    <?php
		
		//Consulta Estados Cadastrados
		$query = oci_parse($conecta,'SELECT EMPCOD AS EMPRESA,
										   USUCOD AS USUARIO,
										   CARCRECOD AS CODIGO,
										   CARCRERED AS REDE,
										   CARCREDES AS NOME,
										   CARCRETIP AS TIPO,
										   CARCREREP  AS REPASSE,
										   CARCREFEC AS FECHAMENTO,
										   CARCRECC AS CONTA_CORRENTE,
										   FORNUMPAG AS FORMA_PAGAMENTO,
										   CARCRENUMMAXPAR AS MAXIMO_PARCELAS
									  FROM CARTAO_CREDITO
									  WHERE EMPCOD = '.$sessao->getNode('empresa_acessada'));
												
		oci_execute($query);

        while ($row = oci_fetch_object($query)) {
            ?>
            <tr id="<?php echo utf8_encode($row->CODIGO); ?>" class="linha_cc">
                <td><?php echo utf8_encode($row->CODIGO); ?></td>
                <td><?php echo utf8_encode($row->REDE); ?></td>
                <td><?php echo utf8_encode($row->TIPO); ?></td>
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
			'php/financeiro/cartoes/parametros/formulario.php',
			{'id':id},
			function(data){
				$('div#cc_form_sup').html(data);
			}
		);
		
		
	});
}


var efeito_cor_linha_tabela = function(classe){
	
		var id = $(classe).attr('id');
		
		$('tr[id!="'+id+'"], tr[id!="'+id+'"] td').removeClass('tr_selecionada');
		$('tr[id="'+id+'"],  tr[id="'+id+'"]  td').addClass('tr_selecionada');
		
	
}
seleciona_forma_de_pagamento('.linha_cc');
</script>