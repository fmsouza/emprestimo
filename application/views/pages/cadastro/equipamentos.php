<form method="post" action="cadastrar/equipamentos">

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
			<td><input type="text" name="ano" /></td>
		</tr>
		<tr>
			<td>Prazo do empréstimo(dias):</td>
			<td><input type="text" name="prazo" /></td>
		</tr>
		<tr>
			<td>Valor(R$):</td>
			<td><input type="text" name="valor" /></td>
		</tr>
		<tr>
			<td>N⁰ do Patrimônio:</td>
			<td><input type="text" name="patrimonio" /></td>
		</tr>
		<tr>
			<td>Marca:</td>
			<td><input type="text" name="marca" /></td>
		</tr>
		<tr>
			<td>N⁰. registro IBGE:</td>
			<td><input type="text" name="registro_ibge" /></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="Cadastrar" class="button" /></td>
		</tr>
	</table>
</form>