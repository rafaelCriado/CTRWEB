<?PHP 
	/* TELA DE CADASTRO DE FINANCEIRAS ******************************************************************************
	
			    autor: RAFAEL MARQUES CRIADO
			     data: 04/03/2013 
		 modificações:
		 
	   **********************************************************************************************************/


	//Caso não exista sessão faça (Necessário devido efeito de alteração
	if(!isset($sessao)){
		//Inclui classe de sessão
		include('php/classes/session.class.php');
		
		//Inicia sessão
		$sessao = new Session();
		
		//Inclui funções
		include('php/functions.php');
		
		//Inclui banco de dados
		include('php/classes/bd_oracle.class.php');
	}

		?>
		
        <div id="input_nova_financeira" class="k-header">
            <?php include('php/cadastro/financeiro/financeiras/form_input.php');?>
        </div>
        
        <div id="tabela_estado">
            <div id="retorno_nova_financeira">
                <?php require 'php/cadastro/financeiro/financeiras/lista_de_financeiras.php'; ?>
            </div>
        </div>

