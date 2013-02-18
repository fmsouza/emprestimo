<form method="post" action="cadastrar/teses" id="cadastro_teses">

	<h1><?php if(isset($title)) echo $title; ?></h1>
	
	<?php if(isset($msg)): ?>
	<div class="msg"><?php echo $msg; ?></div>
	<br/>
	<?php endif; ?>
	
	<table>
		<tr>
			<td>Título:</td>
			<td><input type="text" name="titulo" /></td>
		</tr>
		<tr>
			<td>Ano:</td>
			<td><input type="text" name="ano" class="ano" /></td>
		</tr>
		<tr>
			<td>Editora:</td>
			<td><input type="text" name="editora" /></td>
		</tr>
		<tr>
			<td>Prazo do empréstimo(dias):</td>
			<td><input type="number" name="prazo" /></td>
		</tr>
		<tr>
			<td>Valor(R$):</td>
			<td><input type="text" name="valor" /></td>
		</tr>
		<tr>
			<td>Autor:</td>
			<td><input type="text" name="autor" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Cadastrar" class="button" /></td>
		</tr>
	</table>
</form>