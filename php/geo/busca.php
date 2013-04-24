<?php

	
	include('../classes/bd_oracle.class.php');
	include('../classes/session.class.php');

	$sessao = new Session();


/**
 * gMaps Class
 *
 * Pega as informações de latitude, longitude e zoom de um endereço usando a API do Google Maps
 *
 * @author Thiago Belem <contato@thiagobelem.net>
 */
class gMaps {
	// Host do GoogleMaps
	private $mapsHost = 'maps.google.com';
	// Sua Google Maps API Key
	public $mapsKey = 'AIzaSyC_1UPKnFUUj1ijsxwmHy4t3saVn6X6KZc';

	function __construct($key = null) {
		if (!is_null($key)) {
			$this->mapsKey = $key;
		}
	}

	function carregaUrl($url) {
		if (function_exists('curl_init')) {
			$cURL = curl_init($url);
			curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($cURL, CURLOPT_FOLLOWLOCATION, true);
			$resultado = curl_exec($cURL);
			curl_close($cURL);
		} else {
			$resultado = file_get_contents($url);
		}

		if (!$resultado) {
			return false;
			//trigger_error('Não foi possível carregar o endereço: <strong>' . $url . '</strong>');
		} else {
			return $resultado;
		}
	}

	function geoLocal($endereco) {
		$url = 'http://'. $this->mapsHost .'/maps/geo?output=csv&key='. $this->mapsKey .'&q='. urlencode($endereco);
		$dados = $this->carregaUrl($url);
		list($status, $zoom, $latitude, $longitude) = explode(',', $dados);
		if ($status != 200) {
			return false;
			//trigger_error('Não foi possível carregar o endereço <strong>"'.$endereco.'"</strong>, código de resposta: ' . $status);
		}
		return array('lat' => $latitude, 'lon' => $longitude, 'zoom' => $zoom, 'endereco' => $endereco);
	}
}
?>
<?php
// Instancia a classe
$gmaps = new gMaps('SUA GMAK AQUI');


//Consulta endereço de clientes 
$sql = "SELECT E.ENTCOD AS CODIGO,
			   E.ENTNOM AS NOME,
			   (E.ENTEND || ', ' || E.ENTNUM || ', ' ||  E.ENTBAI||','|| C.CIDNOM || ', ' ||
			   U.UFABREV) AS ENDERECO
		  FROM ENTIDADE E, CIDADE C, UF U
		 WHERE E.CIDCOD = C.CIDCOD
		   AND C.CIDUFCOD = U.UFCOD";
		   
$query = oci_parse($conecta,$sql);

oci_execute($query);



/*Abre um arquivo chamdo loja.xml, como estou tentando abrir com o w+, se o arquivo não existir haverá a tentativa de criar ele*/
$abre_xml = fopen("clientes.xml","w+");

$conteudo = '';
$conteudo .= '<markers>';
while($cliente = oci_fetch_object($query)){
	$dados = $gmaps->geolocal($cliente->ENDERECO);
	$conteudo .= "<marker name=\"".utf8_decode($cliente->NOME)."\" lat=\"".$dados['lat']."\" lng=\"".$dados['lon']."\" />";
}
$conteudo .= '</markers>';

fwrite($abre_xml,"<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n");
fwrite($abre_xml, $conteudo);

/*Fecha o arquivo aberto (não é necessário, mas é bom*/
fclose($abre_xml);

?>