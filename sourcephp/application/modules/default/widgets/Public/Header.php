<?php

class Widget_Public_Header extends Core_Widget
{
    public function run()
    {
        session_start();// Starting Session
        $_SESSION['name'] = 'thuatnv';
        $_SESSION['isadmin'] = 1;
        $_SESSION['full_name']= 'fdsfdsfdsfsdf';
//        if (empty($_SESSION['name'])) {
//            $url = '/dang-nhap.html';
//            $this->forward($url);
//        }
        $name = $_SESSION['name'];
        $fullname = $_SESSION['full_name'];
        $isadmin = $_SESSION['isadmin'];
        $id = $_SESSION['id'];
        $this->render('header', array(
            "name" =>$name,
            "fullname" =>$fullname,
            "isadmin" =>$isadmin,
            "id" =>$id
        ));

    }
}

?>
