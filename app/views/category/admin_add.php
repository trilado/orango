<h1>Categorias <small><?= $label ?></small> </h1>
<div class="row-fluid">
	<form id="form-category" class="form-vertical" method="POST" action="" enctype='multipart/form-data'>
		<div class="row-fluid">
			<div class="control-group span6">
				<label class="control-label" for="Name">Nome</label>
				<div class="controls">
					<input class="span12" id="Name" type="text" name="Name" value="<?= $model->Name ?>" />
				</div>
			</div>
		</div>
		<div class="row-fluid">
			<input class="btn btn-inverse" type="submit" value="<?= $label ?>" />
			<a href="~/admin/category" class="help-inline">Voltar</a>
		</div>
		<?= ModuleComposer::getAdds(ModuleComposer::CATEGORY_ADDS); ?>
	</form>
</div>