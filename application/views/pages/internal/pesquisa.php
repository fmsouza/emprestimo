<?php
	$class = 'search';
	if(isset($pesquisa)){ $valor = $pesquisa; $class = 'searched'; }
	elseif(isset($title)) $valor = 'Busque '.$title.' aqui...';
	else $valor = 'Busque aqui...';
?>

<form name="pesquisar" id="pesquisar" action="pesquisar" method="post">
	<?php if(isset($setor)):?>
	<input type="hidden" name="setor" value="<?php echo $setor; ?>" />
	<?php endif; ?>
	<input type="text" value="<?php echo $valor;?>" class="<?php echo $class; ?>" name="pesquisa" />
</form>

<?php if(isset($num_rows)&& $num_rows>0): ?>
<table class="results">
	<tr>
		<th>Título</th>
		<th>Ano</th>
		<th>Editora</th>
		<th>Autor</th>
		<th>Marca</th>
	</tr>
<?php foreach($rows as $row): ?>
	<tr>
			<td><a href="<?php echo $row_link.$row->id;?>"><?php echo $row->titulo; ?></a></td>
			<td><a href="<?php echo $row_link.$row->id;?>"><?php echo $row->ano; ?></a></td>
			<td><a href="<?php echo $row_link.$row->id;?>"><?php echo $row->editora; ?></a></td>
			<td><a href="<?php echo $row_link.$row->id;?>"><?php echo $row->autor; ?></a></td>
			<td><a href="<?php echo $row_link.$row->id;?>"><?php echo $row->marca; ?></a></td>
	</tr>
<?php endforeach; ?>
</table>
<?php elseif(isset($num_rows) && $num_rows==0): ?>
<h3>Nenhum registro foi encontrado para a pesquisa solicitada.</h3>
<?php endif; ?>