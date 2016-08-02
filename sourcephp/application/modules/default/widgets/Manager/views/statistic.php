<div id="contentwrapper">
    <div class="main_content">
        <div class="formSep">
            <div class="row-fluid">
                <h3 class="heading">Điều kiện thống kê</h3>
                <form class="form-horizontal" method="POST">
                    <fieldset>
                        <div class="span12">
                            <div class="row mb-10">
                                <div class="span5">
                                    <label class="control-label">Khoá học</label>
                                    <div class="controls">
                                        <select name="subject">
                                            <option value="0">Tất cả</option>
                                            <?php if (isset($lsSubjects)) {
                                                foreach ($lsSubjects as $subject) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $subject['id']; ?>" <?php if ($subject['id'] == $subjectId) echo 'selected="selected"'; ?> ><?php echo $subject['title']; ?></option>
                                                <?php }
                                            } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="span5">
                                    <label class="control-label">Giáo viên</label>
                                    <div class="controls">
                                        <select name="teacher">
                                            <option value="0">Tất cả</option>
                                            <?php if (isset($lsTeachers)) {
                                                foreach ($lsTeachers as $teacher) {
                                                    ?>
                                                    <option
                                                        value="<?php echo $teacher['id']; ?>" <?php if ($teacher['id'] == $teacherId) echo 'selected="selected"'; ?>><?php echo $teacher['name']; ?></option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="span2">

                                </div>
                            </div>
                            <div class="row">

                                <div class="span12">
                                    <label class="control-label">Thời gian</label>
                                    <div class="controls">
                                        <div class="row mb-margin20">
                                            <div class="span8">

                                                <div class="span2"><label class="checkbox"> <input type="radio"
                                                                                                   name="timeThongke">
                                                        Tháng

                                                    </label></div>
                                                <div class="span2">
                                                    <input type="text" id="thongkethang" class="width_number100"
                                                           placeholder="mm/yyyy"/></div>

                                            </div>
                                        </div>
                                        <div class="row mb-margin20">
                                            <div class="span8">
                                                <div class="span2">
                                                    <label class="checkbox"> <input type="radio" name="timeThongke"> Năm


                                                    </label></div>
                                                <div class="span2"><input type="text" class="width_number100"
                                                                          id="thongkenam" placeholder="yyyy"/></div>
                                            </div>
                                        </div>
                                        <div class="row mb-margin20">
                                            <div class="span8">
                                                <div class="span2"><label class="checkbox"> <input type="radio"
                                                                                                   name="timeThongke">
                                                        Tuỳ
                                                        chỉnh

                                                    </label></div>
                                                <div class="span2">
                                                    <input type="text" id="thongketuychinhtu" class="width_number100"
                                                           placeholder="dd/mm/yyyy"/>
                                                </div>
                                                <div class="span4">
                                                    <input type="text" id="thongketuychinhden" class="width_number100"
                                                           placeholder="dd/mm/yyyy"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-10">
                                <div class="span5">
                                    <label class="control-label">Nhân viên tạo</label>
                                    <div class="controls">
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="span5">
                                    <label class="control-label">Xuất dữ liệu </label>
                                    <div class="controls">
                                        <select id="typeshowdata" name="typeshowdata">
                                            <optialue="0">Vui lòng chọn</option>
                                            <option value="1" <?php if ($typeShowData == 1) echo 'selected="selected"'; ?>>Lương giáo viên</option>
                                            <option value="2" <?php if ($typeShowData == 2) echo 'selected="selected"'; ?>>Tổng số hoá đơn</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="span12">
                                    <div class="controls">
                                        <div class="span2">
                                            <button type="submit" class="btn btn-info">Thống kê</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <?php if (isset($lsData)) {
                    if ($typeShowData == 1) { ?>
                        <div class="row-fluid sepH_c">
                            <div class="span12">
                                <div class="btn-group sepH_b">
                                    <a href="#" style="float: right;">In dữ liệu</a>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Họ và tên</th>
                                        <th>Địa chỉ</th>
                                        <th>Bộ môn</th>
                                        <th>Số học sinh</th>
                                        <th>Số thu</th>
                                        <th>Tỉ lệ chia GV</th>
                                        <th>Số chi Giáo viên</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($lsData as $data) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $data['name']; ?></td>
                                            <td><?php echo $data['address']; ?></td>
                                            <td><?php echo $data['title']; ?></td>
                                            <td><?php if (isset($data['stu']) && !empty($data['stu'])) {
                                                    $dataStu = explode(",", $data['stu']);
                                                    $j = 1;
                                                    $totalStu = count($dataStu);
                                                    foreach ($dataStu as $stu) {
                                                        if ($j == $totalStu && $j > 1)
                                                            echo '<br />';
                                                        echo $stu;
                                                        $j++;
                                                    }
                                                } ?> </td>
                                            <td><?php if (isset($data['money']) && !empty($data['money'])) {
                                                    $dataStu = explode(",", $data['money']);
                                                    $j = 1;
                                                    $totalStu = count($dataStu);
                                                    foreach ($dataStu as $stu) {
                                                        if ($j == $totalStu && $j > 1)
                                                            echo '<br />';
                                                        echo $stu;
                                                        $j++;
                                                    }
                                                } ?> </td>
                                            <td><?php if (isset($data['money_percent_for_teacher']) && !empty($data['money_percent_for_teacher'])) {
                                                    $dataStu = explode(",", $data['money_percent_for_teacher']);
                                                    $j = 1;
                                                    $totalStu = count($dataStu);
                                                    foreach ($dataStu as $stu) {
                                                        if ($j == $totalStu && $j > 1)
                                                            echo '<br />';
                                                        echo $stu;
                                                        $j++;
                                                    }
                                                } ?> </td>
                                            <td><?php if (isset($data['money_of_teacher']) && !empty($data['money_of_teacher'])) {
                                                    $dataStu = explode(",", $data['money_of_teacher']);
                                                    $j = 1;
                                                    $totalStu = count($dataStu);
                                                    foreach ($dataStu as $stu) {
                                                        if ($j == $totalStu && $j > 1)
                                                            echo '<br />';
                                                        echo $stu;
                                                        $j++;
                                                    }
                                                } ?> </td>
                                            <td></td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                    } else if ($typeShowData == 2) {
                        ?>
                        <div class="row-fluid sepH_c">
                            <div class="span12">
                                <div class="btn-group sepH_b">
                                    <a href="#" style="float: right;">In dữ liệu</a>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                      <th>Từ số</th>
                                        <th>Đến số</th>
                                        <th>Tổng số</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><?php echo $lsData[0]?></td>
                                            <td><?php echo $lsData[1]?></td>
                                            <td><?php echo $lsData[2]?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>
    </div>
