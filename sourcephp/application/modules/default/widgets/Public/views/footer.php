<div id="overlay" class="web_dialog_overlay"></div>
<div id="dialog" align="center" class="web_dialog">
    <img src="<?php echo $this->getView()->app->static->frontend->images; ?>/loading-2.gif"/>
    
</div>
<section id="group">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="totop">
    <a href="#">LÊN ĐẦU TRANG <i class="arrowtop"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if(!empty($site) && $site == 'pc'){ ?>
<div id="listfooter">
    <div class="container">
        <div class="row">
            <div class="col-md-6 link-footer">
                <h3 class="titlepage">
                    HỖ TRỢ KHÁCH HÀNG
                </h3>
                <ul>
                    <li> <a href="/gui-yeu-cau.html<?php echo $game;?>">Gửi yêu cầu </a></li>
                    <li> <a href="/gui-gop-y.html<?php echo $game;?>">Gửi góp ý </a></li>
                    <li> <a href="/tiep-nhan-thong-tin-lua-dao.html<?php echo $game;?>">Tiếp nhận thông tin lừa đảo </a></li>
                </ul>
            </div>
            <div class="col-md-6 link-footer">
                <h3 class="titlepage">
                    DỊCH VỤ
                </h3>
                <ul>
                    <li> <a href="<?php echo $this->getView()->app->static->mobileGuide.$game ;?>">Ứng dụng hỗ trợ trên điện thoại di động </a></li>
                    <li> <a href="/thay-doi-thong-tin-tai-khoan.html<?php echo $game;?>">Thay đổi thông tin tài khoản online </a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php }?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-12 owner-footer">
                <span class="address">Đơn vị chủ quản: CÔNG TY CỔ PHẦN VNG  -  Giấy phép số: 365/GP-B</span>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="<?php echo $this->getView()->app->static->frontend->js; ?>/jquery.ui.totop.js"></script>
<script type="text/javascript" src="<?php echo $this->getView()->app->static->frontend->js; ?>/footer.js"></script>