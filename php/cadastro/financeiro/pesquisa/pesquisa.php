<?php
	$condicao = isset($_POST['parametro'])?$_POST['parametro']:'';


	if(!empty($condicao)){
		
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
		
		
		//inclui banco de dados
		include('php/classes/bd_oracle.class.php');
		
		switch($condicao){
			case 1:
				$sql = "SELECT (FP.FINPARTOTPAR||'|'||FP.FINPARCAR||'|'||F.FINCOD)        AS CODIGO,
							   F.FINNOM        AS NOME,
							   F.FINTAXABE     AS TAXA,
							   FP.FINPARCAR    AS CARENCIA,
							   FP.FINPARTOTPAR AS PARCELA
						  FROM FINANCEIRAS F, FINANCEIRAS_PARCELAS FP
						 WHERE F.FINCOD = FP.FINCOD
						 GROUP BY F.FINCOD, F.FINNOM, F.FINTAXABE, FP.FINPARCAR, FP.FINPARTOTPAR
						";
						
				
				$campo[0] = 'CODIGO';
				$campo[1] = 'NOME';
				$campo[2] = 'TAXA';
				$campo[3] = 'CARENCIA';		
				$campo[4] = 'PARCELA';		
				break;
		}
		
		$query = oci_parse($conecta,$sql);
		
		if(oci_execute($query)){
			
			
			echo '<table cellpadding="0" cellspacing="0" width="100%" class="pesquisa_financeira">';
			
			
			echo '<tr>';
			for($x = 0; $x < count($campo); $x++ ){
				
				echo '<td><strong>'.$campo[$x].'</strong></td>';
				
				
			}
			echo '</tr>';
			
			while($row = oci_fetch_object($query)){
				echo '<tr id="'.$row->$campo[0].'">';
				
					for($x = 0; $x < count($campo); $x++ ){
						echo '<td>'.str_replace('|','',$row->$campo[$x]).'</td>';
					}
				
				echo '</tr>';
			}
			
			echo '</table>';
			
		}
		
	
	}else{
	
		echo 'Aguarde...';
	
	}
?>