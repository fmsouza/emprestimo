<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>

<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<table class="admin">
	<tr>
		<th>CPF</th>
		<th>Item</th>
		<th>Data de Empréstimo</th>
		<th>Data de Devolução</th>
		<th>Ações</th>
	</tr>
	<?php
		if(!empty($registro)): 
			foreach($registro as $row):
				$de = explode("-",$row->data_emprestimo);
				$de = $de[2]."/".$de[1]."/".$de[0];
				$dd = explode("-",$row->data_devolucao);
				$dd = $dd[2]."/".$dd[1]."/".$dd[0];
		?>
		<tr>
			<td><?php echo $row->cpf;?></td>
			<td><?php echo $row->item;?></td>
			<td><?php echo $de;?></td>
			<td><?php echo $dd;?></td>
			<td>
				<a href="editar/emprestimo/retirar/<?php echo $row->id;?>"><img src="static/images/icons/edit.gif" alt="retirar" title="Retirar" /></a>
				<a href="apagar/emprestimo/cancelar/<?php echo $row->id;?>"><img src="static/images/icons/delete.gif" alt="cancelar" onclick="return confirm('Tem certeza que deseja cancelar esse empréstimo?');" title="Cancelar" /></a>
			</td>
		</tr>
		<?php 
			endforeach;
		else:
	?>
		<tr>
			<td colspan="5">Não há itens a serem retiradas.</td>
		</tr>
	<?php
		endif;
	?>
</table>