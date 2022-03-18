<?php 

/**
* Пагинация для админки
**/
function universal_link_bar($page, $count, $pages_count, $show_link)
{
// $show_link - это количество отображаемых ссылок;
// нагляднее будет, когда это число будет парное
// Если страница всего одна, то вообще ничего не выводим
if ($pages_count == 1) return false;
$sperator = ' '; // Разделитель ссылок; например, вставить "|" между ссылками
// Для придания ссылкам стиля
$style = 'style="color: #3d94f6; font-size: 18px; text-decoration: none;"';
$begin = $page - intval($show_link / 2);
unset($show_dots); // На всякий случай :)
// Сам постраничный вывод
// Если количество отображ. ссылок больше кол. страниц
if ($pages_count <= $show_link + 1) $show_dots = 'no';
// Вывод ссылки на первую страницу
if (($begin > 2) && !isset($show_dots) && ($pages_count - $show_link > 2)) {
echo '<a '.$style.' href='.$_SERVER['php_self'].'?page=1> |< </a> ';
}

for ($j = 0; $j < $page; $j++) {
// Если страница рядом с концом, то выводить ссылки перед идущих для того,
// чтобы количество ссылок было постоянным
if (($begin + $show_link - $j > $pages_count) && ($pages_count-$show_link + $j > 0)) {
$page_link = $pages_count - $show_link + $j; // Номер страницы
// Если три точки не выводились, то вывести
if (!isset($show_dots) && ($pages_count-$show_link > 1)) {
echo ' <a '.$style.' href='.$_SERVER['php_self'].'?page='.($page_link - 1).'><b>...</b></a> ';
// Задаем любое значение для того, чтобы больше не выводить в начале "..." (три точки)
$show_dots = "no";
}
// Вывод ссылки
echo ' <a '.$style.' href='.$_SERVER['php_self'].'?page='.$page_link.'>'.$page_link.'</a> '.$sperator;
} else continue;
}
for ($j = 0; $j <= $show_link; $j++) // Основный цикл вывода ссылок
{
$i = $begin + $j; // Номер ссылки
// Если страница рядом с началом, то увеличить цикл для того,
// чтобы количество ссылок было постоянным
if ($i < 1) {
$show_link++;
continue;
}
// Подобное находится в верхнем цикле
if (!isset($show_dots) && $begin > 1) {
echo ' <a '.$style.' href='.$_SERVER['php_self'].'?page='.($i-1).'><b>...</b></a> ';
$show_dots = "no";
}
// Номер ссылки перевалил за возможное количество страниц
if ($i > $pages_count) break;
if ($i == $page) {
echo ' <a '.$style.' ><b>'.$i.'</b></a> ';
} else {
echo ' <a '.$style.' href='.$_SERVER['php_self'].'?page='.$i.'>'.$i.'</a> ';
}
// Если номер ссылки не равен кол. страниц и это не последняя ссылка
if (($i != $pages_count) && ($j != $show_link)) echo $sperator;
// Вывод "..." в конце
if (($j == $show_link) && ($i < $pages_count)) {
echo ' <a '.$style.' href='.$_SERVER['php_self'].'?page='.($i+1).'><b>...</b></a> ';
}
}
// Вывод ссылки на последнюю страницу
if ($begin + $show_link + 1 < $pages_count) {
echo ' <a '.$style.' href='.$_SERVER['php_self'].'?page='.$pages_count.'> >| </a>';
}
return true;
} 
// ****************************************************

/**
* выбрать блюда для поиска
**/
function getDishesByNameAndFilters($name){
    $query = "SELECT e.id AS id, e.Ident AS ident, e.Name AS rkname, e.genName0419 AS sitename, e.genLongComment0419 AS comment, e.price AS price, e.LargeImagePath AS image, e.weight AS weight, e.Parent AS parent, e.status AS status, c.name AS catname  
    FROM elements e 
    LEFT JOIN categories c on e.Parent = c.id 
    WHERE e.status != 1";
    $query .= !$name ? "" : " AND e.Name LIKE '%$name%' ORDER BY e.weight ASC";
    
    global $db;
    $res = mysqli_query($db, $query);
    $dishes = array();
    while($row = mysqli_fetch_assoc($res)){
        $dishes[] = $row;
    }
    return $dishes;
}
// ****************************************************

