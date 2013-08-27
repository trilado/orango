<div class="row-fluid">
	<form action="~/admin/page/remove" method="POST">
		<div class="alert alert-warning" id="page-remove-confirm" style="display: none;">
			<span>Tem certeza que deseja remover estas páginas?</span>
			<div class="btn-navbar pull-right">
				<input type="submit" class="btn btn-danger" value="Excluir" />
				<input type="button" data-toggle="dismiss" value="Cancelar" class="btn" />
			</div>
			<div class="clearfix"></div>
		</div>
		<h1>Páginas</h1>
		<table class="table table-striped">
			<caption>
				<div class="btn-navbar pull-left">
					<div class="btn-group">
						<a href="~/admin/page/add" class="btn btn-inverse"><i class="icon icon-plus icon-white"></i> Nova</a>
					</div>
					<div class="btn-group">
						<a href="#page-remove-confirm" data-toggle="confirm" class="btn">Excluir</a>
					</div>
				</div>
			</caption>
			<thead>
				<tr>
					<th class="span1">&nbsp;</th>
					<th class="span7">Título</th>
					<th class="span2">Slug</th>
					<th class="span1">Ordem</th>
					<th class="span1">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php if($model->Data): ?>
					<?php foreach ($model->Data as $p): ?>
						<tr>
							<td><input type="checkbox" name="items[]" value="<?= $p->Id ?>"></td>
							<td>
								<a href="~/admin/page/edit/<?= $p->Id ?>"><?= $p->Title ?></a>
							</td>
							<td><?= $p->Slug ?></td>
							<td><?= $p->Order ?></td>
							<td><span class="badge <?= $p->Status ? 'badge-success' : '' ?>">&nbsp;</span></td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="4">Não há páginas a serem listadas.</td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
		<?= Pagination::create('admin/page/index', $model->Count, $p, $m) ?>
	</form>
</div>