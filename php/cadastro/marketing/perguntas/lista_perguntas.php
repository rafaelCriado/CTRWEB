<?php 
	if(!isset($sessao)){
		//Inclui classe de sessão
		include('../../../classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('../../../functions.php');
		
		//Inclui banco de dados
		include('../../../classes/bd_oracle.class.php');
	}

?>

<table class="CMP_tb_lista" cellpadding="0" cellspacing="0">
	<tr>
    	<td colspan="3" class="k-header title"> Perguntas </td>
    </tr>
	<tr>
    	<td>Código</td>
        <td>Pergunta</td>
        <td></td>
    </tr>
<?php 
	//Lista de Perguntas
	
	
	$sql_perguntas = "  SELECT PESPERCOD AS CODIGO,
							   PESPERDES AS DESCRICAO,
							   EMPCOD    AS EMPRESA,
							   USUCOD    AS USUARIO
						  FROM PESQUISAS_PERGUNTAS";
						  
	$query_perguntas = oci_parse($conecta,$sql_perguntas);
	
	if(oci_execute($query_perguntas)){
		while($pergunta = oci_fetch_object($query_perguntas)){
			?>
            	<tr>
            		<td><?php echo $pergunta->CODIGO;    ?></td>
                    <td><?php echo $pergunta->DESCRICAO; ?></td>
                    <td>
                    	<a href="#" name="CMP_bt_alterar" title="<?php echo $pergunta->CODIGO;    ?>">Alterar</a>&nbsp;&nbsp;
                    	<a href="#" name="CMP_bt_excluir" title="<?php echo $pergunta->CODIGO;    ?>">Excluir</a>
                    </td>
                </tr>
            <?php
		}
	}
	
?>
</table>