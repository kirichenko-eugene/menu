<?php 
// проверяем, если ли в get параметр, если нет, то берем корневую категорию
if(isset($_GET['category']) ){
            $root = (int)$_GET['category']; 
        } else {
            $root = first_category();
        }
$categories = root_categories($root);
if(isset($categories)) {

   foreach($categories as $category) {
      $root_parent = $category['id']; 
      $root_image = $category['img'];
      if ($root_image != '') {
        $image = $root_image;
      } else {
        $image = 'no_category.jpg';
      }
      ?>
      <!-- в стилях прописан путь к изображению, чтобы выводить их в цикле -->
      <a class="picture-block" style="background:  url(<?=SITE?>img/categories/<?=$image?>)" href="<?=SITE?>index.php?category=<?=$category['id']?>"><div class="picture-block-cover"></div><span class="picture-text"><?=$category['name']?></span></a> 
  
      <?php 
              
}
} 

        $dishes = all_dishes($root);
        include "dishes.php"; 
?>