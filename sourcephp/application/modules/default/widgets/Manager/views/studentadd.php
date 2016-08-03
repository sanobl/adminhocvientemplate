<div id="contentwrapper">
    <div class="main_content">
        <div class="row-fluid">
            <div class="span12">

                <h3 class="heading">Thêm học viên</h3>

                <div class="row-fluid sepH_c">
                    <div class="span12">
                        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                            <fieldset>

                                <div class="span6 boder-right">

                                    <div class="span12">
                                        <h4> Thông tin học viên</h4>

                                        <div class="control-group">
                                            <label class="control-label">Họ và tên</label>

                                            <div class="controls">
                                                <input value="<?php
                                                if(isset($student_fullname) && $student_fullname != '')
                                                    echo $student_fullname;
                                                ?>" name="student_fullname" type="text" class="span10">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label  class="control-label">Số điện thoại</label>

                                            <div class="controls">
                                                <input name="student_phone" value="<?php
                                                if(isset($student_phone) && $student_phone != '')
                                                    echo $student_phone;
                                                ?>" type="text" class="span10">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email</label>

                                            <div class="controls">
                                                <input value="<?php
                                                if(isset($student_email) && $student_email != '')
                                                    echo $student_email;
                                                ?>" name="student_email" type="text" class="span10">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="span6">

                                    <div class="span12">
                                        <h4>Thông tin phụ huynh</h4>

                                        <div class="control-group">
                                            <label class="control-label">Họ và tên</label>

                                            <div class="controls">
                                                <input value="<?php
                                                if(isset($parent_fullname) && $parent_fullname != '')
                                                    echo $parent_fullname;
                                                ?>" name="parent_fullname" type="text" class="span10">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Số điện thoại </label>

                                            <div class="controls">
                                                <input value="<?php
                                                if(isset($parent_phone) && $parent_phone != '')
                                                    echo $parent_phone;
                                                ?>" name="parent_phone" type="text" class="span10">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email</label>

                                            <div class="controls">
                                                <input value="<?php
                                                if(isset($parent_email) && $parent_email != '')
                                                    echo $parent_email;
                                                ?>" name="parent_email" type="text" class="span10">
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="clearfix"></div>
                                <hr>
                                <h4 class="title-form"> Thông tin khóa học</h4>

                                <div class="control-group">
                                    <label class="control-label">Chọn khóa học</label>

                                    <div class="controls">
                                        <select id="khoahoc" name="subject_id">
                                            <option>Vui lòng </option>
                                            <?php if(isset($listsubjects) && is_array($listsubjects) ) {
                                                for($i=0;$i < count($listsubjects); $i++){
                                                    $selected = '';
                                                    if(isset($subject_id) && $subject_id != ''){
                                                        if($listsubjects[$i]["id"] == $subject_id){
                                                            $selected = 'selected';
                                                        }
                                                    }
                                                    echo '<option value="'.$listsubjects[$i]["id"].'" '.$selected.'>'.$listsubjects[$i]['title'].'</option>';
                                                }
                                            }?>
                                        </select>
                                    </div>
                                </div>
                                <div id="khoahocinfo"></div>
                                <div id="hinhthucthanhtoan"></div>
                                <!--<div class="control-group">
                                    <label class="control-label">Hình thức thanh toán</label>
                                    <div class="controls">
                                        <div class="span12">
                                            <div>
                                                <label class="checkbox inline">
                                                        <input type="radio">
                                                        Đóng 1 lần
                                                    </label>
                                            </div>
                                            <div>
                                                <label class="checkbox inline">
                                                        <input type="radio">
                                                        Theo tháng
                                                    </label>
                                            </div>
                                            <div>
                                                <label class="checkbox inline">
                                                        <input type="radio">
                                                        Theo đợt
                                                    </label>
                                                <input type="text" class="width_number" value="2" placeholder="số đợt">
                                            </div>
                                        </div>
                                    </div>
                                </div>-->


                                <div class="control-group">
                                    <div class="controls">
                                        <button class="btn btn-info" type="submit">Lưu thông tin</button>
                                        <button class="btn btn-info" type="button" id="btnPrintInfo">Lưu & In thông tin</button>
                                        <button class="btn btn-danger">Thoát</button>
                                        <input type="hidden" name="save_print" value="">
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--<a data-toggle="modal" data-backdrop="static" href="#myTasks" class="label ttip_b" title="New tasks">10 <i class="splashy-calendar_week"></i></a>-->

        <!--<div class="modal hide fade" id="myTasks">-->
            <!--<div class="modal-header">-->
                <!--<button class="close" data-dismiss="modal">×</button>-->
                <!--<h3>Thông tin hoá đơn </h3>-->
            <!--</div>-->
            <!--<div class="modal-body">-->

            <!--</div>-->
            <!--<div class="modal-footer">-->
                <!--<a href="javascript:void(0)" class="btn">In hoá đơn</a>-->
            <!--</div>-->
        <!--</div>-->
    </div>
