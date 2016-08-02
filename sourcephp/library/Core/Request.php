<?php
class Core_Request{
	protected $_request;

    public static function getInstance($className=__CLASS__){
		static $_instance = null;
        //Check instance
        if(empty($_instance)){
            $_instance = new $className;

            if($request = Core_Page::getInstance()->_request)
                $_instance->_request = Core_Page::getInstance()->_request;
            else
                $_instance->_request = Zend_Controller_Front::getInstance()->getRequest();

        }

        //Return instance
        return $_instance;
    }

	public function getParam($key, $default=NULL){
		$result = preg_replace('/[\"\']/', '', htmlspecialchars($this->_request->getParam($key, $default)));		
		if(in_array($key, array('category'))){
			$result = (int)$result;
		}

		return $result;
	}

	public function __call($method, $args){
		return call_user_func_array(array($this->_request, $method), $args);
	}
        
        public function leftMenuPostRequest($formId){
            $menu = '<div id="block-menu">
            <h2 style="font-size:14px;">Yêu cầu hỗ trợ tài khoản</h2>
            <ul id="sidebar-menu" style="margin-bottom:20px;">
                <li><a href="/khoa-tai-khoan.html" '.($formId==81?'class="active"':'').'>Khóa Tài Khoản</a></li>	
                <li><a href="/mo-khoa-tai-khoan.html" '.($formId==82?'class="active"':'').'>Mở khóa Tài Khoản</a></li>	
                <li><a href="javascript:showLogin(\'gui-yeu-cau/thay-doi-cmnd_0_10\');" '.($formId==10?'class="active"':'').'>Thay đổi CMND</a></li>
                <li><a href="javascript:showLogin(\'gui-yeu-cau/khoi-phuc-mat-khau_0_89\');" '.($formId==89?'class="active"':'').'>Khôi phục mật khẩu</a></li>
                <li><a href="javascript:showLogin(\'gui-yeu-cau/kiem-tra-log-giao-dich_0_83\');" '.($formId==83?'class="active"':'').'>Lịch sử giao dịch</a></li>
            </ul>
            <h2 style="font-size:14px;">Yêu cầu báo lỗi khiếu kiện</h2>
            <ul id="sidebar-menu" style="margin-bottom:20px;">
                <li><a href="javascript:showLogin(\'gui-yeu-cau/thanh-toan_0_5\');" '.($formId==5?'class="active"':'').'>Lỗi thanh toán</a></li>
                <li><a href="javascript:showLogin(\'gui-yeu-cau/bao-loi-san-pham_0_6\');" '.($formId==6?'class="active"':'').'>Báo lỗi sản phẩm</a></li>
                <li><a href="javascript:showLogin(\'gui-yeu-cau/khieu-kien-giai-dau_0_7\');" '.($formId==7?'class="active"':'').'>Khiếu kiện giải đấu</a></li>
                <li><a href="javascript:showLogin(\'gui-yeu-cau/bao-loi-csm-pmtt_0_16\');" '.($formId==16?'class="active"':'').'>Báo lỗi CSM, PMTT</a></li>
            </ul>
            <h2 style="font-size:14px; ">Đăng ký</h2>
            <ul id="sidebar-menu">
                <li><a href="javascript:showLogin(\'gui-yeu-cau/dang-ky-giai-dau_0_2\');" '.($formId==2?'class="active"':'').'>Đăng ký tham gia giải đấu</a></li>
                <li><a href="javascript:showLogin(\'gui-yeu-cau/dang-ky-nhan-thuong_0_1\');" '.($formId==1?'class="active"':'').'>Đăng ký nhận thưởng</a></li>
                <li><a href="/chuyen-server.html" '.($formId=='server'?'class="active"':'').'>Đăng ký chuyển server</a></li>
                <li><a href="javascript:showLogin(\'gui-yeu-cau/dang-ky-hoan-ZingXu_0_19\');" '.($formId==19?'class="active"':'').'>Đăng ký hoàn ZingXu</a></li>
            </ul>';
            $infoFormMenu = Core_InfoForm::getInstance()->getListInfoForm();            
            if($infoFormMenu != '' && $infoFormMenu[1] != 'No_data'){

                $menu .= '<h2 style="font-size:14px; ">Ghi nhận thông tin</h2>
                        <ul id="sidebar-menu">';            
                for($i=1; $i<count($infoFormMenu); $i+=2)
                {
                    $menu .= '<li><a '.($infoFormMenu[$i] == $formId? 'class="active"':'').'href="javascript:showLogin(\'gui-yeu-cau/'.Core_Map::formatString($infoFormMenu[$i+1]).'_0_'.$infoFormMenu[$i].'\');">'.$infoFormMenu[$i+1].'</a></li>';
                }
                $menu .= '</ul>';
            }
            $menu .= '</div>';
            return $menu;
        }
}