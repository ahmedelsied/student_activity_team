<!--Start Catousal-->		
<div id="myslide" class="carousel slide" data-ride="carousel">
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img width="900" src="<?=IMG?>logo-caros.png" alt="Pic 1">
            <div class="carousel-caption hidden-xs">
                <h2 class="h1"></h2>
                <p class="lead"></p>
            </div>
        </div>
    </div>
</div>
<section class="latest-activities text-center">
    <div class="container">
        <h2 class="custom-font main-color">أخر النشاطات</h2>
        <div class="row">
            <?php foreach($this->artcs as $artc): $arrimgs = explode(',',$artc['images']);?>
            <div class="col-md-4">
                <div class="art-box">
                    <div class="img-parent text-center">
                        <img src="/uploads/articles/<?=empty($arrimgs[0]) ? 'default.jpg' :$arrimgs[0] ?>" alt="article"/>
                        <span class="spn-one"></span>
                        <span class="spn-two"></span>
                        <span class="spn-three"></span>
                        <span class="spn-four"></span>
                        <a href="../../articles/read/<?=$artc['id']?>" class="custom-font main-color"><?=$artc['title']?></a>
                    </div>
                    <div class="info">
                        <div class="action-parent text-right">
                            <h4 class="custom-font main-color"><?=$artc['title']?></h4>
                            <a class="btn knowmore" href="../../articles/read/<?=$artc['id']?>">اعرف المزيد</a>
                            <span class="pull-left date">تم النشر في:<?=$artc['artcdate']?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <a href="../../articles/default" class="btn all-artc-btn">تصفح النشاطات</a>
    </div>
</section>
<section class="about-us-parent text-center">
    <div class="container">
        <h2 class="custom-font about-us-heading">عن الأسره</h2>
        <div class="about-us">
            <img class="img-circle img-thumbnail" src="<?=IMG?>logo.png" alt="logo"/>
            <p class="lead about-us-p">تعد الأسر الطلابية من أهم التنظيمات داخل الجامعات المصرية، والتي تمارس أنشطة في كافة المجالات الثقافية والعلمية والرياضية، كما تعتبر منصة شرعية لتعبير الطلاب عن رأيهم، وذلك وفقا للقانون</p>
        </div>
    </div>
</section>
<section class="contact-us-parent text-center">
    <div class="keep-in-touch">
        <h2 class="custom-font main-color">كن على اتصال</h2>
        <br/>
        <form class="text-center form-contact">
            <input class="form-control" name="contact-email" type="email" placeholder="البريد الالكترني" required="required"/>
            <input class="btn btn-danger subs" type="submit" value="اشتراك"/>
        </form>
    </div>
</section>
<section class="participants text-center">
    <div class="container">
    <p class="note">للمشاركه في النشاطات يرجى ملئ الاستماره التاليه</p>
        <form class="talent-form">
            <input class="form-control" type="text" name="name" placeholder="الاسم الثلاثي" required="required"/>
            <input class="form-control" type="tel" name="phone" placeholder="رقم الهاتف" required="required"/>
            <input class="form-control" type="text" name="talent" placeholder="الموهبه" required="required"/>
            <button class="btn" type="submit">ارسال</button>
        </form>
    </div>
</section>