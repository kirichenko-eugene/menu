<?php
    require_once "../../includes/session_init.php";
    require "../auth.php";
    include "../../includes/config.php";
    include "../../includes/functions.php";
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Список всех блюд</title>
    <meta name="viewport" content="initial-scale=1, width=device-width" />
    <link rel="stylesheet" href="<?=SITE?>css/bootstrap.css">
    <link rel="stylesheet" href="<?=SITE?>css/style_admin.css">
    <link rel="stylesheet" href="<?=SITE?>css/style_table.css">
    <link rel="stylesheet" href="<?=SITE?>css/style_block.css">
</head>
<body>
    <nav>
        <ul class="topmenu">
            <li><a href="<?=PATH?>admin.php">Главная</a></li>
            <li><a href="<?=PATH?>webpanel/users.php">Пользователи</a></li>
            <li><a href="<?=PATH?>webpanel/alldishes.php">Блюда</a></li>
            <li><a href="<?=PATH?>webpanel/categories.php">Категории</a></li>
            <li><a href="<?=PATH?>admin.php?do=logout">Выход</a></li>
        </ul>
    </nav>
    <main>
        <h2 class='section__name'>Список блюд</h2>
        <input type="search" id="search" placeholder="Поиск">
        <?php
        $res = mysqli_query($db, ("SELECT * FROM elements WHERE status !=1 ORDER BY weight ASC")) or die("Ошибка " . mysqli_error($db));
    if(mysqli_num_rows($res) > 0) {
        // Подготовка к постраничному выводу
            $perpage = 10; // Количество отображаемых данных из БД
            if (empty($_GET['page']) || ($_GET['page'] <= 0)) {
            $page = 1;
            } else {
            $page = (int) $_GET['page']; // Считывание текущей страницы
            }
            // Общее количество информации
        $count = mysqli_num_rows($res); 
        $pages_count = ceil($count / $perpage); // Количество страниц
        // Если номер страницы оказался больше количества страниц
        if ($page > $pages_count) $page = $pages_count;
        $start_pos = ($page - 1) * $perpage; // Начальная позиция, для запроса к БД
        // Вызов функции, для вывода ссылок на экран
        universal_link_bar($page, $count, $pages_count, 6);?>
    <div id="display">  
        
                <?php
    // Вывод информации из базы данных
                $dishes = all_dishes_pages($start_pos, $perpage); 
                include 'alldishes_search.php';
    }   ?>
    </div>
    </main>

    <script src="../../js/jquery.min.js"></script>
    <script src="../../js/search.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
</body>
</html>