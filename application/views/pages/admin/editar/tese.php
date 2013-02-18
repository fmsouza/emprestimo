<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php $tese = (isset($tese))? $tese[0]:"";?>

<form class="editar" id="editar_tese" action="editar/item/tese/<?php echo $tese->id;?>" method="post">
	<input type="hidden" value="<?php echo $tese->id;?>" name="id" />
	<table>
		<tr>
			<th>Título:</th>
			<td><input type="text" value="<?php echo $tese->titulo;?>" id="titulo" name="titulo" class="textbox" /></td>
		</tr>
		<tr>
			<th>Ano:</th>
			<td><input type="text" value="<?php echo $tese->ano;?>" id="ano" name="ano" class="textbox" /></td>
		</tr>
		<tr>
			<th>Editora:</th>
			<td><input type="text" value="<?php echo $tese->editora;?>" id="editora" name="editora" class="textbox" /></td>
		</tr>
		<tr>
			<th>Prazo de empréstimo(dias):</th>
			<td><input type="number" value="<?php echo $tese->prazo;?>" id="prazo" name="prazo" class="textbox" /></td>
		</tr>
		<tr>
			<th>Valor(R$):</th>
			<td><input type="text" value="<?php echo $tese->valor;?>" id="valor" name="valor" class="textbox" /></td>
		</tr>
		<tr>
			<th>Autor:</th>
			<td><input type="text" value="<?php echo $tese->autor;?>" id="autor" name="autor" class="textbox" /></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" class="button" value="Cadastrar" /></td>
			<td><a href="pagina/admin/teses"><input type="button" class="button" value="Voltar" /></a></td>
		</tr>
	</table>
</form>