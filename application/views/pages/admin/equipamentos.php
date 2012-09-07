<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>

<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<table class="admin">
	<tr>
		<th>ID</th>
		<th>Título</th>
		<th>Ano</th>
		<th>Ações</th>
	</tr>
	<?php foreach($registro as $row):?>
	<tr>
		<td><?php echo $row->id;?></td>
		<td><a href="exibir/equipamento/<?php echo $row->id;?>"><?php echo $row->titulo;?></a></td>
		<td><?php echo $row->ano;?></td>
		<td>
			<a href="exibir/equipamento/<?php echo $row->id;?>"><img src="static/images/icons/view.gif" alt="exibir" title="Exibir" /></a>
			<a href="editar/equipamento/<?php echo $row->id;?>"><img src="static/images/icons/edit.gif" alt="editar" title="Editar" /></a>
			<a href="apagar/equipamento/<?php echo $row->id;?>"><img src="static/images/icons/delete.gif" alt="apagar" onclick="return confirm('Tem certeza que deseja apagar esse registro?');" title="Apagar" /></a>
		</td>
	</tr>
	<?php endforeach;?>
</table>