<form method="post" action="cadastrar/categoria">

	<h1><?php if(isset($title)) echo $title; ?></h1>
	
	<?php if(isset($msg)): ?>
	<div class="msg"><?php echo $msg; ?></div>
	<br/>
	<?php endif; ?>
	
	<table>
		<tr>
			<td>Título:</td>
			<td><input type="text" name="titulo" id="titulo" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Cadastrar" class="button" /></td>
		</tr>
	</table>

</form>