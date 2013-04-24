<?php
	include('../../../classes/bd_oracle.class.php');
	include("../../../classes/session.class.php");
	$sessao = new Session();
	//Mostra produtos
	if($_POST){
		$vendedor = isset($_POST['vendedor'])?$_POST['vendedor']:0;
		$previsao = isset($_POST['previsao'])?$_POST['previsao']:'';
		
		if($vendedor != 0 and !empty($previsao)){
			
			
			//Sql de pesquisa
			$sql = "SELECT O.ORCCOD AS CODIGO,
						   O.ORCDATCAD AS DATA_ATENDIMENTO,
						   ('(' || O.ENTCOD || ') ' || E.ENTNOM) AS CLIENTE,
						   (C.CIDNOM || ' - ' || UF.UFABREV) AS CIDADE,
						   PR.PESRESDES AS PESQUISA,
						   O.ORCPREVEN AS PREVISAO_VENDA,
						   O.ORCVALTOT AS VALOR_BRUTO
					
					  FROM ORCAMENTO O, ENTIDADE E, CIDADE C, UF, PESQUISAS_RESPOSTAS PR
					 WHERE O.ENTCOD = E.ENTCOD
					   AND E.CIDCOD = C.CIDCOD
					   AND C.CIDUFCOD = UF.UFCOD
					   AND PR.ENTCOD(+) = O.ENTCOD
					   AND PR.PESPERCOD = 1
					   AND O.ORCPREVEN = '".$previsao."'
					   AND O.ORCVEN = ".$vendedor;
			$query = oci_parse($conecta,$sql);
			
			if(oci_execute($query)){
				?>
                <table width="100%">
                	<tr>
                    	<td>Data Atend.</td>
                    	<td>Nome do Cliente</td>
                    	<td>Cidade</td>
                    	<td>Como conheceu a Riolax?</td>
                    	<td>Orç.</td>
                    	<td>Valor Bruto.</td>
                    </tr>
                
                <?php
				
				while($relatorio = oci_fetch_object($query)){
					?>
					<tr>
                    	<td><?php echo $relatorio->DATA_ATENDIMENTO; ?></td>
                    	<td><?php echo $relatorio->CLIENTE; ?></td>
                    	<td><?php echo $relatorio->CIDADE; ?></td>
                    	<td><?php echo $relatorio->PESQUISA; ?></td>
                    	<td><?php echo $relatorio->CODIGO; ?></td>
                    	<td>R$ <?php echo number_format($relatorio->VALOR_BRUTO,2,',','.'); ?></td>
                    </tr>					
					<?php
				}
				
				echo '</table>';
			}
			
			
		}
		
	}
?>