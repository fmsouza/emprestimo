<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php $mapa = (isset($mapa))? $mapa[0]:"";?>

<form class="editar" id="editar_mapa" action="editar/item/mapa/<?php echo $mapa->id;?>" method="post">
	<input type="hidden" value="<?php echo $mapa->id;?>" name="id" />
	<table>
		<tr>
			<th>Título:</th>
			<td><input type="text" value="<?php echo $mapa->titulo;?>" id="titulo" name="titulo" class="textbox" /></td>
		</tr>
		<tr>
			<th>Ano:</th>
			<td><input type="text" value="<?php echo $mapa->ano;?>" id="ano" name="ano" class="textbox" /></td>
		</tr>
		<tr>
			<th>Prazo de empréstimo(dias):</th>
			<td><input type="number" value="<?php echo $mapa->prazo;?>" id="prazo" name="prazo" class="textbox" /></td>
		</tr>
		<tr>
			<th>Valor(R$):</th>
			<td><input type="text" value="<?php echo $mapa->valor;?>" id="valor" name="valor" class="textbox" /></td>
		</tr>
		<tr>
			<th>Autor:</th>
			<td><input type="text" value="<?php echo $mapa->autor;?>" id="autor" name="autor" class="textbox" /></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" class="button" value="Cadastrar" /></td>
			<td><a href="pagina/admin/mapas"><input type="button" class="button" value="Voltar" /></a></td>
		</tr>
	</table>
</form>