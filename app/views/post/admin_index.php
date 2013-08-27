<div class="row-fluid">
	<form id="form-post" action="~/admin/post/remove" method="POST">
		<div class="alert alert-warning" id="post-remove-confirm" style="display: none;">
			<span>Tem certeza que deseja remover estas páginas?</span>
			<div class="btn-navbar pull-right">
				<input type="submit" class="btn btn-danger" value="Excluir" />
				<input type="button" data-toggle="dismiss" value="Cancelar" class="btn" />
			</div>
			<div class="clearfix"></div>
		</div>
		<h1>Posts</h1>
		<table class="table table-striped">
			<caption>
				<div class="btn-navbar pull-left">
					<div class="btn-group">
						<a href="~/admin/post/add" class="btn btn-inverse"><i class="icon icon-plus icon-white"></i> Novo</a>
					</div>
					<div class="btn-group">
						<a href="#post-remove-confirm" data-toggle="confirm" class="btn">Excluir</a>
					</div>
					<div class="btn-group">
						<a id="btn-publish" href="~/admin/post/publish" class="btn">Publicar</a>
					</div>
				</div>
				<div class="btn-navbar pull-right">
					<div class="btn-group">
						<div class="input-append">
							<input id="input-search" type="text" name="q" value="" />
							<a id="btn-search" href="javascript:void(0);" class="btn" type="button"><i class="icon icon-search"></i></a>
						</div>
					</div>
				</div>
			</caption>
			<thead>
				<tr>
					<th class="span1">&nbsp;</th>
					<th class="span4">Título</th>
					<th class="span2">Slug</th>
					<th class="span3">Autor</th>
					<th class="span2">Data</th>
					<th class="span1">Status</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($model->Data): ?>
					<?php foreach ($model->Data as $p): $p->humanize() ?>
						<tr>
							<td><input type="checkbox" name="items[]" value="<?= $p->Id ?>"></td>
							<td>
								<a href="~/admin/post/edit/<?= $p->Id ?>"><?= $p->Title ?></a>
							</td>
							<td><?= $p->Slug ?></td>
							<td><?= $p->AuthorName ?></td>
							<td><?= $p->PublicationDate ?></td>
							<td><span class="badge <?= $p->Status ? 'badge-success' : '' ?>">&nbsp;</span></td>
						</tr>
					<?php endforeach; ?>
				<?php else: ?>
					<tr>
						<td colspan="5">Não há páginas a serem listadas.</td>
					</tr>
				<?php endif ?>
			</tbody>
		</table>
		<?= Pagination::create('admin/page/index', $model->Count, $p, $m) ?>
	</form>
</div>
