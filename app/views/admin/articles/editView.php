<div class="container">
<form class="edit-article-form" method="post" enctype="multipart/form-data">
    <div>
        <select name="catg" class="form-control text-right" required="required">
            <?php foreach($this->catgs as $catg): ?>
            <option <?=$catg['id'] == $this->catg_id[0]['cat_id'] ? 'selected' : '' ?> value="<?=$catg['id']?>"><?=$catg['name']?></option>
            <?php endforeach; ?>    
        </select>
    </div>
    <div class="title-parent">
        <input value="<?=$this->article[0]['title']?>" name="title" class="form-control text-right" type="text" placeholder="العنوان" required="required"/>
    </div>
    <div class="details-parent">
        <textarea name="details" class="form-control text-right details" placeholder="التفاصيل" required="required"><?=$this->article[0]['details']?></textarea>
    </div>
    <div class="images-article">
        <span class="custom-input btn btn-primary"><i class="fa fa-plus"></i>اضافة صور</span>
        <input class="images" type="file" name="images[]" multiple="multiple" accept="image/*"/>
    </div>
    <button data-artc-id="<?=$_GET['artcid']?>" class="btn btn-success pull-right edit-article" type="submit">تعديل<i class="fa fa-edit"></i></button>
</form>
<?php if(!empty($this->article[0]['images'])): ?>
    <div class="row" style="margin-top:80px;margin-bottom:40px;background-color:#eaeaea">
    <h2 class="text-center">الصور في هذه المقاله</h2>
    <?php $artcImages = explode(',',$this->article[0]['images']);
    foreach($artcImages as $img): ?>
        <div class="col-md-3 text-right full-article">
            <div class="artc-parent">
                <div class="all-feat">
                    <div class="artc-img">
                        <img class="art-img" src="/uploads/articles/<?=$img?>" alt="article Image"/>
                    </div>
                    <div class="titleADesc text-right">
                        <div class="actions text-right">
                            <button data-artc-id="<?=$_GET['artcid']?>" data-id="<?= $img ?>" class="btn btn-danger delete-img">مسح 
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php endforeach ?>
    </div>  
</div>              
    <form class="delete-img" method="POST">
        <input type="hidden" value="<?=$this->article[0]['images']?>"/>
    </form>
    <?php else: ?> 
        <div class="alert alert-warning text-center" style="margin-top:70px">لا يوجد صور</div>
    <?php endif;?>
</div>