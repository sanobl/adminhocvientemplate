<?php
// if(strpos($_SERVER['REQUEST_URI'],'homepage') !== false){
    // header("Location: ".Core_Global::getApplicationIni()->app->static->site->site_url);
// }
$this->widget('Public_Header');

$this->widget('Manager_Service');

$this->widget('Public_Footer');
// $this->widget('Home_FooterJs');
?>