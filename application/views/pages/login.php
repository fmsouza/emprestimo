<h1>Login</h1>
<br/>
<?php if(isset($msg)): ?>
<div class="msg"><?php echo $msg; ?></div>
<?php endif; ?>
<br/>
<form name="login" id="login" method="post" action="login/auth">
	<table>
		<tr>
			<td>CPF:</td>
			<td><input type="text" name="cpf" class="cpf" /></td>
		</tr>
		<tr>
			<td>Senha:</td>
			<td><input type="password" name="senha" /></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" class="button" value="Enviar" /></td>
		</tr>
		<tr>
			<td colspan="2">Não possui cadastro? <a href="login/novo">Cadastre-se</a></td>
		</tr>
	</table>
</form>