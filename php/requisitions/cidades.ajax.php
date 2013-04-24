        <?php 
			header( 'Cache-Control: no-cache' );
			header( 'Content-type: application/xml; charset="utf-8"', true );
			
			include('../classes/bd_oracle.class.php');
			include '../functions.php';
			
			$entidade_estado = $_GET['entidade_estado'];
			
			$cidades = array();
			
			$sql = "SELECT CIDCOD AS CODIGO_CIDADE ,CIDNOM AS CIDADE FROM CIDADE WHERE CIDUFCOD = $entidade_estado";
			$res = oci_parse($conecta,$sql);
			oci_execute($res);
			while ( $row = oci_fetch_assoc( $res ) ) {
				$cidades[] = array(
					'entidade_cidade'	=> $row['CODIGO_CIDADE'],
					'nome'				=> textoFORMAT($row['CIDADE'],18),
					'titulo'			=> $row['CIDADE'],
					
				);
			}
			
			echo( json_encode( $cidades ) );
        ?>
