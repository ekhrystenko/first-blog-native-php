<?php
//Подключение хедера 
require_once 'includes/header.php';

// Запрос в БД для вывода определенной статьи по GET
$article = mysqli_query($connect, "SELECT * FROM `articles` WHERE `id` = " . (int)$_GET['id']);

  // Если статьи нет
  if (mysqli_num_rows($article) <= 0){
?>

<div id="content">
  <div class="container">
    <div class="row">
      <section class="content__left col-md-8">
        <div class="block">
          <h3>Статья не найдена!</h3>
          <div class="block__content">
            <div class="full-text">
              Статья которую вы искали несуществует!
            </div>
          </div>
        </div>
      </section>

    </div>
  </div>
</div>

  <?php  
    }
      // Если статья существует
      $art = mysqli_fetch_assoc($article);
      // Запрос на добавление просмотров при обновлении
      mysqli_query($connect, "UPDATE `articles` SET `views` = `views` + 1 WHERE `id` =" . (int)$art['id']);
  ?>
<div id="content">
  <div class="container">
    <div class="row">
      <section class="content__left col-md-8">
        <div class="block">
          <a><?php echo $art['views']; ?> просмотров</a>
          <h3><?php echo $art['title']; ?></h3>
          <div class="block__content">
            <img src="/media/images/<?php echo $art['image']; ?>" style="max-width: 50%">

            <div class="full-text">
              <?php echo $art['text']; ?>
            </div>
          </div>
        </div>

        <?php
          // Валидация формы добавления комментария
          if ( isset($_POST['do_post']) ){

          $nameCom = strip_tags($_POST['name']);
          $textCom = nl2br( strip_tags($_POST['text']) );
          $avatar = $_SESSION['user']['avatar'];
          $errors = [];

          if ( $nameCom == ''){
            $errors[] = 'Введите Имя!';
          } elseif ( $textCom == ''){
            $errors[] = 'Напишите комментарий!';
          } 

          if (empty($errors)){
            // Добавляем комментарий в болг и БД если нет ошибок
            $comlete = '<span style="color: green; font-weight: bold">Комментарий успешно добавлен!</span><hr>';

            mysqli_query($connect, "INSERT INTO `comments` (`author`, `image`, `text`, `articles_id`) VALUES ('$nameCom', '$avatar', '$textCom'," . (int)$art['id'] . ")");
          
          // Если есть ошибки выводим  
          } else {
            $error = '<span style="color: red; font-weight: bold">' . array_shift($errors) . '</span><hr>';
          } 
        }
        ?>

        <div class="block">
          <a href="#comment-add">Добавить свой</a>
          <h3 id="com">Комментарии к статье</h3>
          <div class="block__content">
            <div class="articles articles__vertical">
        
            <?php 
            // Запрос на вывод коментариев к статье
            $comments = mysqli_query($connect, "SELECT * FROM `comments` WHERE `articles_id` =" . (int)$art['id']);

            // Если комментариев нет
            if ( mysqli_num_rows($comments) <= 0 ){
              echo 'Коментариев пока нет!';
            }
            // Если коментарии есть выводим
            while ( $com = mysqli_fetch_assoc($comments) ) { 

              ?>

            <article class="article">
              <div class="article__image" style="background-image: url(<?php echo $com['image']; ?>);"></div>
            <div class="article__info">
              <a href="/article.php?id=<?php echo $com['articles_id']; ?>"><?php echo $com['author']; ?></a>

              <?php 
              // Удаление комментариев если администратор
              if ( isset($_SESSION['user']['login']) && $_SESSION['user']['login'] == $config['admin'] ){ ?>
                <a href="/delete.php?delete=<?php echo $com['id']; ?>" style="color: red; float: right">Удалить</a>
              <?php 
              } 
              ?>

                <div class="article__info__meta">
                  <small>Дата публикации: <?php echo $com['pubdate']; ?></small>
                </div>
              <div class="article__info__preview"><?php echo $com['text']; ?></div>
            </article>

            <?php  
            }
            ?>
            
            </div>
          </div>
        </div>
        
        <div class="block" id="comment-add">
          <h3>Добавить комментарий</h3>
          <div class="block__content">

            <?php
            // Вывод ошибок валидации 
            if (isset($comlete)) echo $comlete;
            if (isset($error)) echo $error;
            ?>

            <?php
            // Если пользователь авторизован выводим форму 
              if ( isset ($_SESSION['user']) ){
            ?>

            <form class="form" method="POST" action="/article.php?id=<?php echo $art['id'] ?>#comment-add">
              <div class="form__group">
                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form__control" name="name" placeholder="Имя" value="<?php echo $_SESSION['user']['login']; ?>">
                  </div>
                </div>
              </div>
              <div class="form__group">
                <textarea name="text" class="form__control" placeholder="Текст комментария ..."><?php if (isset($textCom)) echo $textCom; ?></textarea>
              </div>
              <div class="form__group">
                <input type="submit" class="form__control" name="do_post" value="Добавить комментарий">
              </div>
            </form>

            <?php 
              // Если пользователь не авторизован
              } else {
              echo 'Комментарии могут оставлять только зарегистрированые пользователи!<br><a href="reg.php">Зарегистрироваться</a> или <a href="enter.php">Войти</a>';
              } 
            ?>
              
          </div>
        </div>
      </section>
      <section class="content__right col-md-4">

          <?php
          // Подключение сайдбара 
          require_once 'includes/sidebar.php' 
          ?>

      </section>
    </div>
  </div>
</div>

<?php 
  // Подключение футера
  require_once 'includes/footer.php'
?>