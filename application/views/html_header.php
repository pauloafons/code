<?php echo doctype('xhtml1-trans'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Meu web site de receitas</title>
    <?php
    $meta = array(
	        array('name' => 'robots', 'content' => 'no-cache'),
	        array('name' => 'description', 'content' => 'Meu website de receitas'),
	        array('name' => 'keywords', 'content' => 'Receitas, doces, salgados, sobremesas, massas'),
	        array('name' => 'robots', 'content' => 'no-cache'),
	        array('name' => 'Content-type', 'content' => 'text/html;charset=utf-8', 'type' => 'equiv')
	);
	echo meta($meta);
	echo link_tag('imgs/fork.ico', 'shortcut icon', 'image/ico');
	echo link_tag('css/layout.css');
	?>
    </head>
<body>