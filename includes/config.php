<?php 
// Старт сессий
session_start();

error_reporting(-1);
// Масив конфиг
$config = [
	'title' => 'Мой первый блог',
	'logo' => '<img src="../media/images/b.png"><img src="../media/images/l.png"><img src="../media/images/o.png"><img src="../media/images/g.png">',
	'logo_icon' => 'media/images/blog_title.png',
	'db' => [
		'server' => 'localhost',
		'username' => 'mysql',
		'password' => 'mysql',
		'name' => 'mybase'
		],
	'admin' => 'Eugene Khrystenko'	

];

// Файл подключения БД
require_once 'db.php';