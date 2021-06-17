<?php 
// Подключение БД
$connect = mysqli_connect(
	$config['db']['server'],
	$config['db']['username'],
	$config['db']['password'],
	$config['db']['name']);

// Если подключение к БД не выполнено
if ( $connect == false ){
	echo 'Не удалось подключиться к БД<br>';
	echo mysqli_connect_error();
	exit();
}
