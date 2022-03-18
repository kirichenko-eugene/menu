<!-- Modal -->
<div class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
    <div class="modal-dialog-full-width modal-dialog momodel modal-fluid" role="document">
        <div class="modal-content-full-width modal-content ">
            <div class=" modal-header-full-width   modal-header text-center">
                <h5 class="modal-title w-100" id="exampleModalPreviewLabel">Меню</h5>
            </div>
            <div class="modal-body">

                    <div class="d-flex flex-column justify-content-center">
                <?php
                if(isset($_GET['category']) ){
                    $root = first_category();
                    $categories = root_categories($root);
                    foreach($categories as $category) { ?>
                        <div class="text-center"><a class="a-button" href="<?=SITE?>index.php?category=<?=$category['id']?>"><span><?=$category['name']?></span></a></div>
                        <?php
                    }
                }?>
            </div>

            </div>
            <div class="modal-footer-full-width  modal-footer">
                <button type="button" class="btn btn-warning btn-md btn-rounded" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>