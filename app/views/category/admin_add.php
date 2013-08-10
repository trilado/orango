<h1>Categorias <small><?= $label ?></small> </h1>
<div class="row-fluid">
	<form class="form-horizontal" method="POST" action="">
		<div class="row-fluid">
			<div class="control-group span12">
				<label class="control-label" for="Name">Nome</label>
				<div class="controls">
					<input class="span9" id="Name" type="text" name="Name" value="<?= $model->Name ?>" />
				</div>
			</div>
		</div>
		<div class="row-fluid form-actions">
			<input class="btn btn-inverse" type="submit" value="<?= $label ?>" />
			<a href="~/admin/category" class="help-inline">Voltar</a>
		</div>
	</form>
</div>