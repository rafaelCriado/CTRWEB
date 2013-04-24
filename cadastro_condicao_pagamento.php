<?PHP 
	//CONTROLE DE ACESSO
	$acessar = acessaTela(125, $sessao->getNode('usuario_citrino'),'ACESSAR',$conecta);
	if(validaAcesso($acessar)){						
?>
<?PHP
	}else{
		
		echo "<span style='font-family:'MS Serif', 'New York', serif; text-align:'center''><h4>Acesso negado para usuário</h4><br><img src='img/cadeado.jpg' style='text-align:center;' ><span>";	
		
	}
?>