<?php
class Widget_Manager_Statistic extends Core_Widget{

    public function run(){
        $listRequest = Core_MysqlStatistic::getInstance()->demomysql();
        print_r($listRequest);
        $this->render('statistic', array(

        ));
    }

}