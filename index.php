<?php 
// Подключение файла хедер
require_once 'includes/header.php';
?> 

<div id="content">
  <div class="container">
    <div class="row">
      <section class="content__left col-md-8">
        <div class="block">
          <a href="/all_art.php">Все записи</a>
          <h3>Новые</h3>
            <div class="block__content">
             <div class="articles articles__horizontal">

              <?php
              // Вывод новых статей 
              $articles = mysqli_query($connect, "SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 4");
   
              // Если статей нет
              if ( mysqli_num_rows($articles) <=0 ){ ?>
              
                <article class="article">
                  <div>Новых статей пока нету!</div>
                  <div class="article__info">
                  <div class="article__info__meta">
                  </div>
                  </div>
                </article>
                    
                <?php
                // Если статьи есть
                } else {

                  while ( $art = mysqli_fetch_assoc($articles) ){ ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(media/images/<?php echo $art['image']; ?>);"></div>
                      <div class="article__info">
                       <a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
                      <div class="article__info__meta">

                        <?php
                        // Вывод категорий новых статей 
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
                  } 
                  ?>

            </div>
          </div>
        </div>

        <div class="block">
          <a href="/categorie.php?categorie=1">Все записи</a>
          <h3>Спорт [Новые]</h3>
          <div class="block__content">
            <div class="articles articles__horizontal">

              <?php 
              // Вывод новых статей категории спорт
              $articles = mysqli_query($connect, "SELECT * FROM `articles` WHERE `categories_id` = 1 ORDER BY `id` DESC LIMIT 4");

                // Если статей нет
                if ( mysqli_num_rows($articles) <=0 ){ ?>
                
                    <article class="article">
                      <div>Новых статей пока нету!</div>
                      <div class="article__info">
                      <div class="article__info__meta">
                      </div>
                      </div>
                    </article>
                    
                <?php
                // Если статьи есть
                } else {

                  while ( $art = mysqli_fetch_assoc($articles) ){ ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(media/images/<?php echo $art['image']; ?>);"></div>
                      <div class="article__info">
                       <a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
                      <div class="article__info__meta">

                        <?php 
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
                  }
                  ?>

            </div>
          </div>
        </div>

        <div class="block">
          <a href="/categorie.php?categorie=2">Все записи</a>
          <h3>Программирование [Новые]</h3>
          <div class="block__content">
            <div class="articles articles__horizontal">

              <?php
              // Вывод новых статей категории програм 
              $articles = mysqli_query($connect, "SELECT * FROM `articles` WHERE `categories_id` = 2 ORDER BY `id` DESC LIMIT 4");

                // Если статей нет
                if ( mysqli_num_rows($articles) <=0 ){ ?>
                
                    <article class="article">
                      <div>Новых статей пока нету!</div>
                      <div class="article__info">
                      <div class="article__info__meta">
                      </div>
                      </div>
                    </article>
                    
                <?php
                // Если статьи есть
                } else {

                  while ( $art = mysqli_fetch_assoc($articles) ){ ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(media/images/<?php echo $art['image']; ?>);"></div>
                      <div class="article__info">
                       <a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
                      <div class="article__info__meta">

                        <?php 
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
                  }
                  ?>

            </div>
          </div>
        </div>

        <div class="block">
          <a href="/categorie.php?categorie=3">Все записи</a>
          <h3>Игры [Новые]</h3>
          <div class="block__content">
            <div class="articles articles__horizontal">

              <?php 
              // Вывод новых статей категории игры
              $articles = mysqli_query($connect, "SELECT * FROM `articles` WHERE `categories_id` = 3 ORDER BY `id` DESC LIMIT 4"); 

                // Если статей нет
                if ( mysqli_num_rows($articles) <=0 ){ ?>
                
                    <article class="article">
                      <div>Новых статей пока нету!</div>
                      <div class="article__info">
                      <div class="article__info__meta">
                      </div>
                      </div>
                    </article>

              <?php
              // Если статьи есть 
                } else {
              
                  while ( $art = mysqli_fetch_assoc($articles) ){ ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(media/images/<?php echo $art['image']; ?>);"></div>
                      <div class="article__info">
                       <a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
                      <div class="article__info__meta">

                        <?php 
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
                  }
                  ?>

            </div>
          </div>
        </div>

        <div class="block">
          <a href="/categorie.php?categorie=4">Все записи</a>
          <h3>Автомобили [Новые]</h3>
          <div class="block__content">
            <div class="articles articles__horizontal">

              <?php 
              // Вывод новых статей категории авто
              $articles = mysqli_query($connect, "SELECT * FROM `articles` WHERE `categories_id` = 4 ORDER BY `id` DESC LIMIT 4"); 

                // Если статей нет
                if ( mysqli_num_rows($articles) <=0 ){ ?>
                
                    <article class="article">
                      <div>Новых статей пока нету!</div>
                      <div class="article__info">
                      <div class="article__info__meta">
                      </div>
                      </div>
                    </article>

              <?php
              // Если статьи есть 
                } else {

                  while ( $art = mysqli_fetch_assoc($articles) ){ ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(media/images/<?php echo $art['image']; ?>);"></div>
                      <div class="article__info">
                       <a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
                      <div class="article__info__meta">

                        <?php 
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
                  }
                  ?>

            </div>
          </div>
        </div>

        <div class="block">
          <a href="/categorie.php?categorie=5">Все записи</a>
          <h3>Музыка [Новые]</h3>
          <div class="block__content">
            <div class="articles articles__horizontal">

              <?php
              // Вывод новых статей категории музыка 
              $articles = mysqli_query($connect, "SELECT * FROM `articles` WHERE `categories_id` = 5 ORDER BY `id` DESC LIMIT 4");

                // Если статей нет
                if ( mysqli_num_rows($articles) <=0 ){ ?>
                
                    <article class="article">
                      <div>Новых статей пока нету!</div>
                      <div class="article__info">
                      <div class="article__info__meta">
                      </div>
                      </div>
                    </article>

                <?php
                // Если статьи есть
                } else {

                while ( $art = mysqli_fetch_assoc($articles) ){ ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(media/images/<?php echo $art['image']; ?>);"></div>
                      <div class="article__info">
                       <a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
                      <div class="article__info__meta">

                        <?php 
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
                  }
                  ?>

            </div>
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
  require_once 'includes/footer.php';
