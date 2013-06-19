/**
 * inicializa os calendarios das telas
 * 
 * @param objCampo:
 *            campo a ser habilitado ou desabilitado
 * 
 * @author Leonardo Rodrigues
 */
function inicializarComponentes() {
	try {
		pageLoader();
		inicializaCalendarios();
	} catch (e) {
	}
}

/**
 * Funcao que devolve os valores pesquisados para o form
 *
 * @author Raul Neto
 * @author Leonardo Rodrigues
 * @param element Elemento do html que deve ter o valor substituido
 * @param value Valor a ser substituido no elemento do html 
 */
function restauraPesquisa(element, value) {
	try {
		var browserName = navigator.appName;
		var object = document.getElementById(element);
		if (browserName == "Netscape") {
			if (object == '[object HTMLSelectElement]') {
				var opts = document.getElementById(element).options;
				for ( var i = 0; i <= opts.length; i++) {
					if (value == opts[i].value) {
						object.selectedIndex = i;
						break;
					}
				}
			} else if (object == '[object HTMLInputElement]') {
				object.checked = true;
				object.value = value;
			}
		} else {
			if (element.indexOf('imageField') != 0) {
				var opts = document.getElementById(element).options;
				if (opts && opts.length > 1) {
					for ( var i = 0; i <= opts.length; i++) {
						if (null != opts[i].value && value == opts[i].value) {
							object.selectedIndex = i;
							break;
						}
					}
				} else {
					object.value = value;
					object.checked = true;
				}
			}
		}
	} catch (e) {
	}
}

/**
 * inicializa os calendarios das telas
 * 
 * @param objCampo: campo a ser habilitado ou desabilitado
 *  
 * Exemplo: 
 * showCalendar('<nome campo>','<nome bot�o>');
 * showCalendar('datafim','butfim');
 *
 * @author Leonardo Rodrigues
 */
function showCalendar(campo, botao) {

	campo = document.getElementById(campo);
	botao = document.getElementById(botao);

	Calendar.setup( {
		inputField : campo,
		ifFormat : "%d/%m/%Y",
		button : botao
	});
}

/**
 * Funcao de submit da Paginacao
 *
 * @author Leonardo Rodrigues
 */
function paginacao(link) {
	try {
		submitPaginacao(link);
		return false;
	} catch (e) {
	}
	return true;
}

/**
 * Fun��o que executa um submit quando clicado na paginacao
 * 
 * @param intValor
 * @return
 * @author Leonardo Rodrigues
 */
function submitPaginacao(intValor) {
	try {
		executaSubmitPaginacao(intValor);
	} catch (e) {
		return false;
	}
	return false;
}
 var cor = '';
/**
 * Fun��o usada para mudar as cores das linhas
 * 
 * @param obj
 * @return
 */
function moveIn(obj) {
	cor = obj.style.background;
	obj.style.background = '#FFFFFF';
}

/**
 * Fun��o usada para devolver as cores das linhas
 * 
 * @param obj
 * @return
 */
function moveOut(obj) {
	obj.style.background = cor;
}

/**
 *  
 * @param componenteRetorno
 * @param urlSubmit
 * @param aguarde
 * @return
 * @author Leonardo Rodrigues
 */
function dispararAjax(componenteRetorno, form, aguarde, action, pageFunction) {
	if (pageFunction != null) {
		pageFunction();
	}
	form.action = action + "/ajax";
	mostraAguarde(aguarde, componenteRetorno);
	var ajax = getSystemAjax(componenteRetorno);
	ajax.executaRequisicao(form, 'POST', trataRetornoAutomatico);
}

/**
 * 
 * @param inner
 * @return
 * @author Leonardo Rodrigues
 */
function trataRetornoAutomatico(inner, componente) {
	if (componente != null) {
		if (inner.indexOf('Acesso Negado') == -1) {
			getComponenteAjaxRetorno(componente).innerHTML = inner;
			inicializarComponentes();
		} else {
			getComponenteAjaxRetorno(componente).innerHTML = "<div class='livro-autor'>Acesso Negado</div>";
		}
	} else if (inner.indexOf('Acesso Negado') == -1) {
		alert('Transa��o efetuada com sucesso.');
	} else {
		alert('Problemas ao executar a transa��o. Contate o administrador.');
	}
}

/**
 * 
 * @param bolExibicao
 * @return
 * @author Leonardo Rodrigues
 */
function mostraAguarde(bolExibicao, comp) {

	var htmlLoading = "<div class='livro-autor'><img src='/code/imagens/loading.gif' style='vertical-align: middle; border: 0px;'/> Carregando...</div>";

	if (comp != null) {
		if (bolExibicao) {
			getComponenteAjaxRetorno(comp).innerHTML = htmlLoading;
		}
	}
}

/**
 * 
 * @param comp
 * @return
 * @author Leonardo Rodrigues
 */
function getComponenteAjaxRetorno(comp) {
	var comps = null;
	if (comp != null) {
		comps = document.getElementById(comp);
		if (comps == null) {
			comps = parent.document.getElementById(comp);
		}
	}
	return comps;
}
 