<h1><?php if(isset($title)) echo $title; ?></h1>
<br/>
<span class="validate">* Todos os campos marcados devem ser preenchidos.</span>

<?php $usuario = (isset($usuario))? $usuario[0]:"";?>

<form class="editar" id="editar_usuario" action="usuario/editar" method="post">
	<input type="hidden" value="<?php echo $usuario->cpf;?>"name="cpf" />
	<table>
		<tr>
			<th>DRE:</th>
			<td><input type="text" value="<?php echo $usuario->dre;?>" id="dre" name="dre" class="textbox" /></td>
		</tr>
		<tr>
			<th>SIAPE:</th>
			<td><input type="text" value="<?php echo $usuario->siape;?>" id="siape" name="siape" class="textbox" /></td>
		</tr>
		<tr>
			<th>Nome:</th>
			<td><input type="text" value="<?php echo $usuario->nome;?>" id="nome" name="nome" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<th>Identidade:</th>
			<td><input type="text" value="<?php echo $usuario->identidade;?>" id="identidade" name="identidade" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<th>Endereço:</th>
			<td><input type="text" value="<?php echo $usuario->endereco;?>" id="endereco" name="endereco" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<th>Profissão:</th>
			<td><input type="text" value="<?php echo $usuario->profissao;?>" id="profissao" name="profissao" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<th>E-mail:</th>
			<td><input type="email" value="<?php echo $usuario->email;?>" id="email" name="email" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<th>E-mail alternativo:</td>
			<td><input type="email" value="<?php echo $usuario->email_alternativo;?>" id="email_alternativo" name="email_alternativo" class="textbox" /></td>
		</tr>
		<tr>
			<th>Tel. fixo:</th>
			<td><input type="text" value="<?php echo $usuario->tel_fixo;?>" id="tel_fixo" name="tel_fixo" class="textbox phone" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<th>Tel. celular:</th>
			<td><input type="text" value="<?php echo $usuario->tel_celular;?>" id="tel_celular" name="tel_celular" class="textbox phone" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<th>Tel. comercial:</th>
			<td><input type="text" value="<?php echo $usuario->tel_comercial;?>" id="tel_comercial" name="tel_comercial" class="textbox phone" /></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" class="button" value="Cadastrar" /></td>
			<td><a href="pagina/admin/usuarios"><input type="button" class="button" value="Voltar" /></a></td>
		</tr>
	</table>
</form>