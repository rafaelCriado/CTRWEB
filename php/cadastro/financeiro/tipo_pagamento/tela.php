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
		include('../financeiras - Cópia/php/functions.php');
		
		//Inclui banco de dados
		include('../financeiras - Cópia/php/classes/bd_oracle.class.php');
	}

		?>
		
        <div id="input_novo_tipo_pagamento" class="k-header">
            <?php include('php/cadastro/financeiro/tipo_pagamento/form_input.php');?>
        </div>
        
        <div id="tabela_estado">
            <div id="retorno_novo_tipo_pagamento">
                <?php require 'php/cadastro/financeiro/tipo_pagamento/lista_de_tipo_pagamento.php'; ?>
            </div>
        </div>

