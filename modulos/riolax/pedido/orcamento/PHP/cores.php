        <?php 
			header( 'Cache-Control: no-cache' );
			header( 'Content-type: application/xml; charset="utf-8"', true );
			
			include('../../../../../php/classes/bd_oracle.class.php');
			
			$grupo = $_GET['grupo'];
			$subgrupo = $_GET['subgrupo'];
			$medidas = explode('x',$_GET['medidas']);
			$linhas = $_GET['linhas'];
			$acabamentos = $_GET['acabamentos'];
			
			$condicoes = "AND PROCAR1 = '" . $linhas . "' AND PROMAT = '" . $acabamentos . "'";
			if(isset($medidas[0]) and !empty($medidas[0])){
					$condicoes 	.= "AND PROCOM = " . trim($medidas[0]). " ";
			}
			if(isset($medidas[1]) and !empty($medidas[1])){
					$condicoes 	.= "AND PROLAR = " . trim($medidas[1]). " ";
			}
			if(isset($medidas[2]) and !empty($medidas[2])){
					$condicoes 	.= "AND PROALT = " . trim($medidas[2]). " ";
			}
			
			
			
			$cores = array();
			
			$sql = "SELECT UPPER(PROCOR) AS COR
					  FROM PRODUTO
					 WHERE PROGRUCOD = " . $grupo . "
					   AND PROSUBGRUCOD = " . $subgrupo . "
					   " . $condicoes . "
					 GROUP BY UPPER(PROCOR)
					";
			$res = oci_parse($conecta,$sql);
			oci_execute($res);
			while ( $row = oci_fetch_assoc( $res ) ) {
				$cores[] = array(
					'COR'	=> $row['COR'],
					
				);
			}
			
			echo( json_encode( $cores ) );
        ?>
