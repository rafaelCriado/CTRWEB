<!DOCTYPE html>
<html>
<head>
    <title></title>
<style scoped>
	#po_draggable-container_produtos{
		float:left;
		width:69%;
		height:100%;
	}

	#droptarget
	{	overflow:auto;
		float:right;
		border: 0px solid #959595;
		height: 100% !important;
		width: 30% !important;
		font-size: 36px;
		text-align: center;
		line-height: 198px;
		color: #a1a1a1;
		text-shadow: 0 1px 1px #fff;
		margin: 0;
		cursor: default;

		background: #dddddd;
		background: -moz-linear-gradient(top, #dddddd 0%, #c1c1c1 100%);
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#dddddd), color-stop(100%,#c1c1c1));
		background: -webkit-linear-gradient(top, #dddddd 0%,#c1c1c1 100%);
		background: -o-linear-gradient(top, #dddddd 0%,#c1c1c1 100%);
		background: -ms-linear-gradient(top, #dddddd 0%,#c1c1c1 100%);
		background: linear-gradient(top, #dddddd 0%,#c1c1c1 100%);
	}

	#po_produto_superior{ float:left; width:100%; height:14%; border:0px solid red;}
	#po_draggable-container {
		margin: 0px auto;
		width: 100%;
		height: 85%;
		background: ;
		padding: 0;
		border: 1px solid #ddd;
		float:left;
	}

	#draggable-item {
		width: auto;
		height: auto;
		padding: 5px;
		border: 1px solid black;
		margin: 5px;
		background: #666;
		color: white;
		float:left;
	}
	
	#delivery_menu{ line-height:100%; font-family: Calibri; font-size:16px; padding: 0; color:#3355aa; font-weight:bold; text-shadow:#AAA 1px 1px 0px;}

#delivery_menu ul{list-style:none; padding:0px; margin:0px;}

#delivery_menu ul li{ display:inline; margin:6px;}
a.delivery_buttonBlue {   display: -moz-inline-stack;   display: inline-block;   width: 41px;   height: 41px;   background: url(modulos/riolax/pedido/orcamento/IMG/button_blue.png) no-repeat;   line-height: 41px;   vertical-align: text-middle;   text-align: center;   color: #ffffff;   font-family: Calibri;   font-size: 26px;   font-weight: bold;   font-style: normal;   text-shadow: #222222 1px 1px 0;   text-decoration:none;}

a.delivery_buttonBlue > span {
   display: -moz-inline-block;
}

a.delivery_buttonBlue:hover {   display: -moz-inline-stack;   display: inline-block;   width: 41px;   height: 41px;   background: url(modulos/riolax/pedido/orcamento/IMG/button_white.png) no-repeat;   line-height: 40px;   vertical-align: text-middle;   text-align: center;   color: #081f96;   font-family: Calibri;   font-size: 26px;   font-weight: bold;   font-style: normal;   text-shadow: #000000 1px 1px 0;   text-decoration:none;}
a.delivery_buttonBlue:hover > span {
   display: -moz-inline-block;
}

a.delivery_buttonBlue_SELECT {   display: -moz-inline-stack;   display: inline-block;   width: 41px;   height: 41px;   background: url(modulos/riolax/pedido/orcamento/IMG/button_white.png) no-repeat;   line-height: 40px;   vertical-align: text-middle;   text-align: center;   color: #081f96;   font-family: Calibri;   font-size: 26px;   font-weight: bold;   font-style: normal;   text-shadow: #000000 1px 1px 0;   text-decoration:none;}
a.delivery_buttonBlue_SELECT > span {
   display: -moz-inline-block;
}


a.delivery_submit_cep > span {    display: -moz-inline-block; }

a.delivery_submit_cep:hover > span {   display: -moz-inline-block;}


</style>
<script>
	
	function drag_produtos(div_produto){

		function draggableOnDragStart(e) {
			div_produto.addClass("hollow");
		}

		function droptargetOnDragEnter(e) {
			
		}

		function droptargetOnDragLeave() {
			
		}

		function droptargetOnDrop(e) {
			$("#droptarget").append(div_produto.html());
			div_produto.removeClass("hollow");
		}
	
		function draggableOnDragEnd(e) {
			var draggable = div_produto;
			
			if (!draggable.data("kendoDraggable").dropped) {
				
			}
	
			draggable.removeClass("hollow");
		}

		var qtd_produtos = $('#po_draggable-container_produtos div').size();

		div_produto.kendoDraggable({
			//container: $("#po_draggable-container"),
				 hint: function() {
							return div_produto.clone();
							
					   },
			dragstart: draggableOnDragStart,
			  dragend: draggableOnDragEnd
		});

		$("#droptarget").kendoDropTarget({
			dragenter: droptargetOnDragEnter,
			dragleave: droptargetOnDragLeave,
				 drop: droptargetOnDrop
		});

	
		var draggable = div_produto.data("kendoDraggable");
	}
	
	drag_produtos($('div.item'));
	drag_produtos($('div.item3'));
	drag_produtos($('div.item2'));
	
	//REMOVE ITEM DO CARRINHO =========================================
	$('#droptarget a').live("click",function(e){e.preventDefault()});
	
	$('#droptarget #draggable-item').live("dblclick",function(){
		$(this).remove();
	});
	// ================================================================

	//REMOVE ITEM DO CARRINHO =========================================
	$('#po_draggable-container #draggable-item').live("dblclick",function(){
		$(this).html();
	});
	// ================================================================

</script>

</head>
<body>
	<div id="po_produto_superior">
            <div id="delivery_menu">
                    <ul>
                        <li><a href="#1" class="delivery_buttonBlue_SELECT">1</a>&nbsp;ADICIONE SEUS PRODUTOS</li>
                        <li><a href="#2" class="delivery_buttonBlue">2</a>&nbsp;ESCOLHAS SEUS KITS</li>
                        <li><a href="#4" class="delivery_buttonBlue">4</a>&nbsp;FINALIZAR</li>
                    </ul>
                </div>
        </div>
    <div id="po_draggable-container">
    	<div id="po_draggable-container_produtos">
            <div id="draggable-item" class="item3">
            	<a href="img/produtos/bardot-dupla.jpg" rel="lightbox" title="Beautiful, isn't it" >
                	<img src="img/produtos/bardot-dupla.jpg" width="200" >
                </a> 
            </div>
            <div id="draggable-item" class="item">
            	<a href="img/produtos/demmy.jpg" rel="lightbox" title="Beautiful, isn't it" >
                	<img src="img/produtos/demmy.jpg" width="200" >
                </a> 
            </div>
            <div id="draggable-item" class="item2">
            	<a href="img/produtos/cindy.jpg" rel="lightbox" title="Beautiful, isn't it" >
                	<img src="img/produtos/cindy.jpg" width="200" >
                </a> 
            </div>
        </div>
        
        <div id="droptarget" ></div>
			
	</div>

</body>
</html>