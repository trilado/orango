<div class="row-fluid">
	<form action="~/admin/user/remove" method="POST">
		<div class="alert alert-warning" id="user-remove-confirm" style="display: none;">
			<span>Tem certeza que deseja remover estes usuários?</span>
			<div class="btn-navbar pull-right">
				<input type="submit" class="btn btn-danger" value="Excluir" />
				<input type="button" data-toggle="dismiss" value="Cancelar" class="btn" />
			</div>
			<div class="clearfix"></div>
		</div>
		<h1>Usuários</h1>
		<table class="table table-striped table-bordered2">
			<caption>
				<div class="btn-group pull-right">
					<a href="~/admin/user/add" class="btn btn-inverse"><i class="icon icon-plus icon-white"></i> Novo</a>
					<a href="#user-remove-confirm" data-toggle="confirm" class="btn">Excluir</a>
				</div>
			</caption>
			<thead>
				<tr>
					<th class="span1">&nbsp;</th>
					<th class="span5">Nome</th>
					<th class="span6">Email</th>
					<th class="span6">Função</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($model->Data as $u): ?>
					<tr>
						<td><input type="checkbox" name="items[]" value="<?= $u->Id ?>"></td>
						<td>
							<img src="http://www.gravatar.com/avatar/<?= md5($u->Email) ?>?s=24" alt="<?= $u->Name ?>">
							<a href="~/admin/user/edit/<?= $u->Id ?>"><?= $u->Name ?></a>
						</td>
						<td><?= $u->Email ?></td>
						<td>-</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?= Pagination::create('admin/category/index', $model->Count, $p, $m) ?>
	</form>
</div>
