<div class="login_page">
    <div class="login_box">

        <form action="/dang-nhap.html" method="post" id="login_form">
            <div class="top_b"> Nhà thiếu nhi quận 4</div>
            <!--<div class="alert alert-info alert-login">-->
            <!--Clear username and password field to see validation.-->
            <!--</div>-->
            <div class="cnt_b">
                <p style="color: #ff0712"><?php if (isset($error)) echo $error;?></p>
                <div class="formRow">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-user"></i></span><input type="text" id="username"
                                                                                    name="username"
                                                                                    placeholder="Tên đăng nhập"/>
                    </div>
                </div>
                <div class="formRow">
                    <div class="input-prepend">
                        <span class="add-on"><i class="icon-lock"></i></span><input type="password" id="password"
                                                                                    name="password"
                                                                                    placeholder="Mật khẩu"/>
                    </div>
                </div>
                <!--<div class="formRow clearfix">-->
                <!--<label class="checkbox"><input type="checkbox" /> Remember me</label>-->
                <!--</div>-->
            </div>
            <div class="btm_b clearfix">
                <button class="btn btn-inverse pull-right" type="submit" id="ntnlogin">Đăng nhập</button>
                <!--<span class="link_reg"><a href="#reg_form">Not registered? Sign up here</a></span>-->
            </div>
        </form>
    </div>
</div>