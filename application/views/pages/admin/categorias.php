<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>

<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<table class="admin">
	<tr>
		<th>Titulo</th>
		<th>Ações</th>
	</tr>
	<?php foreach($registro as $row):?>
	<tr>
		<td><a href="exibir/categoria/<?php echo $row->id;?>"><?php echo $row->titulo;?></a></td>
		<td>
			<a href="exibir/categoria/<?php echo $row->id;?>"><img src="static/images/icons/view.gif" alt="exibir" title="Exibir" /></a>
			<a href="editar/categoria/<?php echo $row->id;?>"><img src="static/images/icons/edit.gif" alt="editar" title="Editar" /></a>
			<a href="apagar/categoria/<?php echo $row->id;?>"><img src="static/images/icons/delete.gif" alt="apagar" onclick="return confirm('Tem certeza que deseja apagar esse registro?');" title="Apagar" /></a>
		</td>
	</tr>
	<?php endforeach;?>
</table>