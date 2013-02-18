<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php $categoria = (isset($categoria))? $categoria[0]:"";?>

<form class="editar" id="editar_categoria" action="editar/categoria/<?php echo $categoria->id;?>" method="post">
	<input type="hidden" value="<?php echo $categoria->id;?>" name="id" />
	<table>
		<tr>
			<th>Título:</th>
			<td><input type="text" value="<?php echo $categoria->titulo;?>" id="titulo" name="titulo" class="textbox" /></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" class="button" value="Cadastrar" /></td>
			<td><a href="pagina/admin/categorias"><input type="button" class="button" value="Voltar" /></a></td>
		</tr>
	</table>
</form>