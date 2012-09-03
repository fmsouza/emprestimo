<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php $equipamento = (isset($equipamento))? $equipamento[0]:"";?>

<form class="editar" id="editar_equipamento" action="editar/equipamento/<?php echo $equipamento->id;?>" method="post">
	<input type="hidden" value="<?php echo $equipamento->id;?>" name="id" />
	<table>
		<tr>
			<th>Título:</th>
			<td><input type="text" value="<?php echo $equipamento->titulo;?>" id="titulo" name="titulo" class="textbox" /></td>
		</tr>
		<tr>
			<th>Ano:</th>
			<td><input type="text" value="<?php echo $equipamento->ano;?>" id="ano" name="ano" class="textbox" /></td>
		</tr>
		<tr>
			<th>Prazo de empréstimo(dias):</th>
			<td><input type="number" value="<?php echo $equipamento->prazo;?>" id="prazo" name="prazo" class="textbox" /></td>
		</tr>
		<tr>
			<th>Valor(R$):</th>
			<td><input type="text" value="<?php echo $equipamento->valor;?>" id="valor" name="valor" class="textbox" /></td>
		</tr>
		<tr>
			<th>Patrimônio:</th>
			<td><input type="text" value="<?php echo $equipamento->patrimonio;?>" id="patrimonio" name="patrimonio" class="textbox" /></td>
		</tr>
		<tr>
			<th>Marca:</th>
			<td><input type="text" value="<?php echo $equipamento->marca;?>" id="marca" name="marca" class="textbox" /></td>
		</tr>
		<tr>
			<th>Registro:</th>
			<td><input type="text" value="<?php echo $equipamento->registro;?>" id="registro" name="Registro" class="textbox" /></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" class="button" value="Cadastrar" /></td>
			<td><a href="pagina/admin/equipamentos"><input type="button" class="button" value="Voltar" /></a></td>
		</tr>
	</table>
</form>