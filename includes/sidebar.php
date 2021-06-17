<?php
// Подключение файла конфиг 
require_once 'includes/config.php';
?>

<div class="block">

  <?php
  // Проверка авторизован ли пользователь  
  if ( !isset($_SESSION['user']) ){
    echo '<h4>Вы вошли как гость!<br> <a href="../enter.php" style="color: black">Авторизоватся </a><img src="../media/images/login.png"></h4>';
  } else { 
    
    // Если админ 
    if ( $_SESSION['user']['login'] == $config['admin'] ){
      $admin = '<span style="color: red"> (admin)</span>'; } ?> 
    <h3 style="font-weight: bold;">Вы вошли как:<br> <?php echo $_SESSION['user']['login']; if (isset($admin)) echo $admin ?> </h3>
    <img class="profile" style="max-width: 130px" src="<?php echo $_SESSION['user']['avatar']; ?> "><br>
    <p><h4><a href="../exit.php" style="color: black">Выйти </a><img src="../media/images/logout.png"></h4></p>

  <?php 
  } 
  ?> 
  
</div>

  <div class="block">
  <h3>Топ 3 читаемых статей</h3>
  <div class="block__content">
    <div class="articles articles__vertical">

    <?php 
    // Запрос в БД вывод статей по просмотрам
    $articles = mysqli_query($connect, "SELECT * FROM `articles` ORDER BY `views` DESC LIMIT 3"); 
        while ( $art = mysqli_fetch_assoc($articles) ){ ?>
          <article class="article">
            <div class="article__image" style="background-image: url(media/images/<?php echo $art['image']; ?>);"></div>
            <div class="article__info">
             <a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
            <div class="article__info__meta">

              <?php
              // Вывод категорий к статьям 
                $art_result_cat = false;
                foreach ($categories as $result_cat) {
                    if ( $result_cat['id'] == $art['categories_id'] ){
                      $art_result_cat = $result_cat;
                      break;
                    }
                }
              ?>

            <small>Категория: <a href="/categorie.php?categorie=<?php echo $art_result_cat['id']; ?>"><?php echo $art_result_cat['titles']; ?></a></small>
            </div>
            <div class="article__info__preview"><?php echo mb_substr(strip_tags($art['text']), 0, 80, 'utf-8') . ' ...' ?></div>
            </div>
          </article>

      <?php  
      }
      ?>

    </div>
  </div>
</div>

<div class="block">
  <h3>Комментарии</h3>
  <div class="block__content">
    <div class="articles articles__vertical">

        <?php 
        // Вывод статей з БД
        $articles_arr = mysqli_query($connect, "SELECT * FROM `articles`");
             $articles = [];
             while ( $result_art = mysqli_fetch_assoc($articles_arr) ){
              $articles[] = $result_art;
             } 
        ?>

      <?php
      // Запрос в БД вывод комментариев 
      $comments = mysqli_query($connect, "SELECT * FROM `comments` ORDER BY `id` DESC LIMIT 5"); 
        while ( $com = mysqli_fetch_assoc($comments) ){ ?>
          <article class="article">
            <div class="article__image" style="background-image: url(<?php echo $com['image']; ?>);"></div>
            <div class="article__info">
             <a href="/article.php?id=<?php echo $com['articles_id']; ?>"><?php echo $com['author']; ?></a>
            <div class="article__info__meta">

              <?php
              // Вывод статей к комментариям 
                $art_result_art = false;
                foreach ($articles as $result_art) {
                    if ( $result_art['id'] == $com['articles_id'] ){
                      $art_result_art = $result_art;
                      break;
                    }

                }
              ?>
            <small>Статья: <a href="/article.php?id=<?php echo $art_result_art['id']; ?>"><?php echo $art_result_art['title']; ?></a></small><br>
          
            <small>Дата: <?php echo $com['pubdate']; ?></small>
          </div>
            <div class="article__info__preview"><?php echo mb_substr(strip_tags($com['text']), 0, 200, 'utf-8') ?></div>
            </div>
          </article>

      <?php  
      }
      ?>

    </div>
  </div>
</div>