/**
* выбрать пользователя для логина
**/
function enter_user($name) {
    global $db;
    $query = "SELECT * FROM users WHERE name='".$name."' AND status = 1 LIMIT 1";
    $result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
    while ($row = mysqli_fetch_assoc($result)) {
        $user_login[] = $row;
    }
    return $user_login;
}
// ****************************************************

/**
* выбрать всех пользователей
**/
function all_users() {
    global $db;
    $query = "SELECT * FROM users";
    $result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
    while ($row = mysqli_fetch_assoc($result)) {
        $user[] = $row;
    }
    return $user;
}
// ****************************************************

/**
* выбрать всех неудаленных пользователей со страницами
**/
function all_users_pages($start_pos, $perpage) {
    global $db;
    $query = 'SELECT * FROM users WHERE status = 1 limit '.$start_pos.', '.$perpage;
    $result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    return $users;
    } else {
        echo "Нет данных для отображения";
    }
}
// ****************************************************

/**
* выбрать все категории со страницами
**/
function all_categories_pages($start_pos, $perpage) {
    global $db;
    $query = "SELECT c.id AS id, c.name AS category, c.img AS img, c.parent AS parent, c.status AS status, c.weight AS weight, cat.name AS parent_category  
    FROM categories c 
    inner join categories cat on c.parent = cat.id 
    WHERE c.status = 1 AND c.parent != '' 
    ORDER BY c.weight ASC 
    limit ".$start_pos.', '.$perpage;
    $result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
    return $categories;
    } else {
        echo "Нет данных для отображения";
    }
}
// ****************************************************

/**
* выбрать все категории
**/
function all_categories() {
    global $db;
    $query = "SELECT * FROM categories WHERE status = 1 AND parent != '' ORDER BY weight ASC ";
    $res = mysqli_query($db, $query);

    $arr_cat = array();
    while($row = mysqli_fetch_assoc($res)){
        $arr_cat[$row['id']] = $row;
    }
    return $arr_cat;
}
// ****************************************************

/**
* выбрать все блюда
**/
function all_dishes($dish_parent) {
    global $db;
    $query = "SELECT * FROM elements WHERE status = 1 AND Parent = $dish_parent ORDER BY weight ASC";
    $result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dishes[] = $row;
        }
    return $dishes;
    } 
}
// ****************************************************

/**
* выбрать все категории для меню
**/
function root_categories($root) {
    global $db;
    $query = "SELECT * FROM categories WHERE status = 1 AND parent = $root ORDER BY weight ASC ";
    $result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
    return $categories;
    } 
}
// ****************************************************

/**
* выбрать все категории для меню
**/
function get_cat_name($get) {
    global $db;
    $query = "SELECT * FROM categories WHERE status = 1 AND id = $get ORDER BY weight ASC ";
    $result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
            foreach($categories as $cat_name) {
                echo $cat_name['name'];
            }
        }
    return $cat_name;
    } 
}
// ****************************************************

/**
* выбрать все категории для меню
**/
function first_category() {
    global $db;
    $query = "SELECT id FROM categories WHERE name = 'Корневая категория'";
    $result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $category = $row['id'];
        }
    return $category;
    } 
}
// ****************************************************

/**
* крошки
**/
function breadcrumbs_menu($array, $id) {

    if(!$id) return false;

    $count = count($array);
    $breadcrumbs_array = array();
    for($i = 0; $i < $count; $i++){
        if($array[$id]){
            $breadcrumbs_array[$array[$id]['id']] = $array[$id]['name'];
            $id = $array[$id]['parent'];
        }else break;
    }
    return array_reverse($breadcrumbs_array, true);
}
// ****************************************************

