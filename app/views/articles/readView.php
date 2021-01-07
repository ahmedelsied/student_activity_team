<section class="all-articles text-center">
    <div class="container">
        <div class="text-right artc-body">
            <a href="../../articles/default" class="pull-left main-color"><i class="fa fa-angle-left fa-2x"></i></a>
            <h2 class="artc-title custom-font main-color"><?=$this->artcs['title']?></h2>
            <p class="artcdate-parent">تم النشر في:<span class="artcdate"><?=$this->artcs['artcdate']?></span></p>
            <div class="article-images">
                <?php $images = explode(',',$this->artcs['images']); if(!empty($images[0])): ?>
                <!--Start Catousal-->
                <div id="myslide" class="carousel slide" data-ride="carousel">
                <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <?php foreach($images as $image): ?>
                        <div class="item <?=$images[0] == $image ? 'active' : null?>">
                            <img src="/uploads/articles/<?=$image?>" alt="Pic 1">
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php if(count($images) > 1): ?>
                <!-- Controls -->
                <a class="left carousel-control" href="#myslide" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myslide" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <!--End Carousal-->
                <?php  endif; ?>
            </div>
            <?php endif; ?>
            </div>
            <hr/>
            <p class="artc-details"><?=nl2br($this->artcs['details'])?></p>
        </div>    
    </div>
</section>