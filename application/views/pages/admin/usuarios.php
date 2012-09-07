<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>

<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<table class="admin">
	<tr>
		<th>CPF</th>
		<th>Nome</th>
		<th>Profissão</th>
		<th>Ações</th>
	</tr>
	<?php foreach($registro as $row):?>
	<tr>
		<td><?php echo $row->cpf;?></td>
		<td><a href="exibir/usuario/<?php echo $row->cpf;?>"><?php echo $row->nome;?></a></td>
		<td><?php echo $row->profissao;?></td>
		<td>
			<a href="exibir/usuario/<?php echo $row->cpf;?>"><img src="static/images/icons/view.gif" alt="exibir" title="Exibir" /></a>
			<a href="editar/usuario/<?php echo $row->cpf;?>"><img src="static/images/icons/edit.gif" alt="editar" title="Editar" /></a>
			<a href="apagar/usuario/<?php echo $row->cpf;?>"><img src="static/images/icons/delete.gif" alt="apagar" onclick="return confirm('Tem certeza que deseja apagar esse registro?');" title="Apagar" /></a>
		</td>
	</tr>
	<?php endforeach;?>
</table>