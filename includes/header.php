<?php
// Подключение файла конфиг  
require_once 'config.php';  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $config['title']; ?></title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../media/css/main.css"/>
  <link rel="shortcut icon" href="<?php echo $config['logo_icon'] ;?>">
</head>
<body>
<div class="main">
  <div id="wrapper">
      <a href="#header" class="btn-top"><img src="../media/images/up.png" alt=""></a>
    <header id="header">
      <div class="header__top">
        <div class="container">
          <div class="header__top__logo">
            <a href="../index.php"><h1><?php echo $config['logo']?></h1></a>
          </div>
          <nav class="header__top__menu">
            <ul>
              <li><a href="../index.php">Главная</a></li>
              <li><a href="reg.php">Регистрация</a></li>
              <li><a href="enter.php">Авторизация</a></li>
            </ul>
          </nav>
        </div>
      </div>
        
      <?php 
      // Вывод категорий з БД
      $categories_arr = mysqli_query($connect, "SELECT * FROM `categories`");
           $categories = [];
           while ( $result_cat = mysqli_fetch_assoc($categories_arr) ){
            $categories[] = $result_cat;
           } 
      ?>

    <div class="header__bottom">
      <div class="container">
        <nav>
          <ul class="menu">
          
          <?php
          // Вывод категорий з БД в меню хедера 
          foreach ( $categories as $result_cat ) { ?>
            <li><a href="/categorie.php?categorie=<?php echo $result_cat['id']; ?>"><?php echo $result_cat['titles']; ?></a></li>
          <?php  
            }
          ?>

          </ul>
        </nav>
      </div>
    </div>
  </header>