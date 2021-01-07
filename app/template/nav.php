<nav class="navbar navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav"
                    aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="logo" href="../../main">
                    <img width="110" class="logo-img" src="<?=IMG?>/logo.png" alt="logo" />
                </a>
            </div>
            <div class="collapse navbar-collapse" id="app-nav">
                <ul class="nav navbar-nav navbar-right">
                <?php foreach ($this->catgs as $catg): ?>
                    <li>
                        <a <?php if($catg['id'] == $this->activeCatg){$this->title=$catg['name']; echo 'class="main-color"';} ?> href="../../catgs/default/<?=$catg['id']?>"><?=$catg['name']?></a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="lds-ring">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <a href="http://alzarka.com/" target="_blank" style="position:fixed;left:0;top:50%;z-index:9;border-radius:50%;">
        <img class="img-circle" src="<?=IMG?>/inslogo.png" alt="inslogo"/>
    </a>
    <button class="scroll-to-top"><i class="fa fa-angle-double-up"></i></button>
