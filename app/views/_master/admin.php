<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Orango</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Vaneves">

		<link href="~/css/bootstrap.css" rel="stylesheet">
		<link href="~/css/bootstrap-responsive.css" rel="stylesheet">
		<link href="~/css/style.css" rel="stylesheet">
	</head>

	<body>
		<header>
			<div class="container">
				<div class="row-fluid">
					<div class="span11">
						<div class="logo"><h1 class="muted">Orango</h1></div>
					</div>
					<div class="span1 visible-desktop">
						<?php if(Auth::isLogged()): ?>
						<img src="http://www.gravatar.com/avatar/<?= md5(Session::get('user')->Email) ?>?s=48" alt="<?= Session::get('user')->Name ?>" class="img-circle">
						<?php endif ?>
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
											<li><a href="~/admin/page/add">Página</a></li>
											<li><a href="~/admin/user/add">Usuário</a></li>
										</ul>
									</li>
								</ul>
								<ul class="nav pull-right">
									<li><a href="~/admin/user/logout">Sair</a></li>
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
						<li class="active"><a href="~/admin/post/">Posts</a></li>
						<li><a href="~/admin/category/">Categorias</a></li>
						<li><a href="~/admin/page/">Páginas</a></li>
						<li><a href="~/admin/user/">Usuários</a></li>
					</ul>
				</div>
				<div class="span9">
					<?= FLASH ?>
					<?= CONTENT ?>
				</div>
				<?php else: ?>
				<div class="span12">
					<?= FLASH ?>
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
		<script src="~/js/ckeditor/ckeditor.js"></script>
		<script src="~/js/main.js"></script>
	</body>
</html>