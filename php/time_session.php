<?php
	
	include('classes/session.class.php');
	$sessao = new Session();
	
	
	error_reporting(0);
	require 'classes/bd_oracle.class.php';
	
	
	$tempo = explode(':',$sessao->getLeftTime());
	
	
	if($tempo[0] < 0){
		$sessao->destroy();
		?><script type="text/javascript">document.location.href="index.php"</script><?php	
	}
	
	
	echo $tempo[0].'min'.$tempo[1].'seg';
	
?>