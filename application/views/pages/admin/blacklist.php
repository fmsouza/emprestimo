<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>

<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<table class="admin">
	<tr>
		<th>CPF</th>
		<th>Nome</th>
	</tr>
	<?php foreach($registro as $row):?>
	<tr>
		<td><?php echo $row->cpf;?></td>
		<td><?php echo $row->nome;?></td>
	</tr>
	<?php endforeach;?>
</table>