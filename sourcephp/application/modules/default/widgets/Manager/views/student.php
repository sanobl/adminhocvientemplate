<div id="contentwrapper">
    <div class="main_content">
        <div class="formSep">
            <div class="row-fluid">
                <h3 class="heading">Tìm kiếm</h3>
                <form class="form-horizontal" method="POST" action="">
                    <fieldset>
                        <div class="span12">
                            <div class="row mb-10">
                                <div class="span5">
                                    <label class="control-label">Tên học viên</label>
                                    <div class="controls">
                                        <input name="fullname" value="<?php if (isset($fullname) && $fullname != '')
                                            echo $fullname; ?>" type="text">
                                    </div>
                                </div>
                                <div class="span5">
                                    <label class="control-label">Giáo viên</label>
                                    <div class="controls">
                                        <select name="teacher">
                                            <option>Tất cả</option>
                                            <?php if (isset($listteacher) && count($listteacher) > 0) {

                                                for ($i = 0; $i < count($listteacher); $i++) {
                                                    $selected = '';
                                                    if (isset($teacherid) && $teacherid != '' && $listteacher[$i]['id'] == $teacherid) {

                                                        $selected = 'selected';

                                                    }

                                                    echo '<option value="' . $listteacher[$i]['id'] . '" ' . $selected . '>' . $listteacher[$i]['name'] . '</option>';
                                                }
                                            } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="span2">

                                </div>
                            </div>
                            <div class="row mb-10">
                                <div class="span5">
                                    <label class="control-label">Khoá học</label>
                                    <div class="controls">
                                        <select name="subjects">
                                            <option>Tất cả</option>
                                            <?php if (isset($listsubjects) && count($listsubjects) > 0) {
                                                for ($i = 0; $i < count($listsubjects); $i++) {
                                                    $selected = '';
                                                    if (isset($subjectsid) && $subjectsid != '' && $listsubjects[$i]['id'] == $subjectsid) {

                                                        $selected = 'selected';

                                                    }
                                                    echo '<option value="' . $listsubjects[$i]['id'] . '" ' . $selected . '>' . $listsubjects[$i]['title'] . '</option>';
                                                }
                                            } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="span5">
                                    <label class="control-label">Nhân viên tạo</label>
                                    <div class="controls">
                                        <input type="text" value="<?php if (isset($usercreate) && $usercreate != '')
                                            echo $usercreate; ?>" name="usercreate">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="span5">
                                    <label class="control-label">Loại</label>
                                    <div class="controls">
                                        <select name="type">
                                            <option value="2">Tất cả</option>
                                            <option value="1" <?php if ($type == 1) echo 'selected="selected"';?> >Môn học</option>
                                            <option value="0" <?php if ($type == 0) echo 'selected="selected"';?> >Dịch vụ</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="span5">
                                    <label class="control-label">Hoàn thành học phí</label>
                                    <div class="controls">
                                        <select name="finalmoney">
                                            <option value="">Tất cả</option>
                                            <option value="1">Hoàn thành</option>
                                            <option value="2">Chưa hoàn thành</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="span2">
                                    <button class="btn btn-info" type="submit">Tìm kiếm</button>
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
                <h3 class="heading">Danh sách học viên</h3>
                <div class="btn-group sepH_b">
                    <a href="them-hoc-vien.html"> <i class="splashy-add"></i> Đăng ký môn học </a>
                    <a href="them-hoc-vien.html?service=1"> <i class="splashy-add"></i> Đăng ký dịch vụ</a>
                </div>
                <div class="row-fluid sepH_c">
                    <div class="span12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>STT</th>
                                <th>Học viên</th>
                                <th>Tên chương trình </th>
                                <th>Giáo viên</th>
                                <th>Loại</th>
                                <th>Số điện thoại</th>
                                <th>Thời gian</th>
                                <th>Số tiền(VNĐ)</th>
                                <th>Ngày đăng ký</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (isset($data) && count($data) > 0) {
                                for ($i = 0; $i < count($data); $i++) {
                                    $j = $i + 1;
                                    $html = ' <tr>
                                                <td>' . $j . '</td>
                                                 <td>' . $data[$i]['student_fullname'] . '</td>
                                                <td>' . $data[$i]['title'] . '</td>
                                                <td>' . $data[$i]['name'] . '</td>
                                                ';
                                    if ($data[$i]['subject_payment_type'] != 0) {
                                        $html .= '<td>Môn học</td>';
                                        $html .= '<td>' . $data[$i]['parent_phone'] . '</td>';
                                    }
                                    else {
                                        $html .= '<td>Dịch vụ</td>';
                                        $html .= '<td>' . $data[$i]['student_phone'] . '</td>';
                                    }

                                    $html .= '<td>' . Core_Utilities::convertListDayToVN($data[$i]['timelearning']). '<br />';
                                    $html .= $data[$i]['fromhours'];
                                    if (!empty($data[$i]['tohours']))
                                        $html .= ' - '.$data[$i]['tohours'];
                                    $html .= ' </td>';
                                    $html .= '<td>'.number_format($data[$i]['money_detail'], 0, '.', '.').'</td>';
                                    $html .='
                                                <td>' .date("d-m-Y H:i:s", strtotime($data[$i]['created_at']))  . '</td>
                                             
                                                <td>';
//                                    echo $data[$i]['subject_payment_type'];
                                    if ($data[$i]['subject_payment_type'] != 0) {
                                        $html .= '<a href="them-hoc-vien_' . $data[$i]['id'] . '.html"><i class="splashy-pencil" style="padding-right:10px"></i></a>';
                                    } else {
                                        $html .= '<a href="them-hoc-vien_' . $data[$i]['id'] . '.html?service=1"><i class="splashy-pencil" style="padding-right:10px"></i></a>';
                                    }
                                    if ($data[$i]['subject_payment_type'] != 0) {
                                        $html .= '<a href = "chi-tiet-hoc-vien_' . $data[$i]['id'] . '.html" >  <i class="splashy-printer" style = "padding-right:7px" ></i ></a >';
                                    }
                                    else {
                                        $html .= '<a href = "chi-tiet-hoc-vien_' . $data[$i]['id'] . '.html?service=1" >  <i class="splashy-printer" style = "padding-right:7px" ></i ></a >';
                                    }
                                    $html .='</td >
                                            </tr > ';
                                    echo $html;


                                }
                            } ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
