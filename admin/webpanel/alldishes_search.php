 <form action="<?=PATH?>post_modules/edit_dish_status.php" method="POST" enctype="multipart/form-data">

            <table class="table"><thead class="table_head"><tr><th>&#10004;</th><th>RK id</th><th>RK имя</th><th>Название</th><th>Описание</th><th>Цена</th><th>Путь в RK</th><th>Позиция</th><th><?php include "about_properties.php"; ?></th><th>Картинка</th><th>Родитель</th><th>Статус</th></tr></thead>
 <?php if($dishes): ?>
                    <?php foreach($dishes as $dish): ?>
                        <tr>
                            <td class="table_column checkbox"><input type="checkbox" id="<?=$dish['id']?>" name="update[]" value="<?=$dish['id']?>"><label for="<?=$dish['id']?>"></label></td>
                            <td class="table_column"><span><?=$dish['ident']?></span></td>
                            <td class="table_column"><span><?=$dish['rkname']?></span></td>
                            <td class="table_column"><span><?=$dish['sitename']?></span></td>
                            <td class="table_column"><span><?=$dish['comment']?></span></td>
                            <td class="table_column"><span><?=$dish['price']/100?></span></td>
                            <td class="table_column"><span><?=$dish['cpath']?></span></td>
                            <!-- Позиция -->
                            <td class="table_column"><input class="w-50" type="text" name="weight_<?=$dish['id']?>" value="<?=$dish['weight']?>"></td>

                            <!-- Свойства блюда -->
                           <td class="table_column">
                                <input type="hidden" name="oldproperty_<?=$dish['id']?>" value="<?=$dish['property']?>">
                                <input type="text" name="property_<?=$dish['id']?>" value="<?=$dish['property']?>">
                            </td>

                             <!-- Изображение -->
                            <td class="table_column">
                                <input type="hidden" name="oldpicture_<?=$dish['id']?>" value="<?=$dish['image']?>">
                                            <div class="red_text"><?=$dish['image']?></div>
                                <input name="newpicture_<?=$dish['id']?>" type="file">
                            </td></td>

                            <td class="table_column">
                                <input type="hidden" name="oldcategory_<?=$dish['id']?>" value="<?=$dish['parent']?>">
                                <div class="red_text"><?=$dish['catname']?></div>
                                <select class="w-100" name="category_<?=$dish['id']?>">
                                    <option value="no_category">Новый</option>
                                    <?php
                                    $total_categories = all_categories(); ?>
                                    <?php if($total_categories): ?>
                                        <?php foreach($total_categories as $one_category): ?>
                                            <option value="<?=$one_category['id']?>"><?=$one_category['name']?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </td>
                            <td class="table_column"><span>
                                <?php if($dish['status'] == 1) {
                                    echo "активно";
                                } elseif ($dish['status'] == 2) {
                                    echo "отключено";
                                } elseif ($dish['status'] == 0) {
                                    echo "нет категории";
                                } ?>
                            </span></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </table>
            <div class="submit_buttons">
                <button class="btn btn-success" type="submit" name="submit">Применить</button>
                <button class="btn btn-success" type="submit" name="delsubmit">Отключить</button>
            </div>
        </form>