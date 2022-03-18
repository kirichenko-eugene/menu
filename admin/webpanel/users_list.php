<?php 
$count = mysqli_num_rows(mysqli_query($db, ("SELECT * FROM users WHERE status =1"))) or die("Ошибка " . mysqli_error($db)); 

	$pages_count = ceil($count / $perpage); // Количество страниц

	// Если номер страницы оказался больше количества страниц
	if ($page > $pages_count) $page = $pages_count;
	$start_pos = ($page - 1) * $perpage; // Начальная позиция, для запроса к БД
	// Вызов функции, для вывода ссылок на экран
	universal_link_bar($page, $count, $pages_count, 6);
	?>
	<div>  
		<form action="<?=PATH?>post_modules/edit_user.php" method="POST">

			<table class="table"><thead class="table_head"><tr><th>Выбрать</th><th>Имя</th></tr></thead>
				<?php
    // Вывод информации из базы данных
				$users = all_users_pages($start_pos, $perpage); ?>
				<?php if($users): ?>
					<?php foreach($users as $user): ?>
						<tr>
							<td class="table_column checkbox"><input type="checkbox" id="<?=$user['id']?>" name="update[]" value="<?=$user['id']?>"><label for="<?=$user['id']?>"></label></td>
							<td class="table_column"><input type="text" name="name_<?=$user['id']?>" value="<?=$user['name']?>"></td>
						</tr>
					<?php endforeach; ?>
				<?php endif; ?>
			</table>
			<div class="submit_buttons">
				<button class="btn btn-success" type="submit" name="submit">Редактировать</button>
				<button class="btn btn-success" type="submit" name="delsubmit">Удалить</button>
			</div>
		</form>
		
		<div class="change"><div class="changelink"><a href="<?=PATH?>webpanel/change_pass.php">Форма смены пароля</a></div></div>
	</div>