<h3>Nova Financeira</h3>
            <form name="nova_financeira">
                            
                &nbsp;&nbsp;&nbsp;&nbsp;Nome:

                <input type="text" name="nova_financeira_nome" placeholder="HBC" maxlength="60" >
                <br><br />

                Taxa de Abertura: 			
                <input type="text" name="nova_financeira_taxa" value="0"  onKeyPress="return(MascaraMoeda(this,'.',',',event))">
                <br><br />

                
                <input type="button" value="LIMPAR" name="nova_financeira_bt_limpar"  class="k-button">
                <input type="button" value="INCLUIR" name="nova_financeira_bt_cadastrar" class="k-button">
            </form>
            <br>
            <br>
            
            <span class="resultado_nova_financeira"></span>