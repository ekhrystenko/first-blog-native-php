<?php
// Подключение конфиг
require_once 'includes/config.php';

// Если не администатор редирект на главную 
if ( !isset($_SESSION['user']) || $_SESSION['user']['login'] != $config['admin'] ){
    header('location: index.php');
    exit;
} 
// Подключение хедера
require_once 'includes/header.php';
    
  // Обработчик удаление комментария 
    if ( isset($_GET['delete']) ){
      
      mysqli_query($connect, "DELETE FROM `comments` WHERE `id`=" . $_GET['delete']);
    }
  ?>

  <div id="content">
    <div class="container">
      <div class="row">
        <section class="content__left col-md-8">
          <div class="block">
            <h3 style="color: green; font-weight: bold">Комментарий успешно удален!</h3>

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