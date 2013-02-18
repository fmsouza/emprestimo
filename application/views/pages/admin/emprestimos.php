<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>

<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<table class="admin">
	<tr>
		<th>Item</th>
		<th>Data de empréstimo</th>
		<th>Data de devolução</th>
		<th>Retirado</th>
		<th>Devolvido</th>
	</tr>
	<?php
		if(!empty($registro)):
			foreach($registro as $row):
			$style="";
			if(date("Y-m-d")>$row->data_devolucao) $style="style='background-color:#f46e6e';";
			if($row->devolvido) $style="style='background-color:#98D190';";
			$de = explode("-",$row->data_emprestimo);
			$row->data_emprestimo = "{$de[2]}/{$de[1]}/{$de[0]}";
			$dd = explode("-",$row->data_devolucao);
			$row->data_devolucao = "{$dd[2]}/{$dd[1]}/{$dd[0]}";
		?>
		<tr <?php echo $style;?>>
			<td><?php echo $row->item;?></td>
			<td><?php echo $row->data_emprestimo;?></td>
			<td><?php echo $row->data_devolucao;?></td>
			<td><?php echo ($row->retirado)?"Sim":"Não";?></td>
			<td><?php echo ($row->devolvido)?"Sim":"Não";?></td>
		</tr>
		<?php
			endforeach;
		else:
	?>
		<tr>
			<td colspan="2">Não há usuários na lista negra.</td>
		</tr>
	<?php 
		endif;
	?>
</table>