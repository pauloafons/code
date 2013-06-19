/***********************************************
* Objeto AJAX 
***********************************************/

// Classe para requisi��es HTTP e XML
function Ajax(){
	
	var xmlhttp = null;
	var ajaxComp, completo = false;
	
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP"); 
	}catch (e) { 
		try { 
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"); 
		}catch (e) { 
			try { 
				xmlhttp = new XMLHttpRequest(); 
			}catch (e) { 
				xmlhttp = false; 
			}
		}
	}
	if (xmlhttp == null) {
		return null;
	}
	/** M�todo que chama uma p�gina via ajax
	* page: pagina a ser enviado;
	* funcao: fun��o javascript que ser� chamada quando o resultado da requisi��o estiver preenchido.
	*/
	this.chamaPagina = function(page, funcao ){
		if (!xmlhttp){ 
			return false;
		}
		completo = false;
		var param = "";
		try {
			xmlhttp.open("POST", page, true);
			xmlhttp.setRequestHeader("Method", "POST "+page+" HTTP/1.1");
			xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=iso-8859-1");
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && !completo){
					if(funcao != null){
						texto = xmlhttp.responseText;
						funcao(texto,ajaxComp);
					}
					completo = true;
				}
			};
			xmlhttp.send( encodeURI( param ) );
		}catch(z) { 
			return false; 
		}
		return true;
	};
	
	/**
	 * 
	 */
	this.isLiberado = function(){
		return completo;
	};
	/**
	 * 
	 */
	this.setComponente = function(componente){
		ajaxComp = componente;
	};
	
	/** M�todo que executa a conex�o
	* form: form a ser enviado;
	* metodo: M�todo de envio (GET ou POST);
	* funcao: fun��o javascript que ser� chamada quando o resultado da requisi��o estiver preenchido.
	*/
	this.executaRequisicao = function(form, metodo, funcao ){
		if (!xmlhttp){ 
			return false;
		}
		completo = false;
		
		metodo = metodo.toUpperCase();
		
		var param = "";
		
		for( var i = 0; i < form.length; i++ ){
			if( form.elements[i].name != undefined && form.elements[i].value != undefined ) {
				if( form.elements[i].name.match("X_") != null ) {
					req.setRequestHeader( form.elements[i].name , form.elements[i].value );
				} else if(form.elements[i].type == 'checkbox' && form.elements[i].checked == true){
					param = param + "&" + form.elements[i].name + "=" + form.elements[i].value;
				} else if(form.elements[i].type != 'checkbox'){
					param = param + "&" + form.elements[i].name + "=" + form.elements[i].value;
				}
			}
		}
		
		try {
			if (metodo != "POST"){
				xmlhttp.abort();
				return false;
			} else {
				xmlhttp.open("POST", form.action, true);
				xmlhttp.setRequestHeader("Method", "POST "+form.action+" HTTP/1.1");
				xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded;charset=iso-8859-1");
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && !completo){
					if(funcao != null){
						texto = xmlhttp.responseText;
						funcao(texto,ajaxComp);
					}
					completo = true;
				}
			};
			xmlhttp.send( encodeURI( param ) );
		}catch(z) { 
			return false; 
		}
		return true;
	};
	return this;
}
function getSystemAjax(componente) {
	if(xhtmlReq == ''){
		xhtmlReq = new Ajax();
		xhtmlReq.setComponente(componente);
	}else if(!xhtmlReq.isLiberado()){
		var xhtml = new Ajax();
		xhtml.setComponente(componente);
		return xhtml;
	}else{
		xhtmlReq.setComponente(componente);
	}
	return xhtmlReq;
}
var xhtmlReq = '';