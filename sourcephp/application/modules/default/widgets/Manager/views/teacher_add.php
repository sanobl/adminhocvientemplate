<div id="contentwrapper">
    <div class="main_content">
        <div class="row-fluid">
            <div class="span12">

                <h3 class="heading">Thêm người </h3>
                <div class="row-fluid sepH_c">
                    <div class="span12">
                        <form class="form-horizontal" id="myform" action="" method="post" enctype="multipart/form-data">
                            <fieldset>
                                <?php if(isset($error) && $error != 0){ ?>
                                    <div class="control-group">
                                        <span style="color: red;"><?php if($error == -1){echo "Giáo viên đã tồn tại";}?></span>
                                    </div>
                                <?php }?>
                                <div class="control-group">
                                    <label class="control-label">Tên giáo viên</label>
                                    <div class="controls">
                                        <input type="text" id="teacher_name" name="teacher_name"
                                            value="<?php if(isset($teacher) && $teacher != null) 
                                                echo $teacher["name"];?>">                                        
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Email</label>
                                    <div class="controls">
                                        <input type="text" id="teacher_email" name="teacher_email"
                                            value="<?php if(isset($teacher) && $teacher != null) 
                                                echo $teacher["email"];?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Số điện thoại</label>
                                    <div class="controls">
                                        <input type="text" id="teacher_phone" name="teacher_phone"
                                            value="<?php if(isset($teacher) && $teacher != null) 
                                                echo $teacher["phone"];?>">
                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label class="control-label">Địa chỉ</label>
                                    <div class="controls">
                                        <input type="text" id="teacher_address" name="teacher_address"
                                            value="<?php if(isset($teacher) && $teacher != null) 
                                                echo $teacher["address"];?>">
                                    </div>
                                </div>
<!--                                <div class="control-group">-->
<!--                                    <label class="control-label">Xoá</label>-->
<!--                                    <div class="controls">-->
<!--                                        <input type="checkbox" value="1" name="teacher_isDelete"-->
<!--                                            --><?php //if(isset($teacher) && $teacher != null)
//                                                echo $teacher["isdelete"]==1?'checked="checked"':'';?><!-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="control-group">
                                    <label class="control-label">Kích hoạt</label>
                                    <div class="controls">
                                        <input type="checkbox" value="1" name="teacher_isActive"
                                            <?php if(isset($teacher) && $teacher != null) 
                                                echo $teacher["isactive"]==1?'checked="checked"':'';?>>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button class="btn btn-info" type="button" id="btnAddTeacher">Lưu thông tin
                                        </button>
                                        <button class="btn btn-danger" type="button" id="btnTeacherExit">Thoát</button>
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
<script src="<?php echo $this->getView()->app->static->frontend->js; ?>/teacher_add.js"></script>