<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>

<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<table class="admin">
	<tr>
		<th>CPF</th>
		<th>Item</th>
		<th>Data de Devolução</th>
		<th>Ações</th>
	</tr>
	<?php
		if(!empty($registro)):
			foreach($registro as $row):
				$dd = explode("-",$row->data_devolucao);
				$dd = $dd[2]."/".$dd[1]."/".$dd[0];
		?>
		<tr>
			<td><?php echo $row->cpf;?></td>
			<td><?php echo $row->item;?></td>
			<td><?php echo $dd;?></td>
			<td>
				<a href="editar/emprestimo/devolver/<?php echo $row->id;?>"><img src="static/images/icons/edit.gif" alt="devolver" title="Devolver" /></a>
			</td>
		</tr>
		<?php
			endforeach;
		else:
	?>
		<tr>
			<td colspan="4">Não há itens a serem devolvidos.</td>
		</tr>
	<?php 
		endif;
	?>
</table>