/**
* выбрать все блюда для админки со страницами
**/
function all_dishes_pages($start_pos, $perpage) {
    global $db;
    $query = 'SELECT e.id AS id, e.Ident AS ident, e.Name AS rkname, e.genName0419 AS sitename, e.genLongComment0419 AS comment, e.price AS price, e.CategPath AS cpath, e.weight AS weight, e.LargeImagePath AS image, e.Parent AS parent, e.property AS property, e.status AS status, c.name AS catname 
    FROM elements e 
    LEFT JOIN categories c on e.Parent = c.id 
    WHERE e.status != 1 ORDER BY e.weight ASC limit '.$start_pos.', '.$perpage;
    $result = mysqli_query($db, $query) or die("Ошибка " . mysqli_error($db));
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $dishes[] = $row;
        }
    return $dishes;
    } else {
        echo "Нет данных для отображения";
    }
}
// ****************************************************

/**
* выбрать все блюда для админки со страницами
**/
function getCartSum(){
    if(!isset($_SESSION['cart'])){
        return 0;
    }
    $count = 0;
    $cart_content = unserialize($_SESSION['cart']);
    foreach($cart_content as $cart_item){
        $count += $cart_item['value']*$cart_item['count'];
    }
    return $count;
}
// ****************************************************

// изменение размера изображений
function resizeImage($file, $new_width, $new_height, $path){

         define ('MAX_WIDTH', 2500);//max image width               
         define ('MAX_HEIGHT', 2500);//max image height 
         define ('MAX_FILE_SIZE', 10485760);

         //iamge save path
        

        //size of the resize image 
         // $new_width = 128; 
         // $new_height = 128;    

        //name of the new image           
        // $nameOfFile = 'resize_'.$new_width.'x'.$new_height.'_'.basename($file['name']);  
        $nameOfFile = basename($file['name']);      

        $image_type = $file['type'];
        $image_size = $file['size'];
        $image_error = $file['error'];
        $image_file = $file['tmp_name'];
        $image_name = $file['name'];        

        $image_info = getimagesize($image_file);

        //check image type 
        if ($image_info['mime'] == 'image/jpeg' or $image_info['mime'] == 'image/jpg'){    
        }
        else if ($image_info['mime'] == 'image/png'){    
        }
        else if ($image_info['mime'] == 'image/gif'){    
        }
        else{            
            //set error invalid file type
        }

        if ($image_error){
            //set error image upload error
        }

        if ( $image_size > MAX_FILE_SIZE ){
            //set error image size invalid
        }

        switch ($image_info['mime']) {
            case 'image/jpg': //This isn't a valid mime type so we should probably remove it
            case 'image/jpeg':
            $image = imagecreatefromjpeg ($image_file);
            break;
            case 'image/png':
            $image = imagecreatefrompng ($image_file);
            break;
            case 'image/gif':
            $image = imagecreatefromgif ($image_file);
            break;
        }    

        if ($new_width == 0 && $new_height == 0) {
            $new_width = 100;
            $new_height = 100;
        }

        // ensure size limits can not be abused
        $new_width = min ($new_width, MAX_WIDTH);
        $new_height = min ($new_height, MAX_HEIGHT);

        //get original image h/w
        $width = imagesx ($image);
        $height = imagesy ($image);

        //$align = 'b';
        $zoom_crop = 1;
        $origin_x = 0;
        $origin_y = 0;
        //TODO setting Memory

        // generate new w/h if not provided
        if ($new_width && !$new_height) {
            $new_height = floor ($height * ($new_width / $width));
        } else if ($new_height && !$new_width) {
            $new_width = floor ($width * ($new_height / $height));
        }

        // scale down and add borders
    if ($zoom_crop == 3) {

         $final_height = $height * ($new_width / $width);

         if ($final_height > $new_height) {
            $new_width = $width * ($new_height / $height);
         } else {
            $new_height = $final_height;
         }

    }

        // create a new true color image
        $canvas = imagecreatetruecolor ($new_width, $new_height);
        imagealphablending ($canvas, false);


        if (strlen ($canvas_color) < 6) {
            $canvas_color = 'ffffff';       
        }

        $canvas_color_R = hexdec (substr ($canvas_color, 0, 2));
        $canvas_color_G = hexdec (substr ($canvas_color, 2, 2));
        $canvas_color_B = hexdec (substr ($canvas_color, 2, 2));

        // Create a new transparent color for image
        $color = imagecolorallocatealpha ($canvas, $canvas_color_R, $canvas_color_G, $canvas_color_B, 127);

        // Completely fill the background of the new image with allocated color.
        imagefill ($canvas, 0, 0, $color);

        // scale down and add borders
    if ($zoom_crop == 2) {

            $final_height = $height * ($new_width / $width);

        if ($final_height > $new_height) {
            $origin_x = $new_width / 2;
            $new_width = $width * ($new_height / $height);
            $origin_x = round ($origin_x - ($new_width / 2));
            } else {

            $origin_y = $new_height / 2;
            $new_height = $final_height;
            $origin_y = round ($origin_y - ($new_height / 2));

        }

    }

        // Restore transparency blending
        imagesavealpha ($canvas, true);

        if ($zoom_crop > 0) {

            $src_x = $src_y = 0;
            $src_w = $width;
            $src_h = $height;

            $cmp_x = $width / $new_width;
            $cmp_y = $height / $new_height;

            // calculate x or y coordinate and width or height of source
            if ($cmp_x > $cmp_y) {
        $src_w = round ($width / $cmp_x * $cmp_y);
        $src_x = round (($width - ($width / $cmp_x * $cmp_y)) / 2);
            } else if ($cmp_y > $cmp_x) {
        $src_h = round ($height / $cmp_y * $cmp_x);
        $src_y = round (($height - ($height / $cmp_y * $cmp_x)) / 2);
            }

            // positional cropping!
        if ($align) {
            if (strpos ($align, 't') !== false) {
                $src_y = 0;
            }
                        if (strpos ($align, 'b') !== false) {
                                $src_y = $height - $src_h;
                        }
                        if (strpos ($align, 'l') !== false) {
                $src_x = 0;
            }
            if (strpos ($align, 'r') !== false) {
                $src_x = $width - $src_w;
            }
        }

            // positional cropping!
            imagecopyresampled ($canvas, $image, $origin_x, $origin_y, $src_x, $src_y, $new_width, $new_height, $src_w, $src_h);

         } else {       
        imagecopyresampled ($canvas, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    }
        //Straight from Wordpress core code. Reduces filesize by up to 70% for PNG's
        if ( (IMAGETYPE_PNG == $image_info[2] || IMAGETYPE_GIF == $image_info[2]) && function_exists('imageistruecolor') && !imageistruecolor( $image ) && imagecolortransparent( $image ) > 0 ){
            imagetruecolortopalette( $canvas, false, imagecolorstotal( $image ) );
    }
        $quality = 100;            
        // $nameOfFile = 'resize_'.$new_width.'x'.$new_height.'_'.basename($file['name']); 
        $nameOfFile = basename($file['name']);       

    if (preg_match('/^image\/(?:jpg|jpeg)$/i', $image_info['mime'])){                       
        imagejpeg($canvas, $path.$nameOfFile, $quality);  

    } else if (preg_match('/^image\/png$/i', $image_info['mime'])){                         
        imagepng($canvas, $path.$nameOfFile, floor($quality * 0.09)); 

    } else if (preg_match('/^image\/gif$/i', $image_info['mime'])){               
        imagegif($canvas, $path.$nameOfFile); 

    }
}
// ****************************************************************************************************

?>