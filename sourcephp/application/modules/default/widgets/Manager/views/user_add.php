<div id="contentwrapper">
    <div class="main_content">
        <div class="row-fluid">
            <div class="span12">

                <h3 class="heading">Thêm người </h3>
                <div class="row-fluid sepH_c">
                    <div class="span12">
                        <form class="form-horizontal" id="myform" action="" method="post">
                            <fieldset>

                                <div class="control-group">
                                    <label class="control-label">Tên đăng nhập</label>
                                    <div class="controls">
                                        <input type="text" id="user_name" name="user_name"
                                            value="<?php if(isset($user) && $user != null) 
                                                echo $user["name"];?>">    
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Mật khẩu</label>
                                    <div class="controls">
                                        <input type="password" id="user_password" name="user_password"
                                            value="<?php if(isset($user) && $user != null) 
                                                echo $user["password"];?>">   
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Họ và tên </label>
                                    <div class="controls">
                                        <input type="text" id="user_fullname" name="user_fullname"
                                            value="<?php if(isset($user) && $user != null) 
                                                echo $user["full_name"];?>"> 
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email</label>
                                    <div class="controls">
                                        <input type="text" id="user_email" name="user_email"
                                            value="<?php if(isset($user) && $user != null) 
                                                echo $user["email"];?>"> 
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Số điện thoại</label>
                                    <div class="controls">
                                        <input type="text" id="user_phone" name="user_phone"
                                            value="<?php if(isset($user) && $user != null) 
                                                echo $user["phone"];?>"> 
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Admin</label>
                                    <div class="controls">
                                        <input type="checkbox" value="1" name="user_isadmin"
                                        <?php if(isset($user) && $user != null) 
                                                echo $user["isadmin"]==1?'checked="checked"':'';?>>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Delete</label>
                                    <div class="controls">
                                        <input type="checkbox" value="1" name="user_isdelete"
                                        <?php if(isset($user) && $user != null) 
                                                echo $user["isdelete"]==1?'checked="checked"':'';?>>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button class="btn btn-info" type="button" id="btnAddUser">Lưu thông tin
                                        </button>
                                        <button class="btn btn-danger" type="button" id="btnExitUser">Thoát</button>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $this->getView()->app->static->frontend->js; ?>/user_add.js"></script>