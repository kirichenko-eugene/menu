<!-- Modal -->
<div class="modal fade right" id="exampleModalPreview1" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel1" aria-hidden="true">
    <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
        <div class="modal-content-full-width modal-content ">
            <div class=" modal-header-full-width modal-header text-center">
                <h5 class="modal-title w-100" id="exampleModalPreviewLabel1">Сервис</h5>
            </div>
            <div class="modal-body">
    <div class="d-flex flex-column justify-content-center">
      <div>
        <!-- Кнопка личный кабинет (Панфилова) ************** -->
					 <?php if($lic == 11) { ?> 
						<form class="text-center" action="https://goodcity.com.ru/cards/login" method="POST">
							<input class="btn btn-danger btn-lg menu-button" type="submit" name="crm" value="Личный кабинет">
						</form>
					<?php  } ?> 	
      </div>

      <div>
       <!-- Кнопка вызов официанта ************** -->
					<form class="text-center" action="<?=SITE?>service/callwaiter.php?id=00&msg=вызов" method="POST">
						<input class="btn btn-danger btn-lg menu-button" type="submit" name="callwaiter" value="Официант">
					</form>
      </div>

      <div>
       <!-- Кнопка вызов кальянщика ************** -->
					<?php if($smoke == 1) { ?>
						<form class="text-center" action="<?=SITE?>service/callwaiter.php?id=02&msg=кальян" method="POST">
						<input class="btn btn-danger btn-lg menu-button" type="submit" name="callwaiter" value="Кальянщик">
						</form>	
					<?php } ?>		
      </div>

      <div>
        <!-- Кнопка получить счет **************** -->
					<form class="text-center" action="<?=SITE?>service/callwaiter.php?id=00&msg=счет" method="POST">
						<input class="btn btn-danger btn-lg menu-button" type="submit" name="callwaiter" value="Счет">
					</form>
      </div>

      <div class="text-center">
       <!-- Кнопка оставить отзыв **************** -->
					<a class="a-button" href="<?=SITE?>service/review.php">Отзыв</a>
      </div>

    </div>

 </div>

            <div class="modal-footer-full-width  modal-footer">
                <button type="button" class="btn btn-dark btn-md btn-rounded" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>