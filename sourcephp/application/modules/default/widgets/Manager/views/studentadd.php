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
                                                <input value="" name="student_fullname" type="text" class="span10">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label  class="control-label">Số điện thoại</label>

                                            <div class="controls">
                                                <input name="student_phone" value="" type="text" class="span10">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email</label>

                                            <div class="controls">
                                                <input value="" name="student_email" type="text" class="span10">
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
                                                <input name="parent_fullname" type="text" class="span10">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Số điện thoại </label>

                                            <div class="controls">
                                                <input name="parent_phone" type="text" class="span10">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">Email</label>

                                            <div class="controls">
                                                <input name="parent_email" type="text" class="span10">
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
                                                    echo '<option value='.$listsubjects[$i]["id"].'>'.$listsubjects[$i]['title'].'</option>';
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
        $("input[name=hinhthucthanhtoan]:radio").change(function () {
            console.log(11);
        });
        $("#btnPrintInfo").click(function(){
            window.location.href = "quanlyhocvien-view.html";
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
        $("input[name=hinhthucthanhtoan]:radio").change(function () {
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
        console.log('value:' +value);
        switch (value) {
            case '1': //
                break;
            case '2':
                    console.log('nguyen khanh ');
                htmlHTTT += '<div class="control-group"> <label class="control-label"> </label> <div class="controls">';
                htmlHTTT += ' <div class="span12">';
                htmlHTTT += '<label class="checkbox inline">  <input type="checkbox"> T1/2016Đ - 100,000 VNĐ</label>';
                htmlHTTT += '<label class="checkbox inline">  <input type="checkbox">  T2/2016 - 100,000 VNĐ</label>';
                htmlHTTT += '<label class="checkbox inline">  <input type="checkbox"> T3/2016 - 100,000 VNĐ </label>';
                htmlHTTT += '<label class="checkbox inline">  <input type="checkbox"> T4/2016 - 100,000 VNĐ</label>';
                htmlHTTT += '<label class="checkbox inline">  <input type="checkbox"> T5/2016 - 100,000 VNĐ </label>';

                htmlHTTT += '</div>';
                htmlHTTT += '</div>';

                break;
            default:
                console.log('nguyen khanh ');
                break;
        }
        console.log(htmlHTTT);
        $("#hinhthucthanhtoan").html(htmlHTTT);
    }
</script>