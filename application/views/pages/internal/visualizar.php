<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<table class="view">
	<?php if(!empty($row->titulo)): ?>
	<tr>
		<th>Título:</th>
		<td><?php echo $row->titulo; ?></td>
	</tr>
	<?php endif; ?>
	<?php if(!empty($row->ano)): ?>
	<tr>
		<th>Ano:</th>
		<td><?php echo $row->ano; ?></td>
	</tr>
	<?php endif; ?>
	<?php if(!empty($row->editora)): ?>
	<tr>
		<th>Editora:</th>
		<td><?php echo $row->editora; ?></td>
	</tr>
	<?php endif; ?>
	<?php if(!empty($row->prazo)): ?>
	<tr>
		<th>Prazo máximo de empréstimo(dias):</th>
		<td><?php echo $row->prazo; ?></td>
	</tr>
	<?php endif; ?>
	<?php if(!empty($row->valor)): ?>
	<tr>
		<th>Valor(R$):</th>
		<td><?php echo $row->valor; ?></td>
	</tr>
	<?php endif; ?>
	<?php if(!empty($row->autor)): ?>
	<tr>
		<th>Autor:</th>
		<td><?php echo $row->autor; ?></td>
	</tr>
	<?php endif;?>
	<?php if(!empty($row->marca)): ?>
	<tr>
		<th>Marca:</th>
		<td><?php echo $row->marca; ?></td>
	</tr>
	<?php endif;?>
	<?php if(!empty($row->descricao)): ?>
	<tr>
		<th>Descrição:</th>
		<td><?php echo $row->descricao; ?></td>
	</tr>
	<?php endif;?>
	<tr>
		<td style="padding-top: 20px;" colspan="2" align="center"><a href="emprestimo/solicitar/<?php echo $row->id; ?>"><input type="button" class="button" value="Solicitar" /></a></td>
	</tr>
</table>