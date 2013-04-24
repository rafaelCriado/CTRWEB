<?php
	session_start();
	session_destroy();
	//Sessao
	include('php/classes/session.class.php');
	$sessao = new Session();
	
	//Banco de dados
	require_once 'php/classes/bd_oracle.class.php';
	
	//Se estiver logado retorna á ultima pagina
	if($sessao->checkNode('login_citrino') and $sessao->checkNode('empresa_acessada')){ 
		header('Location:index.php');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" type="text/css" href="img/logo_citrino_icone.ico" />
    <title>ADM Citrino Web</title>
    
    <link rel="stylesheet" type="text/css" href="css/login_css.css" />
    
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/pages/login.js"></script>
</head>

<body>
	<div id="login">
    	<div id="logo">
    		<img src="img/logo_admcitrino.png" height="150px">
      	</div>
        
        <div id="resultado">
     	</div>
        
        
        <!-- Tela do Login -->
        <div id="result">
            <form name="login">
                <label for="usuario">Usuário: </label>
                <input type="text" name="usuario" />
                <br>
                
                &nbsp;
                <label for="senha">Senha: </label>
                <input type="password" name="senha" />
                <br>
                
                <span><input type="submit" value="Logar" class="bt_logar" name="bt_logar" /></span>
                
                
            </form> 
        </div>
        <!-- Fim Tela Login -->
        
        
    </div>
</body>
</html>