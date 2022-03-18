<?php if($dishes): ?>
    <?php include "properties.php"; ?>  
    <div class="text-block text-block-top-margin"><?php get_cat_name($_GET['category']);?></div>

<div id = "display" class="columns"> 
<?php foreach($dishes as $dish): ?>

<?php 
$dishprice = $dish['price'] / 100;
$end_description=htmlspecialchars($dish['genLongComment0419'], ENT_QUOTES);
$keywords = preg_split("/[\s,]+/", $dish['property']);
$find_properties = array_intersect_key($properties, array_flip($keywords));
?>
    <figure> 
        <a data-fancybox="dish" data-caption=
        "<div><h3><?=htmlspecialchars($dish['genName0419'], ENT_QUOTES)?></h3></div>
        <div> 
            <?php
            foreach ($find_properties as $one_property) { ?>
                <img class='dishicons-img-size' src='<?=SITE . $one_property?>'>
            <?php } ?>
        </div>
        <?php if(mb_strlen($end_description) <= 40) { ?>
            <p><?=$end_description?></p>
        <?php } else { ?>
            <a style='text-decoration: underline;' data-fancybox data-src='#modal-description' href='javascript:;'><?=mb_substr($end_description, 0, 40,'UTF-8');?>...</a>
        <div style='display: none;' id='modal-description'>
          <h4><?=htmlspecialchars($dish['genName0419'], ENT_QUOTES)?></h4>
          <p><?=$end_description?></p>
        </div>
        <?php } ?>
        <div><?=$dishprice?> руб.</div>
        <div><button class='btn-cart btn-buy btn btn-danger btn-width' dish_name='<?=htmlspecialchars($dish['genName0419'], ENT_QUOTES)?>' id='<?=$dish['Ident']?>' dish_price='<?=$dishprice?>'>Заказать</button></div>  
        "
        href="<?=SITE . $bdir . $dish['LargeImagePath']?>">
        <?php if ($dish['LargeImagePath'] != NULL) { ?>
            <img src="<?=SITE . $dir . $dish['LargeImagePath']?>" alt="">
                <?php 
                if($dish['property']){
                    $count_properties = count($keywords);
                    // Значения для рассчета отступа иконок
                    $start_px = 124;
                    $gap_px = 17; 
                    
                    foreach ($find_properties as $one_property) { ?>
                    <span class="dishicons d-flex justify-content-start" style="left:<?=$start_px?>px"> 

                                <img class='dishicons-img' src='<?=SITE . $one_property?>'>

                        </span>
                         <?php 
                     $start_px = $start_px - $gap_px -2;      
                     }  ?>
                       
                        
                <?php } 
        } else { ?>
            <img src="img/no_img.png" alt="no_dish">
        <?php } ?>
        </a>
        <figcaption>
            <!-- Ограничиваем название в 37 символов и устанавливаем кодировку. Это для миниатюры -->
            <div class="description-img cut_name"><?php
                $end_name=htmlspecialchars($dish['genName0419'], ENT_QUOTES);
                if(mb_strlen($end_name) <= 37) {
                    echo $dish['genName0419']; 
                } else { 
                    echo mb_substr($end_name, 0, 37,'UTF-8');
                    echo '...';
                } ?> 
            </div>
            <div class="description-img dishprice"><?=$dishprice?> руб.</div>
        </figcaption>     
         <div><button class='btn-cart btn-buy btn btn-danger btn-width' dish_name='<?=htmlspecialchars($dish['genName0419'], ENT_QUOTES)?>' id='<?=$dish['Ident']?>' dish_price='<?=$dishprice?>'>Заказать</button></div>   
        <!-- ****************************************************************************************** -->
    </figure>

<?php endforeach; ?>

<?php endif; ?>
</div>