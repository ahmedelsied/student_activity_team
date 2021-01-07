<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav"
                aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a style="margin-right:25px" href="../../admin/articles"><img src="<?=IMG?>/logo.png" alt="logo" width="50" /></a>
        </div>
        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="nav navbar-nav">
                <li class="<?=$this->articlesActive?>"><a href="../../admin/articles">المقالات</a></li>
                <li class="<?=$this->talentsActive?>"><a href="../../admin/talents">المشتركين</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <?=$this->adminUser?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a target="_blank" href="../../main">زيارة الموقع</a></li>
                        <li><a href="../../admin/logout">تسجيل الخروج</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>