<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>

<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<a href="pagina/admin/blacklist/notificar" align="center"><input type="button" class="button" value="Notificar todos" /></a><br/><br/>

<table class="admin">
	<tr>
		<th>CPF</th>
		<th>Nome</th>
	</tr>
	<?php
		if(!empty($registro)):
			foreach($registro as $row):?>
		<tr>
			<td><?php echo $row->cpf;?></td>
			<td><?php echo $row->nome;?></td>
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