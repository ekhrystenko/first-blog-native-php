<?php 
// Подключение хедера
require_once 'includes/header.php'; 

// Валидация формы добавления статьи (если админ)
if ( isset($_POST['do_send']) ){

$nameArt = strip_tags($_POST['title']);
$textArt = strip_tags($_POST['text']);
$errors = [];

if ( $nameArt == ''){
  $errors[] = 'Введите название статьи!';
} elseif ( $textArt == ''){
  $errors[] = 'Напишите текст статьи!';
} elseif ( empty($_FILES['img']['tmp_name']) ){
  $errors[] = 'Загрузите картинку для статьи!';
} 

if (empty($errors)){
  // Добавляем статью в болг и БД если нет ошибок
  $comlete = '<span style="color: green; font-weight: bold">Статья успешно добавлена!</span><hr>';
  $name = $_FILES['img']['name'];
  move_uploaded_file($_FILES['img']['tmp_name'], 'media/images/' . $name);

  $art_result_cat = false;
  foreach ($categories as $result_cat) {
      if ( $result_cat['id'] == $_GET['categorie'] ){
        $art_result_cat = $result_cat;
        break;
      }
  }

  mysqli_query($connect, "INSERT INTO `articles` (`image`, `title`, `text`, `categories_id`) VALUES ('$name', '$nameArt', '$textArt'," . $art_result_cat['id'] . ")");

// Если есть ошибки выводим  
} else {
  $error = '<span style="color: red; font-weight: bold">' . array_shift($errors) . '</span><hr>';
} 
}
?>  

<div id="content">
<div class="container">
  <div class="row">
    <section class="content__left col-md-8">
      <div class="block">
        <h3>Все статьи</h3>
          <div class="block__content">
           <div class="articles articles__horizontal">

            <?php
            // Вывод всех статей категории 
            $art_c = mysqli_query($connect, "SELECT * FROM `articles` WHERE `categories_id` = " . (int) $_GET['categorie']); 

              // Если статей нет
              if ( mysqli_num_rows($art_c) <=0 ){ ?>
              
                  <article class="article">
                    <div>Статей пока нету!</div>
                    <div class="article__info">
                    <div class="article__info__meta">
                    </div>
                    </div>
                  </article>

            <?php
            // Если статьи есть 
              } else {
                while ( $art_cat = mysqli_fetch_assoc($art_c) ){ ?>
                  <article class="article">
                    <div class="article__image" style="background-image: url(media/images/<?php echo $art_cat['image']; ?>);"></div>
                    <div class="article__info">
                     <a href="/article.php?id=<?php echo $art_cat['id']; ?>"><?php echo $art_cat['title']; ?></a>

                    <div class="article__info__meta">

                    <?php
                    // Вывод категорий к статьям 
                      $art_result_cat = false;
                      foreach ($categories as $result_cat) {
                          if ( $result_cat['id'] == $art_cat['categories_id'] ){
                            $art_result_cat = $result_cat;
                            break;
                          }
                      }
                    ?>

                  <small>Категория: <a href="/categorie.php?categorie=<?php echo $art_result_cat['id']; ?>"><?php echo $art_result_cat['titles']; ?></a></small>
                  </div>
                  <div class="article__info__preview"><?php echo mb_substr(strip_tags($art_cat['text']), 0, 80, 'utf-8') . ' ...' ?></div>
                  </div>
                </article>

                <?php  
                  }
                }
                ?>

          </div>
        </div>
      </div>
      
      <?php
      // Если администратор выводим форму добвления статьи
      if ( isset($_SESSION['user']['login']) && $_SESSION['user']['login'] == $config['admin'] ){ ?> 
        
      <div class="block" id="article-add">
        <h3>Добавить статью</h3>
        <div class="block__content">
          
          <?php
          // Вывод ошибок валидации 
          if (isset($comlete)) echo $comlete;
          if (isset($error)) echo $error;
          ?>

          <form class="form" method="POST" action="/categorie.php?categorie=<?php echo $art_result_cat['id'] ?>#article-add" enctype="multipart/form-data">
            <div class="form__group">
              <div class="row">
                <div class="col-md-6">
                  <input type="text" class="form__control" name="title" placeholder="Название статьи" value="<?php if (isset($nameArt)) echo $nameArt ?>">
                </div>
              </div>
            </div>
            <div class="form__group">
              <textarea name="text" class="form__control" placeholder="Текст статьи"><?php if (isset($textArt))echo $textArt; ?></textarea>
            </div>
            <div class="form__group"> 
                  <label>Картинка статьи</label><br>
                  <input type="file" name="img" style="border: 2px solid silver; padding: 10px">
            </div>
            <div class="form__group">
              <input type="submit" class="form__control" name="do_send" value="Добавить статью">
            </div>
          </form>
        </div>
      </div>
      <?php 
      } 
      ?>
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