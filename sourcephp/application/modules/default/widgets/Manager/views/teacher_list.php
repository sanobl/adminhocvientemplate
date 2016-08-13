<div id="contentwrapper">
        <div class="main_content">
            <div class="formSep">
                <div class="row-fluid">
                    <h3 class="heading">Tìm kiếm</h3>
                    <form class="form-horizontal" method="post" id="searchTeacherForm">
                        <fieldset>
                            <div class="span5">
                                <label class="control-label">Họ và tên</label>
                                <div class="controls">
                                    <input type="text" class="span12" id="teacher_name_search" name="teacher_name_search"
                                           value="<?php if(isset($search)) echo $search;?>"   
                                         >
                                </div>
                            </div>
                            <div class="span2">
                                <button class="btn btn-info" id="btnSearchTeacher">Tìm kiếm</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

                <div class="span12">


                    <h3 class="heading">Danh sách giáo viên</h3>
                    <div class="btn-group sepH_b">
                        <a href="/them-giao-vien.html"> <i class="splashy-add"></i> Thêm mới</a>
                    </div>
                    <div class="row-fluid sepH_c">
                        <form class="form-horizontal" method="post" id="editTeacherForm">
                        <div class="span12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Họ và Tên</th>
                                        <th>Số điện thoại</th>
                                        <th>Email</th>
                                        <th>Địa chỉ</th>
                                        <th>Đã kích hoạt</th>
                                        <th>Đã xoá</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($teachers) && count($teachers) > 0) {
                                foreach ($teachers as $teacher){
                                    echo '<tr>'
                                        .'<td>'.$teacher["id"].'</td>'
                                        .'<td>'.$teacher["name"].'</td>'
                                        .'<td>'.$teacher["phone"].'</td>'
                                        .'<td>'.$teacher["email"].'</td>'
                                        .'<td>'.$teacher["address"].'</td>'
                                        .'<td>'.($teacher["isactive"]==1?'<i class="splashy-check"></i>':'').'</td>'
                                        .'<td>'.($teacher["isdelete"]==1?'<i class="splashy-check"></i>':'').'</td>'
                                        .'<td><a href="/them-giao-vien.html?id='.$teacher["id"].'"><i class="splashy-pencil" style="padding-right:10px"></i></a> '
                                            . '<i class="splashy-remove" rel="'.$teacher["id"].'"></i>'
                                        . '</td>'
                                    .'</tr>';
                                }
                                    }
                                    else {
                                        echo '<tr><td colspan="8">Không có dữ liệu</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <input type="hidden" id="teacheredt_id" name="teacheredt_id" value=""/>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo $this->getView()->app->static->frontend->js; ?>/teacher_add.js"></script>