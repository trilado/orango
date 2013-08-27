<?php
/*
 * Copyright (c) Trilado Team (triladophp.org)
 * All rights reserved.
 */


/**
 * Arquivo de configuração
 * 
 */

/**
 * Define o tipo do debug
 */
Config::set('debug', array(
	'type'	=> 'local', //pode assumir os seguintes valores: off, local, network e all
	'query'	=> false, //pode assumir false, para desativar, ou um valor para a query ?debug=seu-valor-seguro
	'sql'	=> false, 
));

/**
 * Tipo do drive do banco de dados, pode assumir os seguintes valores: mysql
 */
Config::set('database', array(
	'default' => array(
		'type' => 'mysql',
		'host' => 'localhost',
		'name' => 'orango',
		'user' => 'root',
		'pass' => '',
		'validate' => true
	)
));

/**
 * Master Page padrão
 */
Config::set('default_master', 'public');

/**
 * Controller padrão
 */
Config::set('default_controller', 'Post');

/**
 * Controller padrão para páginas de erro. Defina como NULL para não utilizar controler de erro
 */
Config::set('error_controller', null);

/**
 * Action padrão
 */
Config::set('default_action', 'index');

/**
 * Página de login
 */
Config::set('default_login', '~/admin');

/**
 * Charset padrão
 */
Config::set('charset', 'UTF-8');

/**
 * Linguagem padrão
 */
Config::set('default_lang', 'pt-br');

/**
 * Formato padrão da data.
 */
Config::set('date_format', 'd/m/Y');

/**
 * Chave de segurança (deve ser alterada)
 */
Config::set('salt', '3Df3g&¨bfd34hukk[ufd;');

/**
 * Define se as requisições via dispositivo móvel irão carregar os templates específicos, se existirem, para versão móvel
 */
Config::set('auto_mobile', true);

/**
 * Define se as requisições via tablet irão carregar os templates  específicos, se existirem, para versão tablet
 */
Config::set('auto_tablet', false);

/**
 * Define se as requisições AJAX devem retornar automaticamente conteúdo em JSON
 */
Config::set('auto_ajax', true);

/**
 * Define se actions acessadas com .xml devem retorna automaticamente conteúdo em XML
 */
Config::set('auto_dotxml', true);

/**
 * Define se actions acessadas com .json devem retorna automaticamente conteúdo em JSON
 */
Config::set('auto_dotjson', true);

/**
 * Define as configurações de cache
 */
Config::set('cache', array(
	'enabled'	=> false,
	'type'		=> 'file',
	'host'		=> 'localhost',
	'port'		=> '',
	'page'		=> false,
	'time'		=> 10
));

/**
 * Registrar diretórios de arquivos de código fonte, para autoload 
 */
Config::set('directories', array(
	'controller' 	=> App::$root . 'app/controllers',
	'model' 		=> App::$root . 'app/models',
	'helper' 		=> App::$root . 'app/helpers',
	'vendor' 		=> App::$root . 'app/vendors',
	App::$root . 'app/exceptions',
));

/**
 * Registrar diretórios de arquivos de código fonte, para autoload 
 */
Config::set('modules', array(
	//'Example' 		=> App::$root . 'app/modules/example/',
));

Config::set('html_safe_list', '<a><address><em><strong><b><i><big><small><sub><sup><cite><code><img><ul><ol><li><dl><lh><dt><dd><br><p><table><th><td><tr><pre><blockquote><nowiki><h1><h2><h3><h4><h5><h6><hr>');

Config::set('site_name', 'Orango CMS');

Config::set('theme', 'default');

Config::set('image', array(
	'w' => 150,
	'h' => 150,
	'path' => 'media/'
));