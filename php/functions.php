<?php 
	//Funções uteis
	function limpaCPF($cpf){
		
		$cpf = str_replace('.','',$cpf);
		$cpf = str_replace('-','',$cpf);
		$cpf = str_replace('/','',$cpf);
		
		return $cpf;
	}
	
	
	function limpaCNPJ($cnpj){
		
		$cnpj = str_replace('.','',$cnpj);
		$cnpj = str_replace('-','',$cnpj);
		$cnpj = str_replace('/','',$cnpj);
		
		return $cnpj;
	}
	
	
	function checkNumber($number){
		if(isset($number)){
			return $numero = number_format($number,2,'.','');
		}else{
			return NULL;
		}
	}
	
	function checkInteiro($number){
		if(isset($number) and !empty($number) and $number != ''){
			return $number;
		}else{
			return 'NULL';
		}
	}
	
	
	function corrigeNome($nome_recebido){
		if(is_string($nome_recebido)){
			$nome_recebido = strtoupper($nome_recebido);
			return $nome_recebido;
		}else{
			return $nome_recebido;
		}
	}

	function dataNascimento($nascimento){
		if(isset($nascimento) and $nascimento != ' '){
			$nascimento = explode("/",$nascimento);
			switch($nascimento[1]){
				case '01':
					$nascimento[1] = 'JAN';
					break;
				case '02':
					$nascimento[1] = 'FEB';
					break;
				case '03':
					$nascimento[1] = 'MAR';
					break;
				case '04':
					$nascimento[1] = 'APR';
					break;
				case '05':
					$nascimento[1] = 'MAI';
					break;
				case '06':
					$nascimento[1] = 'JUN';
					break;
				case '07':
					$nascimento[1] = 'JUL';
					break;
				case '08':
					$nascimento[1] = 'AUG';
					break;
				case '09':
					$nascimento[1] = 'SEP';
					break;
				case '10':
					$nascimento[1] = 'OCT';
					break;
				case '11':
					$nascimento[1] = 'NOV';
					break;
				case '12':
					$nascimento[1] = 'DEC';
					break;
			}
			$nascimento = implode('-',$nascimento);
		}else{
			$nascimento = NULL;
		}
		return $nascimento;
	}


	//Recebe informações de acesso
	function acessaTela($tela_acesso, $usuario, $tipo, $conecta){
		//TIPO = ACESSAR, INCLUIR, ALTERAR, EXCLUIR
		$permite = '';
		$msg = '';
		
		//Chamada a procedure
		$sql = "BEGIN SP_PERMISSAO ( :tela_acesso,  :usuario,  :tipo,  :PO_PERMITE, :PO_MENSAGEM); END;";
		
		//INTERPRETA
		$sql = oci_parse($conecta, $sql);
		
		//PASSA VARIÁVEIS PHP PARA O ORACLE 
		oci_bind_by_name($sql, ":tela_acesso", $tela_acesso);
		oci_bind_by_name($sql, ":usuario", $usuario);
		oci_bind_by_name($sql, ":tipo", $tipo);
		oci_bind_by_name($sql, ":PO_PERMITE", $permite, 32);
		oci_bind_by_name($sql, ":PO_MENSAGEM", $msg, 100);
		
		//EXECUTA
		oci_execute($sql,OCI_DEFAULT);
		
		//RESULTADO
		return $permite.'|'.$msg;
		
	}
	
	//Verifica se tem acesso ou não
	function validaAcesso($verifica){
		//função de validar acesso
		$texto = $verifica;;
		
		if(isset($texto) and !empty($texto)){
			$msg = explode('|',$texto);
			if($msg[0] == 'SIM'){
				return true;
			}else if ($msg[0] == 'NAO'){
				return false;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	
	//Rertorna o texto do acesso
	function textoAcesso($verifica){
		//função de validar acesso
		$texto = $verifica;;
		
		if(isset($texto) and !empty($texto)){
			$msg = explode($texto);
			return $msg[1];
		}else{
			return 'Erro ao acessar';
		}	
	}
	
	function textoFORMAT($string, $tamanho){
						if(isset($string) and !empty($string)){
							
							if(strlen($string) <= $tamanho){
								return $string;
							}else{
								$retorno = substr($string, 0,$tamanho-3);
								$retorno .= '...';
								return $retorno;
							}
							
						}else{
							return 'ERRO';
						}
					}


	//Busca valor do orçamento =================
	function getValArray($array,$opt){
	
		foreach($array as $campo => $valor){
			if($campo == $opt){
				return $valor;
			}
		}
	}
	// =========================================
	
	function contArray($array){
		$contador = 0;
		foreach($array as $campo => $valor){
				$contador++;
			
		}
		return $contador;
	}
	
	function formata_numero($valor){
		if(!empty($valor)){
			return 'R$ '. number_format($valor,2,'.',',');
		}
		return 'R$ 0,00';
	}
	
	

?>