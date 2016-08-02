<?php
class Widget_Public_Header extends Core_Widget
{
	public function run(){    
            $title = $this->getRequest()->getParam('title');
            // $site = Core_Cookies::getCookie('vngsupportprod');
            // // if($site == ''){
                // // Core_Cookies::setCookie('vngsupportprod', 'PC');
                // // $site = 'PC';
            // // }
			// if(($site == 'MOBILE'
					// && $title != 'tin-tuc' && $title != 'danh-sach-tin-tuc'
					// && $title != 'tim-kiem' && $title != 'danh-sach-tim-kiem'
					// && $title != 'tiep-nhan-thong-tin-lua-dao'
					// && $title != 'thong-bao-gui-yeu-cau'
					// && $title != 'index' && $title != 'lien-he'
				// )
				// || ($site == '' && $title != 'index'))
                // header("Location: " . Core_Global::getApplicationIni()->app->static->site->site_url);
            $site = strtolower(trim($this->getRequest()->getParam('game')));	
            if($site == 'mobile'){
                $userInfo = Core_Facebook::getlogin();
            }else {
                $userInfo = Core_User::getInstance()->checkLoginStatus();
            }
            if($site == '' )
			{ 
				if($title == 'supportcctalk' || $title == 'kich-hoat-yeu-cau' || $title == 'lien-he'){
					$site = 'pc';
				}
				else if($title != 'index')
				{ 
					$this->forward(Core_Global::getApplicationIni()->app->static->site->site_url."?redirect=".base64_encode($_SERVER["REQUEST_URI"]));
				}
			}
			else if($site != 'pc' && $site != 'mobile'){
				parse_str($_SERVER["QUERY_STRING"], $output);
				unset($output['game']); // remove the make parameter
				$redirect = $title.'.html'.(count($output)>0?'?':'').http_build_query($output);
				$this->forward(Core_Global::getApplicationIni()->app->static->site->site_url."?redirect=".base64_encode($redirect));
			} 
			else if($site == 'mobile'
					&& $title != 'tin-tuc' && $title != 'danh-sach-tin-tuc'
					&& $title != 'tim-kiem' && $title != 'danh-sach-tim-kiem'
					&& $title != 'tiep-nhan-thong-tin-lua-dao'
					&& $title != 'thong-bao-gui-yeu-cau'
					&& $title != 'index' && 
                                        $title != 'lien-he' 
                                        && $title != 'gui-yeu-cau'
                                        && $title != 'yeu-cau-da-gui'
                                        && $title != 'chi-tiet-yeu-cau'
                                        && $title != 'gui-gop-y'
                                        && $title != 'gop-y-da-gui'
                                        && $title != 'chi-tiet-gop-y')
				$this->forward(Core_Global::getApplicationIni()->app->static->site->site_url);
				
				// die;
            $this->render('header', array(
                'userInfo' => $userInfo,
                'site' => $site,
		'game' => '?game='.$site
            ));
			
	}					
}
?>
