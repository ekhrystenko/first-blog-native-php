<?php 
  //Подключение хедера
  require_once 'includes/header.php' 
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
              // Вывод всех статей
              $articles = mysqli_query($connect, "SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 10"); 
                  while ( $art = mysqli_fetch_assoc($articles) ){ ?>
                    <article class="article">
                      <div class="article__image" style="background-image: url(media/images/<?php echo $art['image']; ?>);"></div>
                      <div class="article__info">
                       <a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
                      <div class="article__info__meta">

                        <?php
                        // Вывод категорий всех статей 
                          $art_result_cat = false;
                          foreach ($categories as $result_cat) {
                              if ( $result_cat['id'] == $art['categories_id'] ){
                                $art_result_cat = $result_cat;
                                break;
                              }
                          }
                        ?>

                      <small>Категория: <a href="/article.php?categorie=<?php echo $art_result_cat['id']; ?>"><?php echo $art_result_cat['titles']; ?></a></small>
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
      </section>

        <section class="content__right col-md-4">

          <?php
            //Подключение хедера
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