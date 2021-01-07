<div class="add-artc text-right">
    <a class="btn btn-success" href="../../admin/addArticle">اضافة مقالة<i class="fa fa-plus"></i></a>
</div>
<div class="container text-right">
    <div class="row">            
    <?php foreach($this->article as $artc): $arrimgs = explode(',',$artc['images']); ?>            
        <div class="col-md-3 text-right full-article">            
            <div class="artc-parent">            
                <div class="all-feat">
                    <div class="artc-img text-center">
                        <img class="art-img" src="/uploads/articles/<?= empty($arrimgs[0]) ? 'default.jpg' : $arrimgs[0]?>"/>
                    </div>
                    <div class="titleADesc text-right">
                        <h4><?= $artc['title'] ?></h4>
                        <div class="actions text-right">
                            <a href="/admin/articles/?Edit&artcid=<?=$artc['id']?>" data-id="<?= $artc['id'] ?>" class="btn btn-info edit">تعديل <i class="fa fa-edit"></i></a>
                            <button data-id="<?= $artc['id'] ?>" class="btn btn-danger delete">مسح <i class="fa fa-times"></i></button>
                            <span class="pull-left date-article"><?=$artc['artcdate']?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>
