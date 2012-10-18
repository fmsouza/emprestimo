<form class="editar" id="editar_nivel" action="cadastrar/permissao" method="post">

	<h1><?php if(isset($title)) echo $title; ?></h1>
	
	<?php if(isset($msg)): ?>
	<div class="msg"><?php echo $msg; ?></div>
	<br/>
	<?php endif; ?>
	<span class="validate">* Todos os campos marcados devem ser preenchidos.</span>

	<table>
		<tr>
			<th>Nome:</th>
			<td><input type="text" value="" id="nome" name="nome" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<th>Ver usuário:</th>
			<td><input type="checkbox" name="ver_usuario" /></td>
		</tr>
		<tr>
			<th>Editar usuário:</th>
			<td><input type="checkbox" name="editar_usuario" /></td>
		</tr>
		<tr>
			<th>Apagar usuário:</th>
			<td><input type="checkbox" name="apagar_usuario" /></td>
		</tr>
		<tr>
			<th>Editar acervo:</th>
			<td><input type="checkbox" name="editar_acervo" /></td>
		</tr>
		<tr>
			<th>Apagar acervo:</th>
			<td><input type="checkbox" name="apagar_acervo" /></td>
		</tr>
		<tr>
			<th>Deferir empréstimo:</th>
			<td><input type="checkbox" name="deferir_emprestimo" /></td>
		</tr>
		<tr>
			<th>Cancelar empréstimo:</th>
			<td><input type="checkbox" name="cancelar_emprestimo" /></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" class="button" value="Cadastrar" /></td>
		</tr>
	</table>
</form>