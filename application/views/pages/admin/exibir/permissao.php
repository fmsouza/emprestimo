<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<?php foreach($nivel as $row):?>
<table class="view">
	<tr>
		<th>Nome:</th>
		<td><?php echo $row->nome; ?></td>
	</tr>
	<tr>
		<th>Ver usuário:</th>
		<td><input type="checkbox" <?php if($row->ver_usuario) echo 'checked="checked"'; ?> disabled="disabled" /></td>
	</tr>
	<tr>
		<th>Editar usuário:</th>
		<td><input type="checkbox" <?php if($row->editar_usuario) echo 'checked="checked"'; ?> disabled="disabled" /></td>
	</tr>
	<tr>
		<th>Apagar usuário:</th>
		<td><input type="checkbox" <?php if($row->apagar_usuario) echo 'checked="checked"'; ?> disabled="disabled" /></td>
	</tr>
	<tr>
		<th>Editar acervo:</th>
		<td><input type="checkbox" <?php if($row->editar_acervo) echo 'checked="checked"'; ?> disabled="disabled" /></td>
	</tr>
	<tr>
		<th>Apagar acervo:</th>
		<td><input type="checkbox" <?php if($row->apagar_acervo) echo 'checked="checked"'; ?> disabled="disabled" /></td>
	</tr>
	<tr>
		<th>Deferir empréstimo:</th>
		<td><input type="checkbox" <?php if($row->deferir_emprestimo) echo 'checked="checked"'; ?> disabled="disabled" /></td>
	</tr>
	<tr>
		<th>Cancelar empréstimo:</th>
		<td><input type="checkbox" <?php if($row->cancelar_emprestimo) echo 'checked="checked"'; ?> disabled="disabled" /></td>
	</tr>
	<tr>
		<td align="right"><a href="pagina/admin/permissoes"><input type="button" class="button" value="Voltar" /></a></td>
		<td><a href="editar/permissao/<?php echo $row->id; ?>"><input type="button" class="button clean" value="Editar" /></a></td>
	</tr>
</table>
<?php endforeach; ?>