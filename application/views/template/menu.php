			<div id="menu">
				<ul class="menu">
					<li><a href="home">Busca Geral</a></li>
					<li><a href="mapas">Mapas e Cartas</a></li>
					<li><a href="teses">Teses, Livros e Artigos</a></li>
					<li><a href="equipamentos">Equipamentos</a></li>
				</ul>
				<span id="sessioname">
					<span id="name">
					<?php if(isset($this->session->userdata['logged'])): ?>
					<img src="static/images/icons/downarrow.gif" /><?php echo $this->session->userdata['userdata'][0]->nome; ?>
					</span> - <a href="logoff">Sair</a>
					<div id="admin-menu">
						<table>
							<tr>
								<td><a href="home">Início</a></td>
							</tr>
							<tr>
								<td class="divider">Cadastros</td>
							</tr>
							<?php if($this->nivel_usuario->getNivel('editar_categoria')):?>
							<tr>
								<td><a href="pagina/cadastro/categorias">Categorias</a></td>
							</tr>
							<tr>
								<td><a href="pagina/cadastro/mapas">Mapas e Cartas</a></td>
							</tr>
							<tr>
								<td><a href="pagina/cadastro/teses">Teses, Livros e Artigos</a></td>
							</tr>
							<tr>
								<td><a href="pagina/cadastro/equipamentos">Equipamentos</a></td>
							</tr>
							<?php endif;?>
							<?php if($this->nivel_usuario->getNivel('editar_usuario')):?>
							<tr>
								<td><a href="pagina/cadastro/permissoes">Tipos de Usuário</a></td>
							</tr>
							<?php endif;?>
							<tr>
								<td class="divider">Administração</td>
							</tr>
							<tr>
								<td><a href="pagina/admin/emprestimos">Pedidos</a></td>
							</tr>
							<?php if($this->nivel_usuario->getNivel('editar_usuario')):?>
							<tr>
								<td><a href="pagina/admin/permissoes">Tipos de Usuário</a></td>
							</tr>
							<?php endif;?>
							<?php if($this->nivel_usuario->getNivel('ver_usuario')):?>
							<tr>
								<td><a href="pagina/admin/usuarios">Usuários</a></td>
							</tr>
							<tr>
								<td><a href="pagina/admin/blacklist">Lista Negra</a></td>
							</tr>
							<?php endif;?>
							<?php if($this->nivel_usuario->getNivel('ver_categoria')):?>
							<tr>
								<td><a href="pagina/admin/categorias">Categorias</a></td>
							</tr>
							<tr>
								<td><a href="pagina/admin/mapas">Mapas e Cartas</a></td>
							</tr>
							<tr>
								<td><a href="pagina/admin/teses">Teses, Livros e Artigos</a></td>
							</tr>
							<tr>
								<td><a href="pagina/admin/equipamentos">Equipamentos</a></td>
							</tr>
							<?php endif;?>
							<?php if($this->nivel_usuario->getNivel('deferir_emprestimo')):?>
							<tr>
								<td><a href="pagina/admin/retirar">Retirada</a></td>
							</tr>
							<tr>
								<td><a href="pagina/admin/devolucao">Devolução</a></td>
							</tr>
							<?php endif;?>
						</table>
					</div>
					<?php else: ?>Seja bem-vindo! - <a href="login">Login</a>
					<?php endif; ?>
					</span>
				</span>
			</div>
			<div id="content">