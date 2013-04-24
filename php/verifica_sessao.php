<?php

		//Inclui classe de sessão
		include('classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		if($sessao->checkNode('empresa_acessada') == false){
			$situacao = 0;	
		}else{
			$situacao = 1;
		}
		
		echo (	json_encode($situacao)	);
	
?>