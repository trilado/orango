<h1>Adicionar Post</h1>
<form method="post" action="">
	<div class="control-group">
		<label class="control-label" for="Email">Título</label>
		<div class="controls">
			<input name="Email" id="Email" value="<?= Request::post('Email') ?>" type="text" class="input-block-level">
		</div>
	</div>				
	<div class="control-group">
		<label class="control-label" for="Password">Senha</label>
		<div class="controls">
			<textarea name="Password" id="Password" type="password" class="input-block-level"></textarea>
		</div>
	</div>
	<button type="submit" class="btn btn-inverse">Publicar</button>
	<button type="submit" class="btn" name="Drafit" value="1">Salvar Rascunho</button>
	<a href="~/admin/page" class="btn">Cancelar</a>
</form>