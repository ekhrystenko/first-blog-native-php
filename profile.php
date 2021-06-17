<?php 
	// Подключение файла конфиг 
	require_once 'includes/config.php';

	// Если нет авторизации редирект 
	if ( !isset($_SESSION['user']) ){
		header('location: enter.php');
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Добро пожаловать <?php echo $_SESSION['user']['login']?>!</title>
	<link href="media/css/form.css" rel="stylesheet">	
	<link rel="shortcut icon" href="<?php echo $config['logo_icon'] ;?>">
</head>
<body>
	<?php
	if ($_SESSION['user']['login'] == $config['admin']){
		$admin = '<br><span style="color: red">Вы вошли как администратор сайта!</span>';
	} 
	?>
	<p class="complete auth">
		<?php echo 'Добро пожаловать '. $_SESSION['user']['login'] . '! '; if(isset($admin)) echo $admin ?><br>
		<img class="profile" src="<?php echo $_SESSION['user']['avatar']; ?> ">
		<a href="index.php" class="exit">На главную!</a>
		<a href="exit.php" class="exit">Вийти!</a>
	</p>
</body>
</html>