<?php
	// Подключение файла конфиг 
	require_once 'includes/config.php';

	// Валидация формы
	if ( isset($_POST['send_form']) ){

	$name = strip_tags(trim($_POST['name']));
	$email = strip_tags(trim($_POST['email']));
	$message = strip_tags(trim($_POST['message']));
	$phone = strip_tags(trim($_POST['phone']));

	$errors = [];

	if ( $name == '' ){
		$errors[] = 'Введите имя!';
	} elseif ( $email == '' ){
		$errors[] = 'Введите Email!';
	} elseif ( filter_var($email, FILTER_VALIDATE_EMAIL) == false){
		$errors[] = 'Введите коректный Email!';
	} elseif ( $phone == '' ){
		$errors[] = 'Введите телефон!';
	} elseif ( !is_numeric($phone) ){
		$errors[] = 'Поле "телефон" должно содержать символы 0-9!';
	} elseif ( $message == '' ){
		$errors[] = 'Напишите Ваше сообщение!';
	} elseif ( mb_strlen($message) < 6){
		$errors[] = 'Напишите сообщение не менее 6 символов!';
	}

	// Если нет ошибок отправляем письмо
	if ( empty($errors) ){

	$mess = "У Вас новое сообщение от: \n"
			. "Имя: " . ($name) . "\n"
 			. "E-Mail: " . ($email) . "\n"
 			. "Телефон: " . ($phone) . "\n"
 			. "Сообщение: " . ($message);

 	$subject = "=?utf-8?B?".base64_encode("Сообщение с сайта!")."?=";

    $email_from = $email;
    $name_from = "Форма обратной связи";

    $headers = "MIME-Version: 1.0" . PHP_EOL .
               "Content-Type: text/html; charset=utf-8" . PHP_EOL .
               "From: " . "=?utf-8?B?".base64_encode($name_from)."?=" . "<" . $email_from . ">" .  PHP_EOL .
               "Reply-To: " . $email_from . PHP_EOL;

 	$mail = mail("swallow1991@gmail.com", $subject, $mess, $headers);

 		if ($mail){
 			$_SESSION['complete'] = 'Сообщение успешно отправлено!<br><a href="index.php" style="text-decoration: underline; color: blue">На главную</a>';
 			header('location: write.php');
 			die; 			
 		} 	else {
 			$errors[] = 'Ошибка отправки. Попробуйте позже!';
 		}

 	}
 	// Переменная ошибок	
 	$show_errors = array_shift($errors);

 	}
	
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Обратная связь</title>
  <link href="media/css/form.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?php echo $config['logo_icon'] ;?>">
</head>
<body>
	<form action="write.php" method="post">
		<h2>Напишите сообщение</h2>
			<p class="msg"><?php if (isset($show_errors)) echo $show_errors; ?></p>
			<p class="complete">
				<?php 
				if (isset($_SESSION['complete'])){
					echo $_SESSION['complete'];
					unset($_SESSION['complete']);} 
				?>
			</p>
	    	<label>Ваше Имя</label>
	    		<input type="text" name="name" placeholder="Введите имя" value ="<?php if (isset($name)) echo $name ?>">
	    	<label>Ваш E-Mail</label>
	    		<input type="text" name="email" placeholder="Введите E-Mail" value ="<?php if (isset($email)) echo $email ?>">
	    	<label>Ваш Телефон</label>
	    		<input type="text" name="phone" placeholder="Введите телефон" value ="<?php if (isset($phone)) echo $phone ?>">
	    	<label>Ваше Сообщение</label>
	    		<textarea name="message" cols="40" rows="10" placeholder="Введите сообщение"><?php if (isset($message)) echo $message ?></textarea>
	    	<button type="submit" name="send_form">Отправить</button><br>
	    	<button name="submit"><a href="index.php" class="a">Назад</a></button>
	</form>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="attr/js/main.js"></script>
</body>
</html>