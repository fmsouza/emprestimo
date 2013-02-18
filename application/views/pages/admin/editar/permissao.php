<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<span class="validate">* Todos os campos marcados devem ser preenchidos.</span>

<?php $nivel = (isset($nivel))? $nivel[0]:"";?>

<form class="editar" id="editar_nivel" action="editar/permissao/<?php echo $nivel->id;?>" method="post">
	<input type="hidden" value="<?php echo $nivel->id;?>"name="id" />
	<table>
		<tr>
			<th>Nome:</th>
			<td><input type="text" value="<?php echo $nivel->nome;?>" id="nome" name="nome" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<th>Ver usuário:</th>
			<td><input type="checkbox" name="ver_usuario" <?php if($nivel->ver_usuario) echo 'checked="checked"'; ?> /></td>
		</tr>
		<tr>
			<th>Editar usuário:</th>
			<td><input type="checkbox" name="editar_usuario" <?php if($nivel->editar_usuario) echo 'checked="checked"'; ?> /></td>
		</tr>
		<tr>
			<th>Apagar usuário:</th>
			<td><input type="checkbox" name="apagar_usuario" <?php if($nivel->apagar_usuario) echo 'checked="checked"'; ?> /></td>
		</tr>
		<tr>
			<th>Ver categoria:</th>
			<td><input type="checkbox" name="ver_categoria" <?php if($nivel->ver_categoria) echo 'checked="checked"'; ?> /></td>
		</tr>
		<tr>
			<th>Editar categoria:</th>
			<td><input type="checkbox" name="editar_categoria" <?php if($nivel->editar_categoria) echo 'checked="checked"'; ?> /></td>
		</tr>
		<tr>
			<th>Editar acervo:</th>
			<td><input type="checkbox" name="editar_acervo" <?php if($nivel->editar_acervo) echo 'checked="checked"'; ?> /></td>
		</tr>
		<tr>
			<th>Apagar acervo:</th>
			<td><input type="checkbox" name="apagar_acervo" <?php if($nivel->apagar_acervo) echo 'checked="checked"'; ?> /></td>
		</tr>
		<tr>
			<th>Deferir empréstimo:</th>
			<td><input type="checkbox" name="deferir_emprestimo" <?php if($nivel->deferir_emprestimo) echo 'checked="checked"'; ?> /></td>
		</tr>
		<tr>
			<th>Cancelar empréstimo:</th>
			<td><input type="checkbox" name="cancelar_emprestimo" <?php if($nivel->cancelar_emprestimo) echo 'checked="checked"'; ?> /></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" class="button" value="Cadastrar" /></td>
			<td><a href="pagina/admin/permissoes"><input type="button" class="button" value="Voltar" /></a></td>
		</tr>
	</table>
</form>