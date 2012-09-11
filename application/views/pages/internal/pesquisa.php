<form name="pesquisar" id="pesquisar" action="pesquisar" method="post">
	<?php if(isset($setor)):?>
	<input type="hidden" name="setor" value="<?php echo $setor?>" />
	<?php endif; ?>
	<input type="text" value="Busque <?php if(isset($title)) echo $title.' ';?>aqui..." class="search" name="pesquisa" />
</form>

<?php if(isset($rows)) var_dump($rows);?>