<h1>Página <small><?= $label ?></small></h1>
<form id="form-page" method="post" action="">
	<?= BForm::input('Título', 'Title', $model->Title, 'input-block-level', array('placeholder' => 'Digite o título aqui')) ?>
	<div class="row-fluid">
		<div class="span10">
			<div class="control-group">
				<label class="control-label" for="ParentId">Página Mãe</label>
				<div class="controls">
					<select name="ParentId" class="input-block-level">
						<option value="">Nenhuma</option>
						<?php foreach($pages->Data as $p): ?>
							<?php if(!isset($id) || $id != $p->Id): ?>
								<?php if($p->Id == $model->ParentId): ?>
								<option value="<?= $p->Id ?>" selected><?= $p->Title ?></option>
								<?php else: ?>
								<option value="<?= $p->Id ?>"><?= $p->Title ?></option>
								<?php endif ?>
							<?php endif ?>
						<?php endforeach ?>
					</select>
				</div>
			</div>
		</div>
		<div class="span2">
			<?= BForm::input('Ordem', 'Order', $model->Order) ?>
		</div>
	</div>
	<?= BForm::textarea('Conteúdo', 'Content', $model->Content, 'input-block-level ckeditor') ?>
	<?php if($label == 'Criar' || $model->Status === 0): ?>
	<button type="submit" class="btn btn-inverse">Publicar</button>
	<button type="submit" class="btn" name="Draft" value="1">Salvar Rascunho</button>
	<?php else: ?>
	<button type="submit" class="btn btn-inverse">Atualizar</button>
	<?php endif ?>
	<a href="~/admin/page" class="help-inline">Voltar</a>
</form>