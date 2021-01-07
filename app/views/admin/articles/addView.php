<div class="container">
    <form class="add-article" method="post" action="" enctype="multipart/form-data">
        <div>
            <select name="catg" class="form-control text-right" required="required">
                <option value="0" selected>اختر النشاط</option>
                <?php foreach($this->catgs as $catg):?>
                <option value="<?=$catg['id']?>"><?=$catg['name']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="title-parent">
            <input name="title" class="form-control text-right" type="text" placeholder="العنوان" required="required"/>
        </div>
        <div class="details-parent">
            <textarea name="details" class="form-control text-right details" placeholder="التفاصيل" required="required"></textarea>
        </div>
        <div class="images-article">
            <span class="custom-input btn btn-primary"><i class="fa fa-plus"></i>اضافة صور</span>
            <input class="images" type="file" name="images[]" multiple="multiple" accept="image/*"/>
        </div>
        <button class="btn btn-success pull-right" type="submit">اضافة<i class="fa fa-plus"></i></button>
    </form>
</div>