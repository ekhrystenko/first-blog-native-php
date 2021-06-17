<?php
// Подключение файла конфиг  
require_once 'includes/config.php';

// Уничтожение сессии
unset($_SESSION['user']);
header('location: index.php');

?>