<header>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="brand" href="quanlyhocvien.html"><i class="icon-home icon-white"></i> Nhà thiếu nhi Quận 4</a>
                <ul class="nav user_menu pull-right">
                    <li class="divider-vertical hidden-phone hidden-tablet"></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $fullname; ?> <b
                                class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/them-nguoi-dung.html?id=<?php echo $id;?>">Xem thông tin</a>
                            </li>

                            <li>
                                <a href="/thoat.html">Thoát</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <a data-target=".nav-collapse" data-toggle="collapse" class="btn_menu"> <span
                        class="icon-align-justify icon-white"></span> </a>
                <nav>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li class="dropdown">
                                <a class="dropdown-toggle" href="/quan-ly-hoc-vien.html"> Quản lý học viên </a>
                            </li>
                            <?php if ($isadmin == 1) { ?>
                            <li class="dropdown">
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#"> Quản trị <b
                                        class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/quan-ly-nguoi-dung.html">Người dùng</a>
                                    </li>
                                    <li>
                                        <a href="/quan-ly-giao-vien.html">Giáo viên</a>
                                    </li>
                                    <li>
                                        <a href="/quan-ly-khoa-hoc.html">Khoá học</a>
                                    </li>
                                    <li>
                                        <a href="/thong-ke.html">Thống kê</a>
                                    </li>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>