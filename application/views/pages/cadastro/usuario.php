<h1>Cadastro</h1>
<br/>
<span class="validate">* Todos os campos marcados devem ser preenchidos.</span>

<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>

<form class="cadastro" id="cadastro_usuario" action="usuarios/novo" method="post">
	<table>
		<tr>
			<td>CPF:</td>
			<td><input type="text" id="cpf" name="cpf" class="textbox cpf" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<td>DRE:</td>
			<td><input type="text" id="dre" name="dre" class="textbox" /></td>
		</tr>
		<tr>
			<td>SIAPE:</td>
			<td><input type="text" id="siape" name="siape" class="textbox" /></td>
		</tr>
		<tr>
			<td>Nome:</td>
			<td><input type="text" id="nome" name="nome" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<td>Identidade:</td>
			<td><input type="text" id="identidade" name="identidade" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<td>Endereço:</td>
			<td><input type="text" id="endereco" name="endereco" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<td>Profissão:</td>
			<td><input type="text" id="profissao" name="profissao" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<td>E-mail:</td>
			<td><input type="email" id="email" name="email" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<td>E-mail alternativo:</td>
			<td><input type="text" id="email_alternativo" name="email_alternativo" class="textbox" /></td>
		</tr>
		<tr>
			<td>Tel. fixo:</td>
			<td><input type="text" id="tel_fixo" name="tel_fixo" class="textbox phone" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<td>Tel. celular:</td>
			<td><input type="text" id="tel_celular" name="tel_celular" class="textbox phone" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<td>Tel. comercial:</td>
			<td><input type="text" id="tel_comercial" name="tel_comercial" class="textbox phone" /></td>
		</tr>
		<tr>
			<td>Senha:</td>
			<td><input type="password" id="senha" name="senha" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<td>Confirmação de senha:</td>
			<td><input type="password" id="csenha" name="csenha" class="textbox" /><span class="validate">*</span></td>
		</tr>
		<tr>
			<td align="right"><input type="submit" class="button" value="Cadastrar" /></td>
			<td><input type="submit" class="button clean" value="Limpar" /></td>
		</tr>
	</table>
</form>