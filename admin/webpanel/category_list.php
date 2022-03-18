<?php 
	$res = mysqli_query($db, ("SELECT * FROM categories WHERE status =1 AND parent != ''")) or die("Ошибка " . mysqli_error($db));
	if(mysqli_num_rows($res) > 0) {
		// Подготовка к постраничному выводу
            $perpage = 7; // Количество отображаемых данных из БД
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
	<div>  
		<form action="<?=PATH?>post_modules/edit_category.php" method="POST" enctype="multipart/form-data">

			<table class="table"><thead class="table_head"><tr><th>Выбрать</th><th>Название</th><th>Позиция</th><th>Изображение</th><th>Родитель</th></tr></thead>
				<?php
    // Вывод информации из базы данных
				$categories = all_categories_pages($start_pos, $perpage); ?>
				<?php if($categories): ?>
					<?php foreach($categories as $category): ?>
						<tr>
							<td class="table_column checkbox"><input type="checkbox" id="<?=$category['id']?>" name="update[]" value="<?=$category['id']?>"><label for="<?=$category['id']?>"></label></td>
							<td class="table_column"><input type="text" name="name_<?=$category['id']?>" value="<?=$category['category']?>"></td>
							<td class="table_column"><input type="text" name="weight_<?=$category['id']?>" value="<?=$category['weight']?>"></td>
							<td class="table_column">
								<input type="hidden" name="oldpicture_<?=$category['id']?>" value="<?=$category['img']?>">
				                    <div class="red_text"><?=$category['img']?></div>
				                <input name="newpicture_<?=$category['id']?>" type="file">
							</td>
							<td class="table_column">
								<input type="hidden" name="oldcategory_<?=$category['id']?>" value="<?=$category['parent']?>">
								<div class="red_text"><?=$category['parent_category']?></div>
								<select name="category_<?=$category['id']?>">
									<option value="no_category">Выберите категорию</option>
									<?php
									$allCategories = all_categories(); ?>
									<?php if($allCategories): ?>
										<?php foreach($allCategories as $oneCategory): ?>
											<option value="<?=$oneCategory['id']?>"><?=$oneCategory['name']?></option>
										<?php endforeach; ?>
									<?php endif; ?>
								</select>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</table>
			<div class="submit_buttons">
				<button type="submit" class="btn btn-success" name="submit">Редактировать</button>
				<button type="submit" class="btn btn-success" name="delsubmit">Удалить</button>
			</div>
		</form>
		
	</div>
	<?php
	}
	?>
	