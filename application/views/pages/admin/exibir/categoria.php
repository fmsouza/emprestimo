<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<?php foreach($categoria as $row):?>
<table class="view">
	<tr>
		<th>Título:</th>
		<td><?php echo $row->titulo; ?></td>
	</tr>
		<tr>
			<td align="right"><a href="pagina/admin/categorias"><input type="button" class="button" value="Voltar" /></a></td>
			<td><a href="editar/categoria/<?php echo $row->id; ?>"><input type="button" class="button clean" value="Editar" /></a></td>
		</tr>
</table>
<?php endforeach; ?>