<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<?php foreach($tese as $row):?>
<table class="view">
	<tr>
		<th>Autor:</th>
		<td><?php echo $row->autor; ?></td>
	</tr>
	<tr>
		<th>Título:</th>
		<td><?php echo $row->titulo; ?></td>
	</tr>
	<tr>
		<th>Palavras-chave:</th>
		<td><?php echo $row->keywords; ?></td>
	</tr>
	<tr>
		<th>Descrição:</th>
		<td><?php echo $row->descricao; ?></td>
	</tr>
	<tr>
		<th>Edição:</th>
		<td><?php echo $row->edicao; ?></td>
	</tr>
	<tr>
		<th>Local de Publicação:</th>
		<td><?php echo $row->local_publicacao; ?></td>
	</tr>
	<tr>
		<th>Editora:</th>
		<td><?php echo $row->editora; ?></td>
	</tr>
	<tr>
		<th>Ano de publicação:</th>
		<td><?php echo $row->ano; ?></td>
	</tr>
	<tr>
		<th>Extensão:</th>
		<td><?php echo $row->extensao; ?></td>
	</tr>
	<tr>
		<th>Notação:</th>
		<td><?php echo $row->notacao; ?></td>
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
		<th>N⁰ de exemplares:</th>
		<td><?php echo $numExemp; ?></td>
	</tr>
	<tr>
		<td align="right">
			<a href="exibir/item/tese/<?php echo $row->id; ?>/novoExemplar"><input type="button" class="button" value="Adicionar Exemplar" /></a>
			<a href="pagina/admin/teses"><input type="button" class="button" value="Voltar" /></a>
		</td>
		<td><a href="editar/item/tese/<?php echo $row->id; ?>"><input type="button" class="button clean" value="Editar" /></a></td>
	</tr>
</table>
<?php endforeach; ?>