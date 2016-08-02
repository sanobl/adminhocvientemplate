<div id="contentwrapper">
        <div class="main_content">
            <div class="formSep">
                <div class="row-fluid">
                    <h3 class="heading">Tìm kiếm</h3>
                    <form class="form-horizontal" id="searchUserForm" method="post">
                        <fieldset>
                            <div class="span5">
                                <label class="control-label">Tên đăng nhập</label>
                                <div class="controls">
                                    <input type="text" class="span12" id="user_name_search" name="user_name_search"
                                           value="<?php if(isset($search_name)) echo $search_name;?>"   
                                         >
                                </div>
                            </div>
                            <div class="span5">
                                <label class="control-label">Họ và tên</label>
                                <div class="controls">
                                    <input type="text" class="span12" id="user_fullname_search" name="user_fullname_search"
                                           value="<?php if(isset($search_fullname)) echo $search_fullname;?>"   
                                         >
                                </div>
                            </div>
                            <div class="span2">
                                <button class="btn btn-info" id="btnSearchUser">Tìm kiếm</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="row-fluid">
                <div class="span12">


                    <h3 class="heading">Danh sách người dùng</h3>
                    <div class="btn-group sepH_b">
                        <a href="/them-nguoi-dung.html"> <i class="splashy-add"></i> Thêm mới</a>
                    </div>
                    <div class="row-fluid sepH_c">
                        <form class="form-horizontal" method="post" id="editUserForm">
                        <div class="span12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Tên đăng nhập</th>
                                        <th>Họ và tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Admin</th>
                                        <th>Đã xoá</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($users) && count($users) > 0) {
                                foreach ($users as $user){
                                    echo '<tr>'
                                        .'<td>'.$user["id"].'</td>'
                                        .'<td>'.$user["name"].'</td>'
                                        .'<td>'.$user["full_name"].'</td>'
                                        .'<td>'.$user["email"].'</td>'
                                        .'<td>'.$user["phone"].'</td>'
                                        .'<td>'.($user["isadmin"]==1?'<i class="splashy-check"></i>':'').'</td>'
                                        .'<td>'.($user["isdelete"]==1?'<i class="splashy-check"></i>':'').'</td>'
                                        .'<td><a href="/them-nguoi-dung.html?id='.$user["id"].'"><i class="splashy-pencil" style="padding-right:10px"></i></a> '
                                            . '<i class="splashy-remove" rel="'.$user["id"].'"></i>'
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
                            <input type="hidden" id="useredt_id" name="useredt_id" value=""/>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="<?php echo $this->getView()->app->static->frontend->js; ?>/user_add.js"></script>