<div id="contentwrapper">
    <div class="main_content">
        <div class="row-fluid">
            <div class="span12">

                <h3 class="heading">Thêm khoá học</h3>
                <div class="row-fluid sepH_c">
                    <div class="span12">
                        <form class="form-horizontal" id="myform" method="post">
                            <input type="hidden" name="id" value="<?php isset($dataget['id']) ? $dataget['id'] : 0; ?>" />
                            <fieldset>

                                <div class="control-group">
                                    <label class="control-label">Tên khoá học</label>
                                    <div class="controls">
                                        <input type="text" class="span10" name="title">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"> Mô tả khoá học</label>
                                    <div class="controls">
                                        <textarea cols="30" rows="5" class="span10" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Loại thu tiền</label>
                                    <div class="controls">
                                        <div class="span12">

                                            <label class="checkbox inline">
                                                <input type="radio" name="subject_payment_type" value="1">
                                                Thu học phí
                                            </label>
                                            <label class="checkbox inline">
                                                <input type="radio" name="subject_payment_type" value="2">
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
                                                <input type="radio" name="subject_type" value="1">
                                                Ngắn hạn
                                            </label>
                                            <label class="checkbox inline">
                                                <input type="radio" name="subject_type" value="2">
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
                                                           name="fromdate" id="fromdate"><span
                                                        class="add-on"><i class="splashy-calendar_day_up"></i></span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="span4">
                                            <div class="span6"><label class="control-label">Đến ngày</label></div>
                                            <div class="span6">
                                                <div class="input-append date" id="dp_to_start">
                                                    <input class="span8" type="text" readonly="readonly"
                                                           name="todate" id="todate"><span
                                                        class="add-on"><i class="splashy-calendar_day_up"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Thời gian học</label>
                                    <div class="controls">
                                        <div class="span12">
                                            <div class="span12">
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]" value="monday">
                                                    Thứ Hai
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]" value="tuesday">
                                                    Thứ Ba
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]" value="wednesday">
                                                    Thứ Tư
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]" value="thursday">
                                                    Thứ Năm
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]" value="friday">
                                                    Thứ Sáu
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]" value="saturday">
                                                    Thứ Bảy
                                                </label>
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="timelearning[]" value="sunday">
                                                    Chủ nhật
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Hỗ trợ học viên cũ</label>
                                    <div class="controls">
                                        <input type="checkbox" value="1" name="is_support_old_student">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="controls">
                                        <div class="span12">
                                            <input type="text" class="width_number60" placeholder="Từ giờ"
                                                   name="fromhours">
                                            <input type="text" class="width_number60" placeholder="Đến giờ"
                                                   name="tohours">
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
                                                        value="<?php echo $teacher['id']; ?>"><?php echo $teacher['name']; ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Số tiền/khoá(VNĐ)</label>
                                    <div class="controls">
                                        <input type="text" value="500000" name="money_total" id="money_total">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Tỷ lệ % chia giáo viên</label>
                                    <div class="controls">
                                        <input type="text" value="" name="money_percent_for_teacher" id="money_percent_for_teacher">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Hình thức thanh toán</label>
                                    <div class="controls">
                                        <div class="span12">
                                            <div id="payment_type_onetime">
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="payment_type"
                                                           class="hinhthucthanhtoan" value="1">
                                                    Đóng 1 lần
                                                </label>
                                            </div>
                                            <div id="payment_type_month">
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="payment_type"
                                                           class="hinhthucthanhtoan" value="2">
                                                    Theo tháng
                                                </label>
                                            </div>
                                            <div id="payment_type_phase">
                                                <label class="checkbox inline">
                                                    <input type="checkbox" name="payment_type"
                                                           class="hinhthucthanhtoan" value="3">
                                                    Theo đợt
                                                </label>
                                                <input type="text" class="width_number" value="2"
                                                       placeholder="số đợt" name="phase" id="phase">
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
                                        <input type="checkbox" value="1" name="isactive">
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
<script src="<?php echo $this->getView()->app->static->frontend->js; ?>/subject_add.js"></script>
