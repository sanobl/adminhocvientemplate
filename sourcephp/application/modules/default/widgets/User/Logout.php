<?php

class Widget_User_Logout extends Core_Widget{
    
    public function run(){
        session_start();
        if(session_destroy()) // Destroying All Sessions
        {
            $url = '/dang-nhap.html';
            $this->forward($url);
        }
    }
    
}
