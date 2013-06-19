<html>
<head>

<title>Bem vindo ao CodeIgniter 2.0.0!</title>

<!-- BEGIN - Site Include -->

<?php echo $siteInclude;?>

<!-- END - Site Include -->

<script type="text/javascript">

<!-- BEGIN - Site Javascript -->

<?php echo $siteJavascript;?>

<!-- END - Site Javascript -->

/**
 * Fun��o que incializa os calend�rios
 */
function inicializaCalendarios(){
	try{
		showCalendar('datainicio','bt_datainicio');
	}catch(e){
	}
}
</script>

</head>
<body onload="inicializaCalendarios();">

<h1>Bem vindo ao CodeIgniter 2.0.0!</h1>

<p>Essa p�gina est� sendo gerada dinamicamente pelo CodeIgniter.</p>

<p>Se voc� quiser editar essa p�gina ela est� localizada no diret�rio:</p>
<code>/application/views/welcomeView.php</code>

<p>O controller correspondente est� localizado no diret�rio:</p>
<code>/application/controllers/WelcomeController.php</code>

<p>Se voc� quiser usar o bot�o direito do mouse mude o nome do arquivo site_copyright.js para site_copyright.js.old</p>
<code>/lib/js/site_copyright.js</code>

<p>Qualquer d�vida use o manual: <a href="/user_guide" rel="lightbox;">User
Guide</a>.</p>

<p><br />
Exemplo Ligthbox : <br />
<br />
<a href="/code/imagens/space-03.jpg" rel="lightbox;width=512;height=333;"> <img
	src="/code/imagens/magnifier.gif" border="0" /> </a></p>
<p><br />
Exemplo Ligthbox Site : <br />
<br />
<a href="http://www.americanas.com.br" rel="lightbox;" title="Site"> <img
	src="/code/imagens/magnifier.gif" border="0" /> </a></p>
<p><br />
Exemplo Calend�rio : <br />
<br />
Data Inicio: <input type="text" id="datainicio" name="datainicio"
	size="10" onkeypress="return false;" />&nbsp;&nbsp; <input
	style="vertical-align: middle;" id="bt_datainicio" name="bt_datainicio"
	type="image" src="/code/imagens/calendar.gif"></p>
<p><br />
Exemplo Sweet Tiles : <br />
<br />


<ul>
	<li>
	<table border="1">
		<tr
			title="Sem problema de <h3>colocar</h3> <i>texto</i> <strong>HTML</strong>">
			<td>Dentro de Tabela</td>
		</tr>
	</table>
	</li>
	<br />
	<li><span
		title="Sem problema de <h3>colocar</h3> <i>texto</i> <strong>HTML</strong>">
	<span>Dentro de tag SPAN</span> </span></li>
</ul>
</p>
<p><br />
Exemplo Ajax : <br />
<form id="formAjax"><input type="button"
	onclick="dispararAjax('componente',formAjax,true,'/code/index.php/WelcomeController/testeAjax',null);"
	value="Ajax" /></form>
<div id="componente"></div>
</p>

<p><br />
Pagina carregada em {elapsed_time} segundos</p>

</body>
</html>
