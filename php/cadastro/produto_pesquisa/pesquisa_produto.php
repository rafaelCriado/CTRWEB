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
		$valor = '';
		//Tipo de Pesquisa
		if($tipo_pesquisa == 'Codigo'){
			$valor .= "P.PROCOD LIKE '%$texto%'";
		}
		if($tipo_pesquisa == 'Descricao'){
			$valor .= "P.PRODES LIKE '%$texto%'";
		}
		if($tipo_pesquisa == 'Grupo'){
			$valor .= "G.PROGRUDEN LIKE '%$texto%'";
		}
		
		$sql = "SELECT 	P.PROCOD AS CODIGO, 
						P.PRODES AS DESCRICAO,
						G.PROGRUCOD AS CODIGO_GRUPO, 
						G.PROGRUDEN AS GRUPO,
						S.PROSUBGRUCOD AS CODIGO_SUBGRUPO, 
						S.PROSUBGRUDEN AS SUBGRUPO
				  FROM 
				  		PRODUTO P
				  LEFT JOIN 
				  		PRODUTO_GRUPO G
					ON 
						P.PROGRUCOD = G.PROGRUCOD
				  LEFT JOIN 
				  		PRODUTO_SUBGRUPO S
					ON 
						S.PROSUBGRUCOD = P.PROSUBGRUCOD
				  WHERE  P.EMPCOD = ".$sessao->getNode('empresa_acessada')." AND ".$valor;
				
		//Prepara a consulta
		$query = oci_parse($conecta,$sql);
		
		if(oci_execute($query)){
			echo '    <table id="produto_pesquisa_aba_dois_table">
						<tr class="k-header">
							<td>Código</td>
							<td>Descrição</td>
							<td>Grupo</td>
							<td>SubGrupo</td>
							<td></td>
						</tr>';

			//Recebe informações
			while($prod = oci_fetch_object($query)){
				?>
				<tr id="<?php echo $prod->CODIGO;	?>" class="tr_table_pesquisa_produto">
					<td><?php echo $prod->CODIGO;	?></td>
                    <td title="<?php echo $prod->DESCRICAO;?>"><?php echo $prod->DESCRICAO;?></td>
					<td><?php echo $prod->GRUPO; 	?></td>
					<td><?php echo $prod->SUBGRUPO; 	?></td>
					<td>
						<a href="#" id="<?php echo $prod->CODIGO;?>" name="pes_pro_bt_vis">Visualizar</a> 
					</td>
				</tr>
				<?php
			}
						
			
		}
		
	}
?>
