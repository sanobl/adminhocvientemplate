<div id="contentwrapper">
    <div class="main_content">
        <div class="row-fluid">
            <div class="span12">

                <h3 class="heading">Thêm học viên</h3>

                <div class="row-fluid sepH_c">
                    <div class="span12">
                        <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                            <fieldset>
                                <?php $classfull = 'span6 boder-right';
                                if ($service == 1)
                                    $classfull = 'span12 boder-right'
                                ?>
                                <div class="<?php echo $classfull; ?>">

                                    <div class="span12">
                                        <?php if ($service == 1) { ?>
                                            <h4> Thông tin người đăng ký</h4>
                                        <?php } else { ?>
                                            <h4> Thông tin học viên </h4>
                                        <?php } ?>

                                        <div class="control-group" id="divstudent_fullname">
                                            <label class="control-label">Họ và tên<span class="f_req">*</span></label>

                                            <div class="controls">
                                                <input id="student_fullname" value="<?php
                                                if (isset($student_fullname) && $student_fullname != '')
                                                    echo $student_fullname;
                                                ?>" name="student_fullname" type="text" class="span10">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Số điện thoại</label>

                                            <div class="controls">
                                                <input name="student_phone" value="<?php
                                                if (isset($student_phone) && $student_phone != '')
                                                    echo $student_phone;
                                                ?>" type="number" class="span10">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email</label>

                                            <div class="controls">
                                                <input value="<?php
                                                if (isset($student_email) && $student_email != '')
                                                    echo $student_email;
                                                ?>" name="student_email" type="text" class="span10">
                                            </div>
                                        </div>
                                        <?php if ($service != 1) { ?>
                                        <div class="control-group">
                                            <label class="control-label">Giảm học phí</label>

                                            <div class="controls">
                                                <input type="checkbox" style="margin-top: 8px;" name="is_old_student" id="is_old_student" value="1" name="teacher_isActive">
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>

                                </div>
                                <?php if ($service != 1) { ?>
                                    <div class="span6">

                                        <div class="span12">
                                            <h4>Thông tin phụ huynh</h4>

                                            <div class="control-group">
                                                <label class="control-label">Họ và tên</label>

                                                <div class="controls">
                                                    <input value="<?php
                                                    if (isset($parent_fullname) && $parent_fullname != '')
                                                        echo $parent_fullname;
                                                    ?>" name="parent_fullname" type="text" class="span10">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Số điện thoại </label>

                                                <div class="controls">
                                                    <input value="<?php
                                                    if (isset($parent_phone) && $parent_phone != '')
                                                        echo $parent_phone;
                                                    ?>" name="parent_phone" type="number" class="span10">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Email</label>

                                                <div class="controls">
                                                    <input value="<?php
                                                    if (isset($parent_email) && $parent_email != '')
                                                        echo $parent_email;
                                                    ?>" name="parent_email" type="text" class="span10">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="clearfix"></div>
                                <hr>
                                <?php if ($service == 1) { ?>
                                    <h4 class="title-form"> Thông tin dịch vụ </h4>
                                <?php } else { ?>
                                    <h4 class="title-form"> Thông tin môn học</h4>
                                <?php } ?>

                                <div class="control-group">
                                    <?php if ($service == 1) { ?>
                                        <label class="control-label">Chọn dịch vụ<span class="f_req">*</span></label>
                                    <?php } else { ?>
                                        <label class="control-label">Chọn môn học<span class="f_req">*</span></label>
                                    <?php } ?>


                                    <div class="controls" id="divkhoahoc">
                                        <select id="khoahoc" name="subject_id">
                                            <option value="0">Vui lòng chọn</option>
                                            <?php if (isset($listsubjects) && is_array($listsubjects)) {
                                                for ($i = 0; $i < count($listsubjects); $i++) {
                                                    $selected = '';
                                                    if (isset($subject_id) && $subject_id != '') {
                                                        if ($listsubjects[$i]["id"] == $subject_id) {
                                                            $selected = 'selected';
                                                        }
                                                    }
                                                    echo '<option value="' . $listsubjects[$i]["id"] . '" ' . $selected . '>' . $listsubjects[$i]['title'] . '</option>';
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div id="khoahocinfo"></div>
                                <!--                                <div id="hinhthucthanhtoan"></div>-->
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

                                        <!--                                         <button class="btn btn-info" type="submit">Lưu thông tin</button>-->
                                        <button class="btn btn-info" type="button" id="btnPrintInfo">Lưu & In thông
                                            tin
                                        </button>
                                        <button class="btn btn-danger"  id="btnExit">Thoát</button>
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
//            console.log(select);
            bindKhoaHoc(select);
        });
        if ($("#khoahoc option").is(':selected')) {
            var select = $("#khoahoc option:selected").val();
            if (select != undefined && select != '') {
                bindKhoaHoc(select);
                <?php if(isset($payment_type) && $payment_type != ''){?>
                setTimeout(function () {
                    $('input[name="payment_type"]').each(function () {
                        if ($(this).val() == "<?php echo $payment_type; ?>") {
                            $(this).prop('checked', true);
                        }
                    });
                }, 200);

                <?php } ?>

            }
        }

        $("input[name=hinhthucthanhtoan]:radio").change(function () {
            console.log(11);
        });
        $(document).on('change', 'input[name="payment_type"]', function () {
            console.log(this.value);
            bindHinhThucThanhToan(this.value);
        });
        $("#btnPrintInfo").click(function () {
            //window.location.href = "quanlyhocvien-view.html";
            var fullname = $('#student_fullname').val();
            var khoahoc = $("#khoahoc").val();
            var isFullName = true;
            var isKhoaHoc = true;
            var isTimeLearning = true;
            if (0 == fullname.length) {
                isFullName = false;
                $('#divstudent_fullname').addClass('f_error');
                $('#student_fullname').focus();
//                console.log(1);
            }
            if (khoahoc == '0') {
                isKhoaHoc = false;
//                console.log('2' + khoahoc);
                $('#divkhoahoc').addClass('f_error');
                $('#khoahoc').focus();
//                console.log(2);
            }
            <?php if ($service != 1) {?>
            var timeLearning = $('input[name=subject_class_id]:checked', '.form-horizontal').val();

            if (typeof timeLearning === "undefined") {
                isTimeLearning = false;
                $("#TimeLearningError").css("display", "block");
            }
            else {
                $("#TimeLearningError").css("display", "none");
                isTimeLearning = true;
            }
            <?php } else { ?>
            var isTimeLearning = true;
            <?php  }?>
            if (!isFullName || !isKhoaHoc || !isTimeLearning)
                return false;
//            return false;
            $('input[name="save_print"]').val(1);
            $('form').submit();
        });

        $('#btnExit').click(function () {
            window.location.href = "/quan-ly-hoc-vien.html";

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
        var is_old_student = 0;
        if ($('#is_old_student').is(":checked")) {
            is_old_student = 1;
        }
        var dataadd = {
            id: select,
            is_old_student:<?php echo $is_old_student;?>,
            student_id: <?php echo $student_id;?>,
            service: <?php echo $service;?>,
            is_old_student: is_old_student
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
        if (value == '2' || value == '3') {
            var dataadd = {
                id: id,
                type: value
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