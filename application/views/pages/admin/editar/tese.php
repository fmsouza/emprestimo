<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<?php $tese = (isset($tese))? $tese[0]:"";?>

<form class="editar" id="editar_tese" action="editar/item/tese/<?php echo $tese->id;?>" method="post">
	<input type="hidden" value="<?php echo $tese->id;?>" name="id" />
	<table>
		<tr>
			<th>Autor:</th>
			<td><input type="text" value="<?php echo $tese->autor;?>" id="autor" name="autor" class="textbox" /></td>
		</tr>
		<tr>
			<th>Título:</th>
			<td><input type="text" value="<?php echo $tese->titulo;?>" id="titulo" name="titulo" class="textbox" /></td>
		</tr>
		<tr>
			<th>Palavras-chave:</th>
			<td><textarea cols="30" rows="5" name="keywords"><?php echo $tese->keywords;?></textarea></td>
		</tr>
		<tr>
			<th>Descriçao:</th>
			<td><textarea cols="30" rows="5" name="descricao"><?php echo $tese->descricao;?></textarea></td>
		</tr>
		<tr>
			<th>Edição:</th>
			<td><input type="number" value="<?php echo $tese->edicao;?>" id="edicao" name="edicao" class="textbox" /></td>
		</tr>
		<tr>
			<th>Local de publicação:</th>
			<td><input type="text" value="<?php echo $tese->local_publicacao;?>" id="local_publicacao" name="local_publicacao" class="textbox" /></td>
		</tr>
		<tr>
			<th>Editora:</th>
			<td><input type="text" value="<?php echo $tese->editora;?>" id="editora" name="editora" class="textbox" /></td>
		</tr>
		<tr>
			<th>Ano de publicação:</th>
			<td><input type="text" value="<?php echo $tese->ano;?>" id="ano" name="ano" class="textbox" /></td>
		</tr>
		<tr>
			<th>Extensão:</th>
			<td><input type="text" value="<?php echo $tese->extensao;?>" id="extensao" name="extensao" class="textbox" /></td>
		</tr>
		<tr>
			<th>Notação:</th>
			<td><input type="text" value="<?php echo $tese->notacao;?>" id="notacao" name="notacao" class="textbox" /></td>
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
			<td align="right"><input type="submit" class="button" value="Cadastrar" /></td>
			<td><a href="pagina/admin/teses"><input type="button" class="button" value="Voltar" /></a></td>
		</tr>
	</table>
</form>