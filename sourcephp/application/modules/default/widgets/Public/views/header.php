<?php if (!empty($site)) { ?>
    <header id="header">
        <div class="container" style="z-index: 99999; position: relative;">
            <div id="default">
                <div class="logo visible-md visible-lg">
                    <a href="/<?php echo $game; ?>"><img src="<?php echo $this->getView()->app->static->frontend->images; ?>/logo1.png"></a>
                </div>
                <div class="navcontrol">
                    <ul id="list-menu">
                        <li class="hidden-md hidden-lg"><a href="/<?php echo $game; ?>"><span class="icon iconhome "></span></a></li>
                        <?php if ($site == 'pc') { ?>
                            <li class="hidden-md hidden-lg"><a href="/yeu-cau-da-gui.html<?php echo $game; ?>"><span class="icon iconrequest"></span></a></li>
        <!--                    <li><span class="icon infoalert"></span><span class="badge bagenumber">4</span> <span class="textinfo hidden-xs hidden-sm">Thông báo</span></li>-->
                            <li class="dropdown hidden-sm hidden-xs">
                                <?php if (!$userInfo) { ?>
                                    <a id="zme-loginwg" href="javascript:void(0);" data-target="#" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="false">
                                        <span class="icon infoaccount"></span><span class="textinfo hidden-xs hidden-sm">Đăng nhập</span><i class="arrowdow hidden-xs hidden-sm"></i>
                                    </a>
                                <?php } else { ?>
                                    <a id="profile" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="false">
                                        <span class="icon infoaccount"></span><span class="textinfo hidden-xs hidden-sm"><?php echo $userInfo['acn']; ?></span><i class="arrowdow hidden-xs hidden-sm"></i>
                                    </a>

                                    <ul class="dropdown-menu" role="menu" aria-labelledby="profile">
                                        <li><a href="/thong-tin-lien-he.html<?php echo $game; ?>">Thông tin liên hệ</a></li>
                                        <li><a href="<?php echo $this->getView()->app->static->ssologout . $this->getView()->app->static->site->site_url . $game; ?>">Thoát</a></li>
                                    </ul>
                                <?php } ?>
                            </li>                                     
                            <li class="hidden-md hidden-lg"><a href="/gui-gop-y.html<?php echo $game; ?>"><span class="icon iconfeedback"></span></a></li>
                        <?php } else if ($site == 'mobile') { ?>
                            <li class="hidden-md hidden-lg"><a href="/yeu-cau-da-gui.html<?php echo $game; ?>"><span class="icon iconrequest"></span></a></li>
                            <li class="hidden-md hidden-lg"><a href="/gui-gop-y.html<?php echo $game; ?>"><span class="icon iconfeedback"></span></a></li>
                            <li  class="dropdown hidden-sm hidden-xs" id="link-login">
                                <?php if (!$userInfo) { ?>
                                    <a onclick="logInWithFacebook()" id="btn-login-fb">
                                        <span class="icon infoaccount"></span><span class="textinfo hidden-xs hidden-sm" >Đăng nhập</span><i class="arrowdow hidden-xs hidden-sm"></i>
                                    </a>
                                <?php } else { ?>
                                    <a id="profile" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="false">
                                        <i class="fa fa-facebook-square fa-2x" style="font-size: 23px; margin-right:5px;"></i><span class="textinfo hidden-xs hidden-sm"><?php echo $userInfo['name'] ?></span><i class="arrowdow hidden-xs hidden-sm"></i>
                                    </a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="profile">
                                        <li><a href="javascript:void(0);" onclick="logout(0);">Thoát</a></li>
                                    </ul>
                                <?php } ?>
                            </li>    


                        <?php } ?>
                        <li class="sclick"><span class="icon infosearch"></span><span class="textinfo hidden-xs hidden-sm">Tìm kiếm</span></li>
                        <?php
                        if ($site == 'pc') {
                            echo '<li class="hidden-sm hidden-xs"><a href="/?game=mobile"><span class="icon iconmobile"></span><span class="textinfo hidden-xs hidden-sm">Sản phẩm trên Mobile</span></a></li>';
                        } else {
                            echo '<li class="hidden-sm hidden-xs"><a href="/?game=pc"><span class="icon iconpc"></span><span class="textinfo hidden-xs hidden-sm">Sản phẩm trên PC</span></a></li>';
                        }
                        ?>
                        <li class="hidden-md hidden-lg dropdown">
                            <a data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"  aria-expanded="true" id="slidebar"><span class="icon infobar"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right menu-link" role="menu" aria-labelledby="slidebar">

                                <?php
                                if ($site == 'pc') {
                                    if ($userInfo) {
                                        ?>
                                        <li>
                                            <a href="/thong-tin-lien-he.html<?php echo $game; ?>"><span class="icon icon-hot-login"></span><span class="link-mobile">THÔNG TIN LIÊN HỆ</span></a>
                                        </li>
        <?php } ?>
                                    <li>
                                        <a href="/danh-sach-tin-tuc.html<?php echo $game; ?>"><span class="icon icon-hot-news"></span><span class="link-mobile">TIN NỔI BẬT</span></a>
                                    </li>

                                    <li>
                                        <a href="/tin-tuc/cac-kenh-ho-tro_0_0_0_14.html<?php echo $game; ?>"><span class="icon icon-hot-contact"></span><span class="link-mobile">LIÊN HỆ</span></a>
                                    </li>
    <?php } else { ?>
                                    <li>
                                        <a href="/danh-sach-tin-tuc.html<?php echo $game; ?>"><span class="icon icon-hot-news"></span><span class="link-mobile">TIN NỔI BẬT</span></a>
                                    </li>
                                    <li>
                                        <a href="/tin-tuc/lien-he_156_0_0_160.html<?php echo $game; ?>"><span class="icon icon-hot-contact"></span><span class="link-mobile">LIÊN HỆ</span></a>
                                    </li>
                                <?php } ?>

                                <?php
                                if ($site == 'pc') {
                                    if (!$userInfo) {
                                        ?>
                                        <li>
                                            <a id="zme-loginwg" href="javascript:void(0);"><span class="icon icon-hot-login"></span><span class="link-mobile">ĐĂNG NHẬP</span></a>
                                        </li>
        <?php } else { ?>
                                        <li>
                                            <a href="<?php echo $this->getView()->app->static->ssologout . $this->getView()->app->static->site->site_url . $game; ?>"><span class="icon icon-hot-logout"></span><span class="link-mobile">THOÁT</span></a>
                                        </li>                           
                                    <?php
                                    }
                                } else {
                                    if (!$userInfo) {
                                        ?>
                                        <li>
                                            <a onclick="logInWithFacebook()" id="btn-login-fb">
                                                <span class="icon icon-hot-login"></span><span class="link-mobile">ĐĂNG NHẬP</span>
                                            </a>
                                        </li>
                                    <?php } else { ?>
                                        <li><a href="javascript:void(0);" onclick="logout(0);"><span class="icon icon-hot-logout"></span><span class="link-mobile">THOÁT</span></a></li>
        <?php }
    }
    ?>
                                <li class="divider">

                                </li>
                                <?php
                                if ($site == 'pc') {
                                    echo '<li>
                                        <a href="/?game=mobile"><span class="icon icon-hot-mobile"></span><span class="link-mobile">SẢN PHẨM TRÊN MOBILE</span></a>
                                    </li>';
                                } else {
                                    echo '<li>
                                        <a href="/?game=pc"><span class="icon icon-hot-pc"></span><span class="link-mobile">SẢN PHẨM TRÊN PC</span></a>
                                    </li>';
                                }
                                ?>

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div id="search">
                <div>
                    <i class="iconsearch" style="cursor: pointer"></i>
                    <input id="searchInput" type="text" placeholder="Tìm kiếm các hướng dẫn, hỗ trợ, tin tức" class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <i class="iconsearchclose"></i>
                </div>
            </div>

        </div>
        <!--<div class="tet-2016">
             <img style="float: left;" src="<?php echo $this->getView()->app->static->frontend->images; ?>/hoamai.png" class="img-responsive">           
        </div>-->
    </header>
    <nav class="navbar navbar-default hidden-sm hidden-xs" id="nav">
        <div class="container">
            <div class="navbar-header" id="menu">
                <ul class="mainmenu">
                        <?php if ($site == 'pc' || $site == 'mobile') { ?><li <?php
                    if ($this->getRequest()->getParam('title') == 'yeu-cau-da-gui' || $this->getRequest()->getParam('title') == 'gui-yeu-cau' || $this->getRequest()->getParam('title') == 'chi-tiet-yeu-cau')
                        echo 'class="active"';
                    ?>>
                            <a href="/yeu-cau-da-gui.html<?php echo $game; ?>"><span class="icon iconrequest"></span><span class="hidden-xs hidden-sm">YÊU CẦU HỖ TRỢ</span></a>
                        </li><?php } ?>
                    <li <?php
                        if ($this->getRequest()->getParam('title') == 'tin-tuc' || $this->getRequest()->getParam('title') == 'danh-sach-tin-tuc')
                            echo 'class="active"';
                        ?>><a href="/danh-sach-tin-tuc.html<?php echo $game; ?>"><span class="icon iconhotnews"></span><span class="hidden-xs hidden-sm">TIN NỔI BẬT</span></a></li>
                    <li <?php
						if ($this->getRequest()->getParam('title') == 'gui-gop-y' || $this->getRequest()->getParam('title') == 'gop-y-da-gui' || $this->getRequest()->getParam('title') == 'chi-tiet-gop-y')
							echo 'class="active"';
						?>><a href="/gui-gop-y.html<?php echo $game; ?>"><span class="icon iconfeedback"></span><span class="hidden-xs hidden-sm">GÓP Ý</span></a></li>
					<?php if ($site == 'pc') { ?>
					<li <?php if ($this->getRequest()->getParam('title') == 'lien-he') echo 'class="active"'; ?>><a href="/tin-tuc/cac-kenh-ho-tro_0_0_0_14.html<?php echo $game; ?>"><span class="icon iconcontact"></span><span class="hidden-xs hidden-sm">LIÊN HỆ</span></a></li>
    <?php } else if ($site == 'mobile') { ?> 
					<li <?php if ($this->getRequest()->getParam('title') == 'lien-he') echo 'class="active"'; ?>><a href="/tin-tuc/lien-he_156_0_0_160.html<?php echo $game; ?>"><span class="icon iconcontact"></span><span class="hidden-xs hidden-sm">LIÊN HỆ</span></a></li>
    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
<?php } else { ?>
    <header id="header">
        <div class="container">
            <div id="default">
                <div class="logo logo-site">
                    <a href="/<?php echo $game; ?>"><img src="<?php echo $this->getView()->app->static->frontend->images; ?>/logo1.png"></a>
                </div>

            </div>
        </div>
    </header>
<?php } if ($site == 'mobile') { ?>
    <script type="text/javascript" src="<?php echo $this->getView()->app->static->frontend->js; ?>/fb2.js"></script>
    <script>
                                            var islogin = '<?php
    if (!$userInfo) {
        echo 1;
    } else {
        echo 0;
    }
    ?>';
    </script>
<?php } else { ?> 
    <script type="text/javascript" src="<?php echo $this->getView()->app->static->frontend->js; ?>/Config.js"></script>
    <script type="text/javascript" src="<?php echo $this->getView()->app->static->frontend->js; ?>/header.js"></script>
<?php } ?> 

