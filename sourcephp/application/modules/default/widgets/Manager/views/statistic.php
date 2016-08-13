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
                                            <optialue
                                            ="0">Vui lòng chọn</option>
                                            <option
                                                value="1" <?php if ($typeShowData == 1) echo 'selected="selected"'; ?>>
                                                Lương giáo viên
                                            </option>
                                            <option
                                                value="2" <?php if ($typeShowData == 2) echo 'selected="selected"'; ?>>
                                                Tổng số hoá đơn
                                            </option>

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
                                    <a href="#" onclick="exportExcel()" style="float: right;">Xuất excel</a>
                                    <a href="#" onclick="btn_print_action()" style="float: right;">In dữ liệu</a>
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
                                            <td>
                                                <?php if (isset($data['totalstudent']) && !empty($data['totalstudent'])) {
                                                    $dataStu = explode(",", $data['totalstudent']);
                                                    $j = 1;
                                                    $totalStu = count($dataStu);
                                                    foreach ($dataStu as $stu) {
                                                        if ($j == $totalStu && $j > 1)
                                                            echo '<br />';
                                                        echo $stu;
                                                        $j++;
                                                    }
                                                    ?>
                                                    <?php
                                                } ?>
                                            </td>
                                            <td><?php if (isset($data['totalmoney'])) {
                                                    $dataStu = explode(",", $data['totalmoney']);
                                                    $j = 1;
                                                    $totalStu = count($dataStu);
                                                    foreach ($dataStu as $stu) {
                                                        if ($j == $totalStu && $j > 1)
                                                            echo '<br />';
                                                        echo $stu;
                                                        $j++;
                                                    }
                                                } ?> </td>
                                            <td><?php if (isset($data['money_percent_for_teacher'])) {
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
                                            <td><?php if (isset($data['totalmoneyteacher'])) {
                                                    $dataStu = explode(",", $data['totalmoneyteacher']);
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
                                        $i++;
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
                                    <a href="#" style="at: right;">In dữ liệu</a>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Loại hoá đơn</th>
                                        <th>Từ số</th>
                                        <th>Đến số</th>
                                        <th>Tổng số</th>
                                        <!--                                        <th></th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($lsData as $item) {
                                        if ($item['isservice'] >= '0') {
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php if ($item['isservice'] == '0') echo 'Học phí'; else if ($item['isservice'] == '1') echo 'Dịch vụ'; ?></td>
                                                <td><?php echo $item['minbill'] ?></td>
                                                <td><?php echo $item['maxbill'] ?></td>
                                                <td><?php echo number_format($item['total'], 0, '.', '.') ?></td>
                                            </tr>
                                            <?php $i++;
                                        }
                                    } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>
        <div class="modal hide fade" id="bienlailuonggiaovien" style="width: 29cm; left:32%;">
            <style>
                /*body {*/
                /*background: rgb(204,204,204);*/
                /*font-family: Arial, Helvetica, sans-serif;*/
                /*font-size: 11px;*/
                /*}*/
                table.print_table {
                    border: 1px solid #000;
                    width: 100%;
                    max-width: 100%;
                    border-spacing: 0;
                    border-collapse: collapse;
                }

                table.print_table > thead > tr > th, table.print_table > tbody > tr > td, table > tfoot > tr > td {
                    border: 1px solid #000;
                    line-height: 1.42857143;
                    padding: 8px;
                }

                table.print_table > tbody > tr > td, table.print_table > tfoot > tr > td {
                    border-top: 1px solid #000;
                }

                page {
                    background: white;
                    display: block;
                    margin: 0 auto;
                    margin-bottom: 0.5cm;

                }

                page[size="A4"] {
                    width: 21cm;
                    height: 29.7cm;
                }

                page[size="A4"][layout="portrait"] {
                    width: 27.9cm;
                    height: 21cm;
                }

                page[size="A3"] {
                    width: 29.7cm;
                    height: 42cm;
                }

                page[size="A3"][layout="portrait"] {
                    width: 42cm;
                    height: 29.7cm;
                }

                page[size="A5"] {
                    width: 14.8cm;
                    height: 21cm;
                }

                page[size="A5"][layout="portrait"] {
                    width: 21cm;
                    height: 14.8cm;
                }

                @media print {
                    body, page {
                        margin: 0;
                        box-shadow: 0;
                        font-family: Arial, Helvetica, sans-serif;
                        font-size: 11px;
                    }
                    body * {
                            visibility: hidden;
                        }

                    page * {
                        visibility: visible;
                    }

                    page {
                        position: absolute;
                        left: 0;
                        top: 0;
                        font-family: Arial, Helvetica, sans-serif;
                        font-size: 16px;
                    }
                }
            </style>
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h3>Thông tin hoá đơn </h3>
            </div>
            <div class="modal-body">

                <style>
                    #bienlaithutien2 {
                        font-size: 14px;
                    }

                </style>

                <page size="A4" layout="portrait">
                    <div
                        style="width: 50%; float: left; display: inline-block; line-height: 21px; text-align: center; font-size: 1.3em;">
                        <span>ỦY BAN NHÂN DâN QUẬN 4</span></br>
                        <b>Nhà Thiếu Nhi</b>

                    </div>
                    <div style="width: 50%; text-align: center;float: left;line-height: 21px;font-size: 1.3em;">
                        <span><b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b></span><br>
                        <i>Độc lập - Tự do - Hạnh phúc</i>
                    </div>
                    <br style="clear: both">
                    <br style="clear: both">
                    <br style="clear: both">
                    <div style="width:100%; text-align: center">
                        <h1>DANH SÁCH GIÁO VIÊN NHẬN LƯƠNG DẠY LỚP NĂNG KHIẾU THÁNG 5 NĂM 2016</h1>
                    </div>
                    <br style="clear: both">
                    <br style="clear: both">
                    <table style="width: 100%;" class="print_table">
                        <thead>
                        <tr style="text-align: center">
                            <th style="width: 20px">Stt</th>
                            <th style="width: 150px">Họ tên</th>
                            <th style="width: 180px">Địa chỉ</th>
                            <th>Bộ môn</th>
                            <th>Số<br>Hsinh</th>
                            <th>Số thu</th>
                            <th style="width: 50px">Tỉ lệ<br>chi GV</th>
                            <th>Số chi <br> Giáo viên</th>
                            <th style="width: 125px">Ký nhận</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Khánh Bằng</td>
                            <td>182 Lê Đại Hành, P 15. Q11</td>
                            <td>Deverloper</td>
                            <td>7</td>
                            <td>25.000.000</td>
                            <td>100%</td>
                            <td>25.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Khánh Bằng</td>
                            <td>182 Lê Đại Hành, P 15. Q11</td>
                            <td>Deverloper</td>
                            <td>7</td>
                            <td>25.000.000</td>
                            <td>100%</td>
                            <td>25.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Khánh Bằng</td>
                            <td>182 Lê Đại Hành, P 15. Q11</td>
                            <td>Deverloper</td>
                            <td>7</td>
                            <td>25.000.000</td>
                            <td>100%</td>
                            <td>25.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Khánh Bằng</td>
                            <td>182 Lê Đại Hành, P 15. Q11</td>
                            <td>Deverloper</td>
                            <td>7</td>
                            <td>25.000.000</td>
                            <td>100%</td>
                            <td>25.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Khánh Bằng</td>
                            <td>182 Lê Đại Hành, P 15. Q11</td>
                            <td>Deverloper</td>
                            <td>7</td>
                            <td>25.000.000</td>
                            <td>100%</td>
                            <td>25.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Khánh Bằng</td>
                            <td>182 Lê Đại Hành, P 15. Q11</td>
                            <td>Deverloper</td>
                            <td>7</td>
                            <td>25.000.000</td>
                            <td>100%</td>
                            <td>25.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Khánh Bằng</td>
                            <td>182 Lê Đại Hành, P 15. Q11</td>
                            <td>Deverloper</td>
                            <td>7</td>
                            <td>25.000.000</td>
                            <td>100%</td>
                            <td>25.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Khánh Bằng</td>
                            <td>182 Lê Đại Hành, P 15. Q11</td>
                            <td>Deverloper</td>
                            <td>7</td>
                            <td>25.000.000</td>
                            <td>100%</td>
                            <td>25.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Khánh Bằng</td>
                            <td>182 Lê Đại Hành, P 15. Q11</td>
                            <td>Deverloper</td>
                            <td>7</td>
                            <td>25.000.000</td>
                            <td>100%</td>
                            <td>25.000.000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>Nguyễn Khánh Bằng</td>
                            <td>182 Lê Đại Hành, P 15. Q11</td>
                            <td>Deverloper</td>
                            <td>7</td>
                            <td>25.000.000</td>
                            <td>100%</td>
                            <td>25.000.000</td>
                            <td></td>
                        </tr>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td></td>
                            <td style="text-align: center;font-weight: bold">Tổng cộng</td>
                            <td></td>
                            <td></td>
                            <td>151</td>
                            <td>125.000.000</td>
                            <td></td>
                            <td>125.000.000</td>
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                    <br style="clear: both">
                    <br style="clear: both">
                    <div
                        style="width: 33.33333%; float: left; display: inline-block; line-height: 21px; text-align: center; font-size: 1.3em;">
                        <span></span>
                        </br>
                        Người lập bảng

                    </div>
                    <div style="width: 33.33333%; text-align: center;float: left;line-height: 21px;font-size: 1.3em;">
                        <span></span>
                        <br>
                        KẾ TOÁN
                    </div>
                    <div style="width: 33.33333%; text-align: center;float: left;line-height: 21px;font-size: 1.3em;">
                        <span>Ngày 20 tháng 5 năm 2016</span><br>
                        GIÁM ĐỐC
                    </div>
                </page>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn_print">In hoá đơn</a>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.btn_print').click(function () {
                if ($('.modal').is(':visible')) {
                    console.log(modalId);
                    alert(modalId);
                    var modalId = $(event.target).closest('.modal').attr('id');
                    $('body').css('visibility', 'hidden');
                    $("#" + modalId).css('visibility', 'visible');
                    $('#' + modalId).removeClass('modal');
                    window.print();
                    $('body').css('visibility', 'visible');
                    $('#' + modalId).addClass('modal');
                }
                else {

                    window.print();
                }
            });
        });
        function btn_print_action() {
            $('#bienlailuonggiaovien').modal('show');
        }

        function exportExcel() {
            var dataadd = {

            };
            $.ajax({
                url: '/Export/excel',
                type: 'Post',
                cache: false,
                async: true,
                data: dataadd,
                dataType: "text",
                success: function (result) {
                    if (result != "") {
                        document.location.href ="http://ntnq4.local/Export/excel";
                    } else {
                        alert('Tạo Bill mới thất bại.');
                    }
                },
                complete: function () {

                }
            });
        }
    </script>
