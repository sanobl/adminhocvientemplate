<div id="contentwrapper">
    <div class="main_content">
        <div class="row-fluid">
            <div class="span12">

                <h3 class="heading">Thông tin học viên</h3>

                <div class="row-fluid sepH_c">
                    <div class="span12">
                        <?php
                        if (isset($haserror) && $haserror) {

                            echo '<h5 class="text-center text-error" style="text-align:center">' . $mess . '</h5>';
                        } else {
                            ?>
                            <form class="form-horizontal">
                                <fieldset>

                                    <div class="span6 boder-right">

                                        <div class="span12">
                                            <h4> Thông tin học viên</h4>

                                            <div class="control-group">
                                                <label class="control-label">Họ và tên</label>

                                                <div class="controls">
                                                    <label class="padding-top5">
                                                        <?php
                                                        if (isset($student_fullname) && $student_fullname != '') {
                                                            echo $student_fullname;
                                                        }
                                                        ?> </label>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Số điện thoại</label>

                                                <div class="controls">
                                                    <label class="padding-top5">
                                                        <?php
                                                        if (isset($student_phone) && $student_phone != '') {
                                                            echo $student_phone;
                                                        }
                                                        ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Email</label>

                                                <div class="controls">
                                                    <label class="padding-top5">
                                                        <?php
                                                        if (isset($student_email) && $student_email != '') {
                                                            echo $student_email;
                                                        }
                                                        ?>
                                                    </label>
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
                                                    <label class="padding-top5">
                                                        <?php
                                                        if (isset($parent_fullname) && $parent_fullname != '') {
                                                            echo $parent_fullname;
                                                        }
                                                        ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Số điện thoại </label>

                                                <div class="controls">
                                                    <label class="padding-top5">
                                                        <?php
                                                        if (isset($parent_phone) && $parent_phone != '') {
                                                            echo $parent_phone;
                                                        }
                                                        ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Email</label>

                                                <div class="controls">
                                                    <label class="padding-top5">
                                                        <?php
                                                        if (isset($parent_email) && $parent_email != '') {
                                                            echo $parent_email;
                                                        }
                                                        ?>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="clearfix"></div>
                                    <hr>
                                    <h4 class="title-form"> Thông tin khóa học</h4>

                                    <div class="control-group">
                                        <label class="control-label">Khóa học</label>

                                        <div class="controls">
                                            <label class="padding-top5">
                                                <?php
                                                if (isset($subjectname) && $subjectname != '') {
                                                    echo $subjectname;
                                                }
                                                ?>
                                            </label>

                                        </div>
                                    </div>
                                    <?php
                                    if (isset($subjectClass) && count($subjectClass) > 0) {
                                        $i = 0;
                                        foreach ($subjectClass as $item) {
                                            $checked = '';
                                            $html = '';
                                            if ($subject_class_id == $item['id']) {
                                                $checked = 'checked=checked';

                                                $html .= ' <div class="control-group">';
                                                $html .= '<label class="control-label">Thời gian học</label>';
                                                $html .= ' <div class="controls" style="padding-top:5px">';
                                                $html .= '<input type="radio" name="subject_class_id" value="' . $item['id'] . '" ' . $checked . '/>';
                                                $html .= Core_Utilities::convertListDayToVN($item['timelearning']) . '-' . $item['fromhours'] . '->' .
                                                    $item['tohours'] . '-' . $item['teacher_name'];
                                                $html .= '</div>';
                                                $html .= '</div>';
                                                echo $html;
                                                break;
                                            }
                                            $i++;
                                        }
                                    }
                                    ?>
<!--                                    <div id="khoahocinfo">-->
<!--                                        <div class="control-group"><label class="control-label">Giáo viên</label>-->
<!--                                            <div class="controls" style="padding-top:5px">-->
<!--                                                --><?php
//                                                if (isset($teachername) && $teachername != '') {
//                                                    echo $teachername;
//                                                }
//                                                ?>
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="control-group"><label class="control-label">Thời gian học</label>-->
<!--                                            <div class="controls" style="padding-top:5px">-->
<!--                                                --><?php
//                                                if (isset($time) && $time != '') {
//                                                    echo $time;
//                                                }
//                                                ?>
<!--                                            </div>-->
<!--                                        </div>-->
                                        <div class="control-group"><label class="control-label">Số
                                                tiền/khoá(VNĐ)</label>
                                            <div class="controls" style="padding-top:5px">
                                                <?php
                                                if (isset($money_total) && $money_total != '') {
                                                    echo  number_format($money_total, 0, '.', '.') . ' VNĐ';
                                                }
                                                ?></div>
                                        </div>
                                        <!--                                        <div class="control-group"><label class="control-label">Hình thức thanh toán</label>-->
                                        <!--                                            <div class="controls" style="padding-top:5px"> Theo tháng</div>-->
                                        <!--                                        </div>-->
                                        <!--                                    </div>-->
                                        <!--                                <div id="hinhthucthanhtoan">
                                                                            <div class="control-group"><label class="control-label"> </label>
                                                                                <div class="controls">
                                                                                    <div class="span12"><label class="checkbox inline"> <input type="checkbox">
                                                                                            T1/2016Đ - 100,000 VNĐ</label><label class="checkbox inline"> <input
                                                                                                type="checkbox"> T2/2016 - 100,000 VNĐ</label><label
                                                                                            class="checkbox inline"> <input type="checkbox"> T3/2016 - 100,000
                                                                                            VNĐ </label><label class="checkbox inline"> <input type="checkbox">
                                                                                            T4/2016 - 100,000 VNĐ</label><label class="checkbox inline"> <input
                                                                                                type="checkbox"> T5/2016 - 100,000 VNĐ </label></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>-->


                                        <div class="control-group">
                                            <div class="controls">
                                                <a href="/them-hoc-vien_<?php echo $studentid; ?>.html"
                                                   class="btn btn-info" type="button" id="btnChangeInfo">Thay đổi thông
                                                    tin</a>

<!--                                                <a href="#bienlaithutien" onclick="" role="button" class="btn btn-info"-->
<!--                                                   data-toggle="modal">In thông tin</a>-->
                                                <button class="btn btn-danger" type="button" id="btnExit">Thoát</button>


                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <h5>
                                            In Hóa Đơn
                                            <a class="pull-right" onclick="btn_print_new(<?php
                                            echo '\'' . $listbill[0]['student_fullname'] . '\',\'' . $listbill[0]['student_id'] . '\',\'' . $listbill[0]['title'] . '\',\'' . $listbill[0]['subject_id'] . '\',\'' . number_format($listbill[0]['money'], 0, '.', '.') . '\',\'' . Core_Utilities::convert_number_to_words($listbill[0]['money']) . '\'';
                                            ?>);">In Mới</a>
                                        </h5>
                                        <table id="print_bill">
                                            <thead>
                                            <tr>
                                                <th>Stt</th>
                                                <th>Số Hóa Đơn</th>
                                                <th>Người Nộp</th>
                                                <th>Người Tạo</th>
                                                <th>Ngày Nộp</th>
                                                <th>Số tiền</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            for ($i = 0; $i < count($listbill); $i++) {
                                                $stt = $i + 1;
                                                ?>
                                                <tr>
                                                    <td align="center"><?php echo $stt ?></td>
                                                    <td align="center"><?php echo $listbill[$i]['bill_code'] ?></td>
                                                    <td align="center"><?php echo $listbill[$i]['student_fullname'] ?></td>
                                                    <td align="center"><?php echo $listbill[$i]['created_by'] ?></td>
                                                    <td align="center"><?php
                                                        $timetmp = strtotime($listbill[$i]['created_at']);
                                                        $timetmp = date('d/m/Y h:m:i', $timetmp);
                                                        echo $timetmp;
                                                        ?></td>
                                                    <td align="center"><?php echo  number_format($listbill[$i]['money'], 0, '.', '.'); ?></td>
                                                    <td align="center"><a href="javascript:void(0);" onClick="btn_print_action(<?php
                                                        echo '\'' . $listbill[$i]['bill_code'] . '\',\'' . $listbill[$i]['student_fullname'] . '\',\'' . $listbill[$i]['created_by'] . '\',\'' . $listbill[$i]['title'] . '\',\'' .  number_format($listbill[$i]['money'] , 0, '.', '.') . '\',\'' . Core_Utilities::convert_number_to_words($listbill[$i]['money']) . '\'';
                                                        ?>);"> <i class="splashy-printer" style="padding-right:7px"></i></a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                </fieldset>
                            </form>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>


        <div class="modal hide fade" id="myTasks">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h3>Thông tin hoá đơn </h3>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn">In hoá đơn</a>
            </div>
        </div>

        <div class="modal hide fade" id="bienlaithutien" style="width: 15cm; left:42%;">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h3>Thông tin hoá đơn </h3>
            </div>
            <div class="modal-body">

                <style>
                    #bienlaithutien {
                        font-size: 13px;
                    }

                    table {
                        border: 1px solid #000;
                        width: 100%;
                        max-width: 100%;
                        border-spacing: 0;
                        border-collapse: collapse;
                    }

                    table > thead > tr > th, table > tbody > tr > td, table > tfoot > tr > td {
                        border: 1px solid #000;
                        line-height: 1.42857143;
                        padding: 8px;
                    }

                    table > tbody > tr > td, table > tfoot > tr > td {
                        border-top: 1px solid #000;
                    }

                    page {
                        background: white;
                        display: block;
                        margin: 0 auto;
                        margin-bottom: 0.5cm;
                    }

                    page[size="A4"] {
                        width: 19cm;
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

                    page[size="A6"][layout="portrait"] {
                        width: 14.8cm;
                        height: 10.5cm;
                    }

                    page[size="A6"] {
                        width: 10.5cm;
                        height: 14.8cm;
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
                            font-size: 13px;
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
                            font-size: 13px;
                        }
                    }
                </style>

                <page size="A6" layout="portrait">
                    <div style="width: 50%; float: left; display: inline-block; line-height: 21px; text-align: left">
                        <span><b>NHÀ THIẾU NHI QUẬN 4</b></span></br>
                        Địa chỉ: 405 Hoàng Diệu P.5, Q.4</br>
                        Điện thoại: 39.404.108 - 38.268.007</br>
                        Mã ĐVQHNS: 1046537</br>
                        Mã số thuế: 0308843059
                    </div>
                    <div style="width: 50%; text-align: center;float: left;line-height: 21px;">
                        <span><b>Mã số CB38-BB</b></span><br>
                        (Ban hành theo QĐ số 19/2006/QĐ-BTC</br>
                        ngày 30/03/2006 của Bộ trưởng Tài Chính)
                    </div>
