<?php 
	error_reporting(0);

	//Sessão
	include('../../classes/session.class.php');
	
	//Inclui banco da dados e funções
	include('../../classes/bd_oracle.class.php');
	include '../../functions.php';
	
	//Inicia Sessão
	$sessao = new Session();
	
	//Recebe informações
	if($_POST){
		
		//Recebe variaveis
		$texto 			= strtoupper($_POST['texto']);
		$tipo_pesquisa	= $_POST['tipo_pesquisa'];
		//Tipo de Pesquisa
		switch($tipo_pesquisa){
			//Pesquisa por descrição
			case 0:
				{
					//Consulta
					$sql = "SELECT P.PROCOD        AS CODIGO,
								   P.PRODES        AS DESCRICAO,
								   PG.PROGRUDEN    AS GRUPO,
								   PS.PROSUBGRUDEN AS SUBGRUPO,
								   P.PRONCM        AS NCM
							  FROM PRODUTO P
							  LEFT JOIN PRODUTO_GRUPO PG
								ON P.PROGRUCOD = PG.PROGRUCOD
							  LEFT JOIN PRODUTO_SUBGRUPO PS
								ON P.PROSUBGRUCOD = PS.PROSUBGRUCOD
							 WHERE P.EMPCOD = ".$sessao->getNode('empresa_acessada')."
							   AND P.PRODES LIKE '%".$texto."%'";
				}
				break;
			
			//Pesquisa Por codigo
			case 1:
				{
					//Consulta
					$sql = "SELECT P.PROCOD        AS CODIGO,
								   P.PRODES        AS DESCRICAO,
								   PG.PROGRUDEN    AS GRUPO,
								   PS.PROSUBGRUDEN AS SUBGRUPO,
								   P.PRONCM        AS NCM
							  FROM PRODUTO P
							  LEFT JOIN PRODUTO_GRUPO PG
								ON P.PROGRUCOD = PG.PROGRUCOD
							  LEFT JOIN PRODUTO_SUBGRUPO PS
								ON P.PROSUBGRUCOD = PS.PROSUBGRUCOD
							 WHERE P.EMPCOD = ".$sessao->getNode('empresa_acessada')."
							   AND PROCOD LIKE '%".$texto."%'";
							 
				}	
				break;
				
			//Pesquisa por grupo
			case 2:
				{
					//Consulta
					$sql = "SELECT P.PROCOD        AS CODIGO,
								   P.PRODES        AS DESCRICAO,
								   PG.PROGRUDEN    AS GRUPO,
								   PS.PROSUBGRUDEN AS SUBGRUPO,
								   P.PRONCM        AS NCM
							  FROM PRODUTO P
							  LEFT JOIN PRODUTO_GRUPO PG
								ON P.PROGRUCOD = PG.PROGRUCOD
							  LEFT JOIN PRODUTO_SUBGRUPO PS
								ON P.PROSUBGRUCOD = PS.PROSUBGRUCOD
							 WHERE P.EMPCOD = ".$sessao->getNode('empresa_acessada')."
							   AND PG.PROGRUDEN LIKE '%".$texto."%'";
							 
				}	
				break;
				
			default:
				{
					$sql = "";
				}
				break;
		}
		
		//Prepara a consulta
		$query = oci_parse($conecta,$sql);
		
		if(oci_execute($query)){
			echo '<tr class="k-header">
						<td>Código</td>
                    	<td>Descrição</td>
                    	<td>Grupo</td>
                    	<td>Sub-Grupo</td>
                    	<td>NCM</td>
                        <td></td>
                  </tr>';

			//Recebe informações
			
			while($prod = oci_fetch_object($query)){
				?>
				<tr id="<?php echo $prod->CODIGO;	?>">
					<td><?php echo $prod->CODIGO;	?></td>
                    <td title="<?php echo $prod->DESCRICAO;?>"><?php echo textoFORMAT($prod->DESCRICAO,20);?></td>
					<td><?php echo $prod->GRUPO; 	?></td>
					<td><?php echo $prod->SUBGRUPO;	?></td>
					<td><?php echo $prod->NCM;		?></td>
					<td>
						<a href="#" id="<?php echo $prod->CODIGO;?>" name="prod_bt_editar">Visualizar/Editar</a> 
						&nbsp;&nbsp;						
						<a href="#" id="<?php echo $prod->CODIGO;?>" name="prod_bt_excluir">Excluir</a>
					</td>
				</tr>
				<?php
			}
						
			
		}
		
	}
?>
