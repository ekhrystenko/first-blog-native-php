<?php
	// Подключение файла конфиг  
	require_once 'includes/config.php';

	if ( isset($_SESSION['user']) ){
		header('location: profile.php');
		exit;
	}

	// Валидация формы
	if ( isset($_POST['send_login']) ){

	$login = strip_tags(trim($_POST['login']));
	$pass = strip_tags($_POST['password']);

	$errors = [];

	if ( $login == ''){
		$errors[] = 'Введите логин!';
	} elseif ( $pass == '' ){
		$errors[] = 'Введите пароль!';
	}

	if (empty($errors)){
		// Авторизуєм если поля заполнены
		$pass = md5($pass);
		$result = mysqli_query($connect, "SELECT * FROM `users` WHERE `login`= '$login' AND `password`='$pass'");	
		mysqli_num_rows($result);

		// Проверяем наличие пользователя в БД
		if ( mysqli_num_rows($result) > 0 ){
				$user = mysqli_fetch_assoc($result);
				
				$_SESSION['user'] = [
						'id' => $user['id'],
						'login' => $user['login'],
						'avatar' => $user['image']
				];

				header('location: index.php');
				exit;

		} else {
			$errors[] = 'Такого пользователя не существует!';
			$show_errors = array_shift($errors);
		}
	} else {
		$show_errors = array_shift($errors);
	}
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Авторизация</title>
  <link href="media/css/form.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo $config['logo_icon'] ;?>">
</head>
<body>
	<form action="enter.php" method="post">
		<h2>Авторизация</h2>
			<p class="msg"><?php if (isset($show_errors)) echo $show_errors; ?></p>
	    	<label>Введите Логин</label>
	    		<input type="text" name="login" placeholder="Логин" class="input" value ="<?php if (isset($login)) echo $login ?>">
	    	<label>Введите Пароль</label>
	    		<input type="password" name="password" placeholder="Пароль" id="pass" value="">
	   		<label for="show" class="show"><input type="checkbox" class="password-checkbox" id="show">Показать пароль</label>
	    	<button type="submit" name="send_login">Войти</button><br>
	    	<button type="submit"><a href="index.php" class="a">Назад</a></button>
	</form>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="media/js/main.js"></script>
</body>
</html>