<!--                    <br style="clear: both">-->
<!--                    <br style="clear: both">-->
                    <br style="clear: both">
                    <div style="width:100%; text-align: center">
                        <h3>BIÊN LAI THU TIỀN</h3>
                        <span>Ngày <?php echo date('d', time()) ?> tháng <?php echo date('m', time()) ?>
                            năm <?php echo date('Y', time()) ?></span>
                    </div>
                    <div style="clear: both">
                        <br>
                    </div>
                    <div style="width:200px; float: right">
                        <span>Ký hiệu: AA/2016-BL</span>
                        <br>
                        <span style="">Số:</span>
                    </div>
<!--                    <br style="clear: both">-->
<!--                    <br style="clear: both">-->
                    <div style="display: table; width: 100%; height: 23px;">
                        <span
                            style="display: table-cell; width: 120px; vertical-align: bottom;">Họ tên người nộp :</span>
                        <span style="display: table-cell;border-bottom: 1px #000 dotted;vertical-align: bottom;"><?php
                            if (isset($student_fullname) && $student_fullname != '') {
                                echo $student_fullname;
                            }
                            ?></span>
                        <span style="display: table-cell; width: 10px; "></span>
                    </div>
                    <div style="display: table; width: 100%;height: 23px;">
                        <span style="display: table-cell; width: 60px; vertical-align: bottom;">Địa chỉ :</span>
                        <span
                            style="display: table-cell;border-bottom: 1px #000 dotted;vertical-align: bottom;">&nbsp;</span>
                        <span style="display: table-cell; width: 10px; "></span>
                    </div>
                    <div style="display: table; width: 100%;height: 23px;">
                        <span style="display: table-cell; width: 89px; vertical-align: bottom;">Nội dung thu :</span>
                        <span style="display: table-cell;border-bottom: 1px #000 dotted;vertical-align: bottom;">Nộp tiền khóa học <?php
                            if (isset($subjectname) && $subjectname != '') {
                                echo $subjectname;
                            }
                            ?></span>
                        <span style="display: table-cell; width: 10px; "></span>
                    </div>
                    <div style="display: table; width: 100%;height: 23px;">
                        <span style="display: table-cell; width: 76px; vertical-align: bottom;">Số tiền thu :</span>
                        <span
                            style="display: table-cell;width: 150px; border-bottom: 1px #000 dotted; text-align: center;vertical-align: bottom;">
                            <?php
                            if (isset($money_total) && $money_total != '') {
                                echo number_format($money_total, 0, '.', '.') ;
//                                echo $money_total . ' VNĐ';
                            }
                            ?>
                        </span>
                        <span style="display: table-cell; width: 150px; vertical-align: bottom;">(Viết bằng chữ)</span>
                        <span
                            style="display: table-cell;border-bottom: 1px #000 dotted; vertical-align: bottom;text-align: center">

                            <?php
                            if (isset($money_convert) && $money_convert != '') {
                                echo $money_convert . ' đồng';
                            }
                            ?>
                        </span>
                        <span style="display: table-cell; width: 10px; "></span>
                    </div>