</div>
<script>
    $(document).ready(function () {
        //* show all elements & remove preloader
        $("#khoahoc").change(function () {
            var select = $("#khoahoc option:selected").val();
            console.log(select);
            bindKhoaHoc(select);
        });
        if($("#khoahoc option").is(':selected')){
            var select = $("#khoahoc option:selected").val();
            if(select != undefined && select != ''){
                bindKhoaHoc(select);
                <?php if(isset($payment_type) && $payment_type != ''){?>
                setTimeout(function(){
                    $('input[name="payment_type"]').each(function(){
                        if($(this).val() == "<?php echo $payment_type; ?>"){
                            $(this).prop('checked',true);
                        }
                    });
                },200);
                    
                <?php } ?>
                
            }
        }
        
        $("input[name=hinhthucthanhtoan]:radio").change(function () {
            console.log(11);
        });
        $(document).on('change','input[name="payment_type"]',function(){
            console.log(this.value);
            bindHinhThucThanhToan(this.value);
        });
        $("#btnPrintInfo").click(function(){
            //window.location.href = "quanlyhocvien-view.html";
            $('input[name="save_print"]').val(1);
            $('form').submit();
        });
        
    });

    function bindKhoaHoc(select) {
//        var html = "<div class=\"control-group\"> <label class=\"control-label\">Giáo viên</label><div class=\"controls\" style=\"padding-top:5px\"> Nguyễn Khánh Bằng</div> </div>";
//        html += "<div class=\"control-group\"> <label class=\"control-label\">Thời gian học</label><div class=\"controls\" style=\"padding-top:5px\"> Hai, Tư, Sáu (19h30-21h30)</div>  </div>";
//        html += "<div class=\"control-group\"> <label class=\"control-label\">Số tiền/khoá(VNĐ)</label><div class=\"controls\" style=\"padding-top:5px\"> 500.000 VND</div> </div>";
//        html += "<div class=\"control-group\"> <label class=\"control-label\">Hình thức thanh toán</label>";
//        html += " <div class=\"controls\"> <div class=\"span12\">";
//        html += '<label class=\"checkbox inline\"> \<input type=\"radio\" name="payment_type" value="1" > Đóng 1 lần </label>';
//        html += '<label class="checkbox inline">    <input type="radio" name="payment_type" value="2">  Theo tháng  </label>';
//
//        html += '<label class="checkbox inline"> <input type="radio" name="payment_type" value="3"> Theo đợt </label>  </div>  </div>  </div>';

        $("#khoahocinfo").html('');
        $("input[name=payment_type]:radio").change(function () {
            console.log(this.value);
            bindHinhThucThanhToan(this.value);
        });
        
        var dataadd = {
            id:select
        };
        $.ajax({
            url: '/Ajax/getinfocourse',
            type: 'Post',
            cache: false,
            async: true,
            data: dataadd,
            dataType: "html",
            success: function (result) {
                if (result != "") {
                    //dataresult = jQuery.parseJSON(result);
                    $("#khoahocinfo").html(result);
                }
            },
            complete: function () {
               
            }
        });
        
    }

    function bindHinhThucThanhToan(value) {
        var htmlHTTT = '';
        $("#hinhthucthanhtoan").html('');
        var id = $("#khoahoc option:selected").val();
        if(value == '2' || value == '3'){
            var dataadd = {
                id:id,
                type:value
            };
            $.ajax({
                url: '/Ajax/paymenttypedetail',
                type: 'Post',
                cache: false,
                async: true,
                data: dataadd,
                dataType: "html",
                success: function (result) {
                    if (result != "") {
                        //dataresult = jQuery.parseJSON(result);
                        $("#hinhthucthanhtoan").html(result);
                    }
                },
                complete: function () {

                }
        });
        }
        
        
        //$("#hinhthucthanhtoan").html(htmlHTTT);
    }
</script>