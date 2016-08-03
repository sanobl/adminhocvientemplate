<?php

class Widget_User_Login extends Core_Widget
{

    public function run()
    {
        if (empty($_POST)) {
            $error = '';
        } else {
            $username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $password = isset($_POST['password']) ? trim($_POST['password']) : '';
            $result = Core_MysqlStatistic::getInstance()->checkUserLogin($username, $password);

            if (isset($result) && count($result) > 0) { //login thanh cong
                session_start(); // Starting Session
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
                $_SESSION['name'] = $result[0]['name']; // Initializing Session
                $_SESSION['email'] = $result[0]['email']; // Initializing Session
                $_SESSION['phone'] = $result[0]['phone']; // Initializing Session
                $_SESSION['full_name'] = $result[0]['full_name']; // Initializing Session
                $_SESSION['isadmin'] = $result[0]['isadmin']; // Initializing Session
                $_SESSION['id'] = $result[0]['id']; // Initializing Session

                $url = '/quan-ly-hoc-vien.html';
                $this->forward($url);
            } else
                $error = "Tên đăng nhập hoặc mật khẩu không đúng";
        }
        return $this->render('login', array(
            'error' => $error
        ));
    }

}
