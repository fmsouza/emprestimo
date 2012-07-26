<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Geocart - Empréstimos - <?php echo $title; ?></title>
		<link rel="stylesheet" href="<?php echo base_url(); ?>static/css/main.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>static/css/menu.css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>static/css/form.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>static/js/jquery.maskedinput-1.3.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>static/js/jqueryFunctions.js"></script>
        <base href="<?php echo base_url(); ?>" />
	</head>
	<body>
		<center>
			<div id="header"></div>
			<div id="menu">
				<ul class="menu">
					<li><a href="buscar/mapas">Mapas e Cartas</a></li>
					<li><a href="buscar/teses">Teses e Artigos</a></li>
					<li><a href="buscar/equipamentos">Equipamentos</a></li>
				</ul>
				<?php if(isset($this->session->userdata['logged'])): ?>
				<span id="sessioname"><span id="name"><?php echo $this->session->userdata['userdata'][0]->nome; ?></span> - <a href="logoff">Sair</a></span>
				<?php else: ?>
				<span id="sessioname"><span id="name">Seja bem-vindo!</span></span>
				<?php endif; ?>
			</div>
			<div id="content">