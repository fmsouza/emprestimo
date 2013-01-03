<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<form method="post" action="emprestimo/requerer">
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
			<td>
				<?php echo $row->prazo; ?>
				<input type="hidden" name="prazo" value="<?php echo $row->prazo; ?>" />
			</td>
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
			<th>Finalidade:</th>
			<td>
				<select name="emprestimo_finalidade_id">
					<?php foreach($finalidades as $finalidade) echo "<option value='{$finalidade->id}'>{$finalidade->titulo}</option>\n\t\t\t\t\t"; ?>
				</select>
			</td>
		</tr>
	
		<tr>
			<td><input type="hidden" name="acervo_exemplar_codigo" value="<?php echo $row->acervo_categoria_id.$row->id; ?>" /></td>
			<td style="padding-top: 20px;" colspan="2" align="center"><input type="submit" class="button" value="Solicitar" /></td>
		</tr>
	</table>
</form>