<!--                    <br style="clear: both">-->
                    <br style="clear: both">
                    <div style="width: 50%; display: inline-block; line-height: 21px; text-align: center">
                        <span><b>Người thu tiền</b></span></br>
                        (Ký, họ tên)
                        <br>
                        <br>
                        <br>
                        <?php
                        if (isset($fullname_agent) && $fullname_agent != '') {
                            echo $fullname_agent;
                        }
                        ?>
                    </div>
                    <div style="width: 50%; text-align: center;float: left;line-height: 21px;">
                        <span><b>Người nộp tiền</b></span><br>
                        (Ký, họ tên)

                    </div>
                </page>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn_print">In hoá đơn</a>
            </div>
        </div>
        <div class="modal hide fade" id="bienlaithutien2" style="width: 15cm; left:42%;">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">×</button>
                <h3>Thông tin hoá đơn </h3>
            </div>
            <div class="modal-body">

                <style>
                    #bienlaithutien2 {
                        font-size: 13px;
                    }

                </style>

                <page size="A6" layout="portrait">
                    <div style="width: 50%; float: left; display: inline-block; line-height: 21px; text-align: left">
                        <span><b>NHÀ THIẾU NHI QUẬN 4</b></span></br>
                        Địa chỉ: 405 Hoàng Diệu P.5, Q.4</br>
                        Điện thoại: 39.404.108 - 38.268.007</br>
                        Mã ĐVQHNS: 1046537</br>
                        Mã số thuế: 0308843059
                    </div>
                    <div style="width: 50%; text-align: center;float: left;line-height: 21px;">
                        <span><b>Mã số CB38-BB</b></span><br>
                        (Ban hành theo QĐ số 19/2006/QĐ-BTC</br>
                        ngày 30/03/2006 của Bộ trưởng Tài Chính)
                    </div>
