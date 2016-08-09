<div id="contentwrapper">
    <div class="main_content">
        <div class="formSep">
            <div class="row-fluid">
                <h3 class="heading">Tìm kiếm</h3>
                <form class="form-horizontal" method="post">
                    <fieldset>
                        <div class="span5">
                            <label class="control-label">Tên dịch vụ </label>
                            <div class="controls">
                                <input type="text" class="span12" name="title"
                                       value="<?php if (!empty($title)) echo $title; ?>">
                            </div>
                        </div>

                        <div class="span2">
                            <button type="submit" class="btn btn-info">Tìm kiếm</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span12">


                <h3 class="heading">Danh sách dịch vụ</h3>
                <div class="btn-group sepH_b">
                    <a href="/them-dich-vu.html"> <i class="splashy-add"></i> Thêm mới</a>
                </div>
                <div class="row-fluid sepH_c">
                    <form class="form-horizontal" method="post" id="editCourseForm">
                    <div class="span12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Tên dịch </th>
                                <th>Ngày tạo</th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php if (isset($data) && count($data) > 0) {
                                $i = 1;
                                foreach ($data as $item) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $item['title']; ?></td>

                                        <td><a href="/them-dich-vu.html?subid=<?php echo $item['id'];?>"><i
                                                class="splashy-pencil" style="padding-right:10px"></i></a>
                                            <i class="splashy-remove" rel="<?php echo $item['id'];?>"></i>
                                        </td
                                    </tr>


                                    <?php $i++;
                                }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                        <input type="hidden" id="course_id" name="course_id" value=""/>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $this->getView()->app->static->frontend->js; ?>/subject_add.js"></script>