<?php
	include '../../../../../php/functions.php';
	include '../../../../../php/classes/session.class.php';
	$sessao = new Session();
	

	if($_POST){
	
		$tipo 		= isset($_POST['tipo'])?$_POST['tipo']:0;
		$valor 		= isset($_POST['valor'])?$_POST['valor']:0;
		$valor      = str_replace(',','',$valor);
		//$valor      = str_replace(',','.',$valor);
		
		$formaPgto 	= isset($_POST['formaPgto'])?$_POST['formaPgto']:0;
		$forma		= '';
		
		if($tipo == 1){
			
			if(!$sessao->checkNode('FORMA_PAGAMENTO')){
				// Criar sessao da forma de pagamento caso não existir
				$forma_pagamento[0]['CODIGO'] = $formaPgto;
				$forma_pagamento[0]['FORMA']  = $forma;
				$forma_pagamento[0]['VALOR']  = $valor;
				$sessao->addNode('FORMA_PAGAMENTO', $forma_pagamento);
				// ====================================================
			}else{
				
				
				
				$forma_pagamento = $sessao->getNode('FORMA_PAGAMENTO');
				$contador = contArray($forma_pagamento);
				
				$array = $forma_pagamento;
				
				$VALIDAR = 0;
				foreach($forma_pagamento as $key => $formaPg){
					
					$codigo = getValArray($formaPg,'CODIGO');	
					
					if($codigo ==  $formaPgto){
						//Forma de pagamento já existe, soma os valores.
						$val = getValArray($formaPg,'VALOR') + $valor;
						$sessao->setArrayNode('FORMA_PAGAMENTO',$key, 'CODIGO', $codigo);
						$sessao->setArrayNode('FORMA_PAGAMENTO',$key, 'FORMA', $forma);
						$sessao->setArrayNode('FORMA_PAGAMENTO',$key, 'VALOR', $val);
						
						$VALIDAR = 1;
					}
					
				}
				
				if($VALIDAR == 0){
					$array[$contador]['CODIGO'] = $formaPgto;
					$array[$contador]['FORMA']  = $forma;
					$array[$contador]['VALOR']  = $valor;
					$sessao->addNode('FORMA_PAGAMENTO', $array);			
				}
				
				
			}
			echo 'Gravado com sucesso!';
			
		}
	}