<!--                    <br style="clear: both">-->
<!--                    <br style="clear: both">-->
                    <br style="clear: both">
                    <div style="width:100%; text-align: center">
                        <h3>BIÊN LAI THU TIỀN</h3>
                        <span>Ngày <?php echo date('d', time()) ?> tháng <?php echo date('m', time()) ?>
                            năm <?php echo date('Y', time()) ?></span>
                    </div>
                    <div style="clear: both">
                        <br>
                    </div>
                    <div style="width:200px; float: right">
                        <span>Ký hiệu: AA/2016-BL</span>
                        <br>
                        <span style="" id="bill_code"></span>
                    </div>
<!--                    <br style="clear: both">-->
<!--                    <br style="clear: both">-->
                    <div style="display: table; width: 100%; height: 23px;">
                        <span
                            style="display: table-cell; width: 120px; vertical-align: bottom;">Họ tên người nộp :</span>
                        <span style="display: table-cell;border-bottom: 1px #000 dotted;vertical-align: bottom;">
                            <input type="text" value="" class="student_fullname"
                                   style="border: none;box-shadow: none;padding: 1px;margin-bottom: 0px;width: 100%;">
                        </span>
                        <span style="display: table-cell; width: 10px; "></span>
                    </div>
                    <div style="display: table; width: 100%;height: 24px;">
                        <span style="display: table-cell; width: 60px; vertical-align: bottom;">Địa chỉ :</span>
                        <span
                            style="display: table-cell;border-bottom: 1px #000 dotted;vertical-align: bottom;">&nbsp;</span>
                        <span style="display: table-cell; width: 10px; "></span>
                    </div>
                    <div style="display: table; width: 100%;height: 23px;">
                        <span style="display: table-cell; width: 89px; vertical-align: bottom;">Nội dung thu :</span>
                        <span style="display: table-cell;border-bottom: 1px #000 dotted;vertical-align: bottom;">
                            <input type="text" value="" id="subjectname"
                                   style="border: none;box-shadow: none;padding: 1px;margin-bottom: 0px;width: 100%;">
                        </span>
                        <span style="display: table-cell; width: 10px; "></span>
                    </div>
                    <div style="display: table; width: 100%;height: 23px;">
                        <span style="display: table-cell; width: 76px; vertical-align: bottom;">Số tiền thu :</span>
                        <span
                            style="display: table-cell;width: 150px; border-bottom: 1px #000 dotted; text-align: center;vertical-align: bottom;"
                            id="money_total">

                        </span>
                        <span style="display: table-cell; width: 100px; vertical-align: bottom;">(Viết bằng chữ)</span>
                        <span
                            style="display: table-cell;border-bottom: 1px #000 dotted; vertical-align: bottom;text-align: center"
                            id="money_convert">

                        </span>
                        <span style="display: table-cell; width: 10px; "></span>
                    </div>
