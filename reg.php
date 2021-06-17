<?php
	// Подключение файла конфиг  
	require_once 'includes/config.php';

	// Валидация формы
	if ( isset($_POST['send']) ){

	$login = strip_tags(trim($_POST['login']));
	$email = strip_tags(trim($_POST['email']));
	$pass = strip_tags($_POST['password']);
	$pass_2 = strip_tags($_POST['password_2']);

	$errors = [];

	if ( $login == ''){
		$errors[] = 'Введите логин!';
	} elseif ( $email == ''){
		$errors[] = 'Введите Email!';
	} elseif ( filter_var($email, FILTER_VALIDATE_EMAIL) == false){
		$errors[] = 'Введите коректный Email!';
	}	elseif ( $pass == ''){
		$errors[] = 'Введите пароль!';
	} elseif  ( $pass_2 == ''){
		$errors[] = 'Введите пароль еще раз!';
	} elseif  ( $pass_2 != $pass){
		$errors[] = 'Повторный пароль введен не верно!';
	} elseif ( empty($_FILES['avatar']['tmp_name']) ){
		$errors[] = 'Загрузите аватар!';
	}

	// Проверка логина на уникальность
	$check_login = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
	if ( mysqli_num_rows($check_login) > 0){
		$errors[] = 'Такой логин уже существует!';
	}

	// Если нет ошибок регистрируем
	if (empty($errors)) {

		// Создание пути для загрузки файла
		$path = 'file/' . time() . $_FILES['avatar']['name'];
		move_uploaded_file($_FILES['avatar']['tmp_name'], $path);

		$pass = md5($pass);
		$pass_2 = md5($pass_2);

		// Добавление в БД
		mysqli_query($connect, "INSERT INTO `users` (`login`, `image`, `email`, `password`) VALUES ('$login', '$path', '$email', '$pass')");

		$_SESSION['complete'] = 'Вы успешно зарегистрированы!<br><a href="enter.php" style="text-decoration: underline; color: blue">Авторизоваться</a>';
		header('location: reg.php');
		die;

	} else {
		// Переменная ошибок
		$show_errors = array_shift($errors);
	}	
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Регистрация</title>
  <link href="media/css/form.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo $config['logo_icon'] ;?>">
</head>
<body>
	<form action="reg.php" method="post" enctype="multipart/form-data">
		<h2>Регистрация</h2>
			<p class="msg"><?php if (isset($show_errors)) echo $show_errors; ?></p>
			<p class="complete">
				<?php 
				if (isset($_SESSION['complete'])){
					echo $_SESSION['complete'];
					unset($_SESSION['complete']);} 
				?>
			</p>
	    	<label>Введите Логин</label>
	    		<input type="text" name="login" placeholder="Логин" class="input" value ="<?php if (isset($login)) echo $login ?>">
	    	<label>Введите Email</label>
	    		<input type="text" name="email" placeholder="Емейл" class="input" value ="<?php if (isset($email)) echo $email ?>">
	    	<label>Введите Пароль</label>
	    		<input type="password" name="password" placeholder="Пароль" id="pass" value="<?php if (isset($pass)) echo $pass ?>">
	   		<label for="show" class="show"><input type="checkbox" class="password-checkbox" id="show">Показать пароль</label>
	    	<label>Введите пароль еще раз</label>
	    		<input type="password" name="password_2" placeholder="Пароль" id="pass_2" value="<?php if (isset($pass_2)) echo $pass_2 ?>">
	    	<label for="show_2" class="show"><input type="checkbox" class="password-checkbox_2" id="show_2">Показать пароль</label>
	    	<label>Загрузить аватар</label>
				<input type="file" name="avatar" class="input" accept="image/png,image/jpeg">
	    	<button type="submit" name="send">Зарегестрироваться</button><br>
	    	<button name="send_log"><a href="index.php" class="a">Назад</a></button>
	</form>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="media/js/main.js"></script>
</body>
</html>