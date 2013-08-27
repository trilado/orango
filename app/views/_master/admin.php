<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Orango</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<link href="~/css/bootstrap.css" rel="stylesheet">
		<link href="~/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="~/css/chosen.min.css" rel="stylesheet">
		<link href="~/css/style.css" rel="stylesheet">
		
		<link rel="shortcut icon" href="~/img/favicon.png">
	</head>

	<body>
		<header>
			<div class="container">
				<div class="row-fluid">
					<div class="span11">
						<div class="logo"><h1 class="muted">Orango</h1></div>
					</div>
				</div>
			</div>
			<div class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container">
						<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<div class="nav-collapse collapse">
							<?php if (Auth::isLogged()): ?>
								<ul class="nav">
									<li><a href="~/">Ver Site</a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Novo <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="~/admin/post/add">Post</a></li>
											<?php if (Auth::is('Admin', 'Manager')): ?>
											<li><a href="~/admin/page/add">Página</a></li>
											<?php endif ?>
											<?php if (Auth::is('Admin')): ?>
											<li><a href="~/admin/user/add">Usuário</a></li>
											<?php endif ?>
										</ul>
									</li>
									<?= ModuleComposer::getAdds(ModuleComposer::NAV_BAR_ADDS); ?>
								</ul>
								<ul class="nav pull-right">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<img src="http://www.gravatar.com/avatar/<?= md5(Session::get('user')->Email) ?>?s=16" alt="<?= Session::get('user')->Name ?>">
										<?= Session::get('user')->Name ?>
											<b class="caret"></b>
										</a>
										<ul class="dropdown-menu">
											<li><a href="~/admin/user/me">Editar Perfil</a></li>
											<li><a href="~/admin/user/logout">Sair</a></li>
										</ul>
									</li>
								</ul>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="container">
			<div class="row-fluid">
				<?php if (Auth::isLogged()): ?>
				<div class="span3">
					<ul class="nav nav-tabs nav-stacked">
						<li <?= $active === 'post' ? 'class="active"' : ''  ?>><a href="~/admin/post/">Posts</a></li>
						<?php if (Auth::is('Admin', 'Manager')): ?>
						<li <?= $active === 'category' ? 'class="active"' : ''  ?>><a href="~/admin/category/">Categorias</a></li>
						<li <?= $active === 'page' ? 'class="active"' : ''  ?>><a href="~/admin/page/">Páginas</a></li>
						<?php endif; ?>
						<?php if (Auth::is('Admin')): ?>
						<li <?= $active === 'user' ? 'class="active"' : ''  ?>><a href="~/admin/user/">Usuários</a></li>
						<?php endif; ?>
						<?= ModuleComposer::getAdds(ModuleComposer::SIDE_MENU_ADDS); ?>
					</ul>
				</div>
				<div class="span9">
					<?= FLASH ?>
					<?= CONTENT ?>
				</div>
				<?php else: ?>
				<div class="span12">
					<?= CONTENT ?>
				</div>
				<?php endif ?>
			</div>
			<hr>
			<div class="footer">
				<p class="muted">Orango CMS - Feito com <a href="http://triladophp.org">Trilado Framework</a>.</p>
			</div>
		</div>
		<script src="~/js/jquery.min.js"></script>
		<script src="~/js/bootstrap.min.js"></script>
		<script src="~/js/jquery.validate.min.js"></script>
		<script src="~/js/chosen.jquery.min.js"></script>
		<script src="~/js/ckeditor/ckeditor.js"></script>
		<script src="~/js/main.js"></script>
	</body>
</html>