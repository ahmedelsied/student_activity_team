<section class="all-articles custom-font text-center">
    <div class="container">
        <?php if(!empty($this->artcs)): ?>
        <h2 class="h1 main-color font-weight-bold">جميع النشاطات</h2>
        <?php foreach($this->artcs as $artc): $arrimgs = explode(',',$artc['images']); ?>
        <div class="row">
            <div class="col-md-4">
                <div class="art-box">
                    <div class="img-parent text-center">
                        <img src="/uploads/articles/<?=empty($arrimgs[0]) ? 'default.jpg' :$arrimgs[0] ?>" alt="article"/>
                        <span class="spn-one"></span>
                        <span class="spn-two"></span>
                        <span class="spn-three"></span>
                        <span class="spn-four"></span>
                        <a href="../../articles/read/<?= $artc['id'] ?>" class="custom-font main-color"><?=$artc['title']?></a>
                    </div>
                    <div class="info">
                        <div class="action-parent text-right">
                            <h4 class="custom-font main-color"><?= $artc['title'] ?></h4>
                            <a class="btn knowmore" href="../../articles/read/<?= $artc['id'] ?>">اعرف المزيد</a>
                            <span class="pull-left date">تم النشر في:<?=$artc['artcdate']?></span>
                        </div>
                    </div>
                </div>
            </div>   
        <?php endforeach; ?>
        </div>
        <?php else: ?>
            <h2 class="h1 main-color font-weight-bold">لا يوجد أي نشاطات بعد</h2>
        <?php endif; ?>
    </div>
</section>