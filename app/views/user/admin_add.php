<div class="row-fluid">
	<h1>Usuários <small><?= $label ?></small> </h1>
	<div class="container-fluid">
		<form id="user-form" class="form-vertical" method="POST" action="">
			<div class="row-fluid">
				<div class="control-group span6">
					<label for="Name" class="control-label">Nome</label>
					<div class="controls">
						<input id="Name" class="span12" name="Name" type="text" value="<?= $model->Name ?>" />
					</div>
				</div>
				<div class="control-group span6">
					<label for="Email" class="control-label">E-mail</label>
					<div class="controls">
						<input id="Email" class="span12" name="Email" type="text" value="<?= $model->Email ?>" />
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="control-group span4">
					<label for="Password" class="control-label">Senha</label>
					<div class="controls">
						<input id="Password" class="span12" name="Password" type="password" value="" />
					</div>
				</div>
				<div class="control-group span2">
					<label for="Role" class="control-label">Função</label>
					<div class="controls">
						<select id="Role" name="Role">
							<option value="<?= $model->Role->Id ?>"><?= $model->Role->Name ?></option>
							<?php foreach (User::$_roles as $k => $v): ?>
							<option value="<?= $k ?>"><?= $v ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
			<?= ModuleComposer::getAdds(ModuleComposer::USER_ADDS); ?>
			<div class="row-fluid">
				<input type="submit" value="<?= $label ?>" class="btn btn-inverse" />
				<a href="~/admin/user" class="help-inline">Voltar</a>
			</div>
		</form>
	</div>
</div>