<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=<?= Config::get('charset') ?>">
		<meta charset="<?= Config::get('charset') ?>">
		<title><?= Config::get('site_name') ?></title>
		<link href="~/css/bootstrap.css" rel="stylesheet">
		<link href="~/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="~/css/style.css" rel="stylesheet">
		<link rel="shortcut icon" href="~/img/favicon.png">
		<?= ModuleComposer::getAdds(ModuleComposer::PUBLIC_HEAD_ADDS); ?>
	</head>
	<body>
		<?= Import::view(array('pages' => $pages), '_master', 'navbar') ?>
		<div class="container-fluid content">
			<div class="row-fluid">
				<div class="span3">
					<?= Import::view(array('categories' => $categories), '_master', 'sidebar') ?>
				</div>
				<section class="span9">
					<?= CONTENT ?>
				</section>
			</div>
			<hr>
			<footer>
				<p class="muted"><?= Config::get('site_name') ?> - Feito com <a href="http://triladophp.org">Trilado Framework</a>.</p>
			</footer>
		</div>
		<script src="~/js/jquery.min.js"></script>
		<script src="~/js/bootstrap.min.js"></script>
		<?= ModuleComposer::getAdds(ModuleComposer::PUBLIC_BODY_ADDS); ?>
	</body>
</html>