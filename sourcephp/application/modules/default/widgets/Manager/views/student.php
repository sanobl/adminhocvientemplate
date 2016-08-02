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
                                                            echo $fullname;?>" type="text">
                                        </div>
                                    </div>
                                    <div class="span5">
                                        <label class="control-label">Giáo viên</label>
                                        <div class="controls">
                                            <select name="teacher">
                                                <option>Tất cả</option>
                                                    <?php if(isset($listteacher) && count($listteacher)>0){
                                                        
                                                        for($i=0;$i<count($listteacher);$i++){
                                                            $selected = '';
                                                            if(isset($teacherid) && $teacherid != '' && $listteacher[$i]['id'] == $teacherid){
                                                                
                                                                $selected = 'selected';
                                                                
                                                            }
                                                            
                                                            echo '<option value="'.$listteacher[$i]['id'].'" '.$selected.'>'.$listteacher[$i]['name'].'</option>';
                                                        }
                                                    }?>

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
                                                    <?php if(isset($listsubjects) && count($listsubjects)>0){
                                                        for($i=0;$i<count($listsubjects);$i++){
                                                            $selected = '';
                                                            if(isset($subjectsid) && $subjectsid != '' && $listsubjects[$i]['id'] == $subjectsid){
                                                                
                                                                $selected = 'selected';
                                                                
                                                            }
                                                            echo '<option value="'.$listsubjects[$i]['id'].'" '.$selected.'>'.$listsubjects[$i]['title'].'</option>';
                                                        }
                                                    }?>

                                                </select>
                                        </div>
                                    </div>
                                    <div class="span5">
                                        <label class="control-label">Nhân viên tạo</label>
                                        <div class="controls">
                                            <input type="text" value="<?php if (isset($usercreate) && $usercreate != '')
                                                            echo $usercreate;?>" name="usercreate">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="span5">
                                        <label class="control-label">Hoàn thành học phí</label>
                                        <div class="controls">
                                            <select>
                                                <option value="">All</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="span5">

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
                        <a href="them-hoc-vien.html"> <i class="splashy-add"></i> Thêm mới</a>
                    </div>
                    <div class="row-fluid sepH_c">
                        <div class="span12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Khoá học</th>
                                        <th>Giáo viên</th>
                                        <th>Học viên</th>
                                        <th>Thời gian đăng ký</th>
                                        <th>Học phí</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($data) && count($data)>0){
                                        for($i = 0;$i<count($data); $i++){
                                            $j = $i + 1;
                                               echo ' <tr>
                                                <td>'. $j .'</td>
                                                <td>'. $data[$i]['title'] .'</td>
                                                <td>'. $data[$i]['name'].'</td>
                                                <td>'. $data[$i]['student_fullname'].'</td>
                                                <td>'. $data[$i]['created_at'].'</td>
                                                <td>
                                                    
                                                </td>
                                                <td><a href="them-hoc-vien_'.$data[$i]['id'].'.html"><i class="splashy-pencil" style="padding-right:10px"></i></a>
                                                    <a href="chi-tiet-hoc-vien_'.$data[$i]['id'].'.html">  <i class="splashy-printer" style="padding-right:7px"></i></a>                                                   
                                                </td>
                                            </tr>';
                                        }}?>
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
