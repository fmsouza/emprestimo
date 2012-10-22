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
	<?php if(!empty($row->prazo)): ?>
	<tr>
		<th>Prazo máximo de empréstimo(dias):</th>
		<td><?php echo $row->prazo; ?></td>
	</tr>
	<?php endif; ?>

	<tr>
		<th>Data de empréstimo:</th>
		<td><input type="text" name="data_emprestimo" class="date" /></td>
	</tr>
	<tr>
		<th>Data de devolução:</th>
		<td><input type="text" name="data_devolucao" class="date" /></td>
	</tr>

	<tr>
		<td style="padding-top: 20px;" colspan="2" align="center"><a href="emprestimo/solicitar/<?php echo $row->acervo_categoria_id.$row->id; ?>"><input type="button" class="button" value="Solicitar" /></a></td>
	</tr>
</table>