<section class="articlesWithCatg custom-font text-center">
    <div class="container">
        <h2 class="catg_artc_title h1 main-color font-weight-bold"></h2>
    <?php if(!empty($this->article)): ?>
        <div class="row">
        <?php foreach($this->article as $artcDetail): $getImagesArr = explode(',',$artcDetail['images']); ?>
            <div class="col-md-4">
                <div class="art-box">
                    <div class="img-parent text-center">
                        <img src="/uploads/articles/<?=empty($getImagesArr[0]) ? 'default.jpg' :$getImagesArr[0] ?>" alt="article"/>
                        <span class="spn-one"></span>
                        <span class="spn-two"></span>
                        <span class="spn-three"></span>
                        <span class="spn-four"></span>
                        <a href="../../articles/read/<?= $artcDetail['id'] ?>" class="custom-font main-color"><?=$artcDetail['title']?></a>
                    </div>
                    <div class="info">
                        <div class="action-parent text-right">
                            <h4 class="custom-font main-color"><?= $artcDetail['title'] ?></h4>
                            <a class="btn knowmore" href="../../articles/read/<?= $artcDetail['id'] ?>">اعرف المزيد</a>
                            <span class="pull-left date">تم النشر في:<?=$artcDetail['artcdate']?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
        <h2 class="h1 font-weight-bold main-color">لا يوجد نشاطات هنا بعد</h2>
    <?php endif; ?>
    </div>
</section>