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
					<li><a href="mapas">Mapas e Cartas</a></li>
					<li><a href="teses">Teses, Livros e Artigos</a></li>
					<li><a href="equipamentos">Equipamentos</a></li>
				</ul>
				<span id="sessioname">
					<span id="name">
					<?php if(isset($this->session->userdata['logged'])): ?>
					<img src="static/images/downarrow.gif" /><?php echo $this->session->userdata['userdata'][0]->nome; ?>
					</span> - <a href="logoff">Sair</a>
					<div id="admin-menu">
						<table>
							<tr>
								<td><b>Cadastros</b></td>
							</tr>
							<tr>
								<td><a href="pagina/cadastro/categorias">Categorias</a></td>
							</tr>
							<tr>
								<td><a href="pagina/cadastro/mapas">Mapas e Cartas</a></td>
							</tr>
							<tr>
								<td><a href="pagina/cadastro/teses">Teses e Artigos</a></td>
							</tr>
							<tr>
								<td><a href="pagina/cadastro/equipamentos">Equipamentos</a></td>
							</tr>
						</table>
					</div>
					<?php else: ?>Seja bem-vindo!
					<?php endif; ?>
					</span>
				</span>
			</div>
			<div id="content">