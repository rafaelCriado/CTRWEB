        <?php 
			header( 'Cache-Control: no-cache' );
			header( 'Content-type: application/xml; charset="utf-8"', true );
			
			include('../classes/bd_oracle.class.php');
			include '../functions.php';
			
			$entidade_grupo = $_GET['entidade_grupo'];
			
			$subgrupos = array();
			
			$sql = "select prosubgrucod as codigo, prosubgruden as nome from produto_subgrupo where progrucod = $entidade_grupo";
			$res = oci_parse($conecta,$sql);
			oci_execute($res);
			while ( $row = oci_fetch_assoc( $res ) ) {
				$subgrupos[] = array(
					'codigo_subgrupo'	=> $row['CODIGO'],
					'subgrupo'			=> textoFORMAT($row['NOME'],18),
					
				);
			}
			
			echo( json_encode( $subgrupos ) );
        ?>
