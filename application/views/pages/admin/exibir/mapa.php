<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<?php foreach($mapa as $row):?>
<table class="view">
	<tr>
		<th>Título:</th>
		<td><?php echo $row->titulo; ?></td>
	</tr>
	<tr>
		<th>Ano:</th>
		<td><?php echo $row->ano; ?></td>
	</tr>
	<tr>
		<th>Prazo de empréstimo(dias):</th>
		<td><?php echo $row->prazo; ?></td>
	</tr>
	<tr>
		<th>Valor(R$):</th>
		<td><?php echo $row->valor; ?></td>
	</tr>
	<tr>
		<th>Autor:</th>
		<td><?php echo $row->autor; ?></td>
	</tr>
	<tr>
		<th>N⁰ de exemplares:</th>
		<td><?php echo $numExemp; ?></td>
	</tr>
	<tr>
		<td align="right">
			<a href="exibir/item/mapa/<?php echo $row->id; ?>/novoExemplar"><input type="button" class="button" value="Adicionar Exemplar" /></a>
			<a href="pagina/admin/mapas"><input type="button" class="button" value="Voltar" /></a>
		</td>
		<td><a href="editar/item/mapa/<?php echo $row->id; ?>"><input type="button" class="button clean" value="Editar" /></a></td>
	</tr>
</table>
<?php endforeach; ?>