<!---->
<!--                    <br style="clear: both">-->
                    <br style="clear: both">
                    <div style="width: 50%; display: inline-block; line-height: 21px; text-align: center">
                        <span><b>Người thu tiền</b></span></br>
                        (Ký, họ tên)
                        <br>
                        <br>
                        <br>
                        <strong id="fullname_agent"></strong>
                    </div>
                    <div style="width: 50%; text-align: center;float: left;line-height: 21px;">
                        <span><b>Người nộp tiền</b></span><br>
                        (Ký, họ tên)


                    </div>
                </page>
            </div>
            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn_print">In hoá đơn</a>
            </div>
        </div>
    </div>
</div>
<?php if (isset($isprint) && $isprint == 1) { ?>
    <script>
        $(window).load(function () {
            $('#bienlaithutien').modal('show');
        });

    </script>

<?php } ?>
<script>
    $(document).ready(function () {
        $('.btn_print').click(function () {
            if ($('.modal').is(':visible')) {
                var modalId = $(event.target).closest('.modal').attr('id');
                $('body').css('visibility', 'hidden');
                $("#" + modalId).css('visibility', 'visible');
                $('#' + modalId).removeClass('modal');
                window.print();
                $('body').css('visibility', 'visible');
                $('#' + modalId).addClass('modal');
            } else {
                window.print();
            }

        });
        $('#btnExit').click(function () {
            window.location.href = "/quan-ly-hoc-vien.html";

        });


    });
    function btn_print_action(billcode, student_fullname, created_by, subjecttitle, money, moneyconvert) {

        $('#bill_code').html('Số: ' + billcode);
        $('.student_fullname').val(student_fullname);
        $('#subjectname').val('Nộp tiền khóa học ' + subjecttitle);
        $('#money_total').html(money );
        $('#money_convert').html(moneyconvert+ ' đồng');
        $('#fullname_agent').html('<?php echo $fullname_agent;?>');

        $('#bienlaithutien2').modal('show');
    }
    function btn_print_new(student_fullname, student_id, subjecttitle, subject_id, money, moneyconvert) {
        $('.student_fullname').val(student_fullname);
        $('#subjectname').val('Nộp tiền khóa học ' + subjecttitle);
        $('#money_total').html(money );
        $('#money_convert').html(moneyconvert + ' đồng');
        $('#bienlaithutien2').modal('show');
        var dataadd = {
            student_fullname: student_fullname,
            student_id: student_id,
            subjecttitle: subjecttitle,
            subject_id: subject_id,
            money: money
        };
        $.ajax({
            url: '/Ajax/insertbill',
            type: 'Post',
            cache: false,
            async: true,
            data: dataadd,
            dataType: "text",
            success: function (result) {
                if (result != "") {
                    $('#bill_code').html('Số: ' + result);
                    $('#bienlaithutien2').modal('show');
                } else {
                    alert('Tạo Bill mới thất bại.');
                }
            },
            complete: function () {

            }
        });
    }
</script>