<div id="contentwrapper">
    <div class="main_content">
        <div class="row-fluid">
            <div class="span12">
                <h3 class="heading">Thêm khoá học</h3>
                <div class="row-fluid sepH_c">
                    <div class="span12">
                        <form class="form-horizontal" id="myform" method="post">
                            <input type="hidden" name="id"
                                   value="<?php echo isset($dataget['id']) ? $dataget['id'] : 0; ?>"/>
                            <fieldset>

                                <div class="control-group">
                                    <label class="control-label">Tên khoá học</label>
                                    <div class="controls">
                                        <input type="text" class="span10" name="title"
                                               value="<?php echo isset($dataget['title']) ? $dataget['title'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"> Mô tả khoá học</label>
                                    <div class="controls">
                                        <textarea cols="30" rows="5" class="span10"
                                                  name="description"><?php echo isset($dataget['description']) ? $dataget['description'] : ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Loại thu tiền</label>
                                    <div class="controls">
                                        <div class="span12">

                                            <label class="checkbox inline">
                                                <input type="radio" name="subject_payment_type"
                                                       value="1" <?php if ($dataget['subject_payment_type'] == 1) echo 'checked="checked"'; ?>>
                                                Thu học phí
                                            </label>
                                            <label class="checkbox inline">
                                                <input type="radio" name="subject_payment_type"
                                                       value="2" <?php if ($dataget['subject_payment_type'] == 2) echo 'checked="checked"'; ?>>
                                                Thu khác
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Loại môn học </label>
                                    <div class="controls">
                                        <div class="span12">

                                            <label class="checkbox inline">
                                                <input type="radio" name="subject_type"
                                                       value="1" <?php if ($dataget['subject_type'] == 1) echo 'checked="checked"'; ?>>
                                                Ngắn hạn
                                            </label>
                                            <label class="checkbox inline">
                                                <input type="radio" name="subject_type"
                                                       value="2" <?php if ($dataget['subject_type'] == 2) echo 'checked="checked"'; ?>>
                                                Dài hạn
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group" id="timemonhoc">
                                    <label class="control-label"> Thời gian môn học</label>
                                    <div class="controls">
                                        <div class="span4">
                                            <div class="span6"><label class="control-label">Từ ngày</label></div>
                                            <div class="span6">
                                                <div class="input-append date" id="dp_from_start">
                                                    <input class="span8" type="text" readonly="readonly"
                                                           name="fromdate" id="fromdate"
                                                           value="<?php echo isset($dataget['fromdate']) ? date("d/m/Y", strtotime($dataget['fromdate'])) : ''; ?>"><span
                                                        class="add-on"><i class="splashy-calendar_day_up"></i></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="span4">
                                            <div class="span6"><label class="control-label">Đến ngày</label></div>
                                            <div class="span6">
                                                <div class="input-append date" id="dp_to_start">
                                                    <input class="span8" type="text" readonly="readonly"
                                                           name="todate" id="todate"
                                                           value="<?php echo isset($dataget['todate']) ? date("d/m/Y", strtotime($dataget['todate'])) : ''; ?>"><span
                                                        class="add-on"><i class="splashy-calendar_day_up"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Thời gian học</label>
                                    <?php
                                    $lsTime = array();
                                    if (isset($dataget['timelearning'])) {

                                        $lsTime = explode(',', $dataget['timelearning']);
                                    } ?>
                                    <div class="controls">
                                        <div class="span12">
                                            <div class="span12">
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]"
                                                           value="monday" <?php if (in_array('monday', $lsTime)) echo 'checked="checked"'; ?> >
                                                    Thứ Hai
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]"
                                                           value="tuesday" <?php if (in_array('tuesday', $lsTime)) echo 'checked="checked"'; ?>>
                                                    Thứ Ba
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]"
                                                           value="wednesday" <?php if (in_array('wednesday', $lsTime)) echo 'checked="checked"'; ?>>
                                                    Thứ Tư
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]"
                                                           value="thursday" <?php if (in_array('thursday', $lsTime)) echo 'checked="checked"'; ?>>
                                                    Thứ Năm
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]"
                                                           value="friday" <?php if (in_array('friday', $lsTime)) echo 'checked="checked"'; ?>>
                                                    Thứ Sáu
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]"
                                                           value="saturday" <?php if (in_array('saturday', $lsTime)) echo 'checked="checked"'; ?>>
                                                    Thứ Bảy
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]"
                                                           value="sunday" <?php if (in_array('sunday', $lsTime)) echo 'checked="checked"'; ?>>
                                                    Chủ nhật
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Hỗ trợ học viên cũ</label>
                                    <div class="controls">
                                        <input type="checkbox" value="1"
                                               name="is_support_old_student" <?php if ($dataget['is_support_old_student'] == 1) echo 'checked="checked"'; ?>>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="controls">
                                        <div class="span12">
                                            <input type="text" class="width_number60" placeholder="Từ giờ"
                                                   name="fromhours"
                                                   value="<?php echo isset($dataget['fromhours']) ? $dataget['fromhours'] : ''; ?>">
                                            <input type="text" class="width_number60" placeholder="Đến giờ"
                                                   name="tohours"
                                                   value="<?php echo isset($dataget['tohours']) ? $dataget['tohours'] : ''; ?>">
                                        </div>

                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Giáo viên</label>
                                    <div class="controls">
                                        <select name="teachers">
                                            <option value="0">Vui lòng chọn</option>
                                            <?php if (isset($lsTeachers)) {
                                                foreach ($lsTeachers as $teacher) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $teacher['id']; ?>" <?php if ($dataget['teacher_id'] == $teacher['id']) echo 'selected="selected"'; ?> ><?php echo $teacher['name']; ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" id="titlemoney">Số tiền/khoá(VNĐ)</label>
                                    <div class="controls">
                                        <input type="text"
                                               value="<?php echo isset($dataget['money_total']) ? $dataget['money_total'] : ''; ?>"
                                               name="money_total" id="money_total">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Tỷ lệ % chia giáo viên</label>
                                    <div class="controls">
                                        <input type="text" name="money_percent_for_teacher"
                                               id="money_percent_for_teacher"
                                               value="<?php echo isset($dataget['money_percent_for_teacher']) ? $dataget['money_percent_for_teacher'] : ''; ?>">
                                    </div>
                                </div>
                                <div class="control-group" id="hinhthucthanhtoan">
                                    <label class="control-label">Hình thức thanh toán</label>
                                    <?php
                                    $lsPaymentType = array();
                                    if (isset($dataget['payment_type'])) {
                                        $lsPaymentType = explode(',', $dataget['payment_type']);
                                    } ?>
                                    <div class="controls">
                                        <div class="span12">
                                            <div id="payment_type_onetime">
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="payment_type"
                                                           class="hinhthucthanhtoan"
                                                           value="1" <?php if (in_array('1', $lsPaymentType)) echo 'checked="checked"'; ?>>
                                                    Đóng 1 lần
                                                </label>
                                            </div>
                                            <div id="payment_type_month">
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="payment_type"
                                                           class="hinhthucthanhtoan"
                                                           value="2" <?php if (in_array('2', $lsPaymentType)) echo 'checked="checked"'; ?>>
                                                    Theo tháng
                                                </label>
                                            </div>
                                            <div id="payment_type_phase">
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="payment_type"
                                                           class="hinhthucthanhtoan"
                                                           value="3" <?php if (in_array('3', $lsPaymentType)) echo 'checked="checked"'; ?>>
                                                    Theo đợt
                                                </label>
                                                <input type="text" class="width_number" value="2"
                                                       placeholder="số đợt" name="phase" id="phase"
                                                       vocab="value="<?php echo isset($dataget['phase']) ? $dataget['phase'] : ''; ?>
                                                "">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group" id="thanhtoan1lan">

                                </div>

                                <div class="control-group" id="thanhtoanthang">

                                </div>
                                <div class="control-group" id="thanhtoandot">

                                </div>
                                <div class="control-group">
                                    <label class="control-label">Active</label>
                                    <div class="controls">
                                        <input type="checkbox" value="1"
                                               name="isactive" <?php if ($dataget['isactive'] == 1) echo 'checked="checked"'; ?>>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <div class="controls">
                                        <button class="btn btn-info" type="submit">Lưu thông tin</button>
                                        <button class="btn btn-danger">Thoát</button>
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
<script>
    $(document).ready(function () {
        $("#payment_type_onetime").css("display", "none");
        $("#payment_type_phase").css("display", "none");
        $("#timemonhoc").css("display", "none");
        <?php  if($dataget['subject_type'] == 1) {?>
        $("#timemonhoc").css("display", "block");
        <?php }else if($dataget["subject_type"] == 2) {?>
        $("#hinhthucthanhtoan").css("display", "none");
        <?php }?>
        $("input[name=subject_type]:radio").change(function () {
            if (this.value == '1') {
                $("#payment_type_onetime").css("display", "block");
                $("#payment_type_phase").css("display", "block");
                $("#timemonhoc").css("display", "block");
                $("#titlemoney").html('Số tiền/khoá(VNĐ)');
                $("#hinhthucthanhtoan").css("display", "block");
            }
            else if (this.value == '2') {
                $("#payment_type_onetime").css("display", "none");
                $("#payment_type_phase").css("display", "none");
                $("#timemonhoc").css("display", "none");
                $("#titlemoney").html('Số tiền/tháng(VNĐ)');
                $("#hinhthucthanhtoan").css("display", "none");
            }
        });
        $('.hinhthucthanhtoan').on('change', function () {
            if (this.checked) {
                switch (this.value) {
                    case '1':
                        bindOneTimeShow();
                        break;
                    case '3':
                        bindPhaseShow();
                        break;
                    case '2':
                        bindMonthShow();
                        break;
                    default:
                        break;
                }
            }
            else {
                switch (this.value) {
                    case '1':
                        bindOneTimeHide();
                        break;
                    case '3':
                        bindPhaseHide();
                        break;
                    case '2':
                        bindMonthHide();
                        break;
                    default:
                        break;
                }
            }

        });




        <?php if (in_array('2', $lsPaymentType)) {?>
        bindMonthShow();
        <?php }?>
        <?php if (in_array('1', $lsPaymentType)) {?>
        $("#payment_type_onetime").css("display", "block");
        bindOneTimeShow();
        <?php }?>
        <?php if (in_array('3', $lsPaymentType)) {?>
        $("#payment_type_phase").css("display", "block");
        bindPhaseShow();
        <?php }?>
    });
</script>
<script src="<?php echo $this->getView()->app->static->frontend->js; ?>/subject_add.js"></script>
