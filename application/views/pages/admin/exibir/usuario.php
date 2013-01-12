<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<?php foreach($usuario as $row):?>
<table class="view">
	<tr>
		<th>Nome:</th>
		<td><?php echo $row->nome; ?></td>
	</tr>
	<tr>
		<th>Tipo de usuário:</th>
		<td><?php echo $row->tipo; ?></td>
	</tr>
	<tr>
		<th>CPF:</th>
		<td><?php echo $row->cpf; ?></td>
	</tr>
	<tr>
		<th>DRE:</th>
		<td><?php echo $row->dre; ?></td>
	</tr>
	<tr>
		<th>SIAPE:</th>
		<td><?php echo $row->siape; ?></td>
	</tr>
	<tr>
		<th>Identidade:</th>
		<td><?php echo $row->identidade; ?></td>
	</tr>
	<tr>
		<th>Endereço:</th>
		<td><?php echo $row->endereco; ?></td>
	</tr>
	<tr>
		<th>Profissão:</th>
		<td><?php echo $row->profissao; ?></td>
	</tr>
	<tr>
		<th>E-mail:</th>
		<td><?php echo $row->email; ?></td>
	</tr>
	<tr>
		<th>E-mail alternativo:</th>
		<td><?php echo $row->email_alternativo; ?></td>
	</tr>
	<tr>
		<th>Tel. fixo:</th>
		<td><?php echo $row->tel_fixo; ?></td>
	</tr>
	<tr>
		<th>Tel. celular:</th>
		<td><?php echo $row->tel_celular; ?></td>
	</tr>
	<tr>
		<th>Tel. comercial:</th>
		<td><?php echo $row->tel_comercial; ?></td>
	</tr>
		<tr>
			<td align="right"><a href="pagina/admin/usuarios"><input type="button" class="button" value="Voltar" /></a></td>
			<td><a href="editar/usuario/<?php echo $row->cpf; ?>"><input type="button" class="button clean" value="Editar" /></a></td>
		</tr>
</table>
<?php endforeach; ?>