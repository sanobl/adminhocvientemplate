<?php
class Widget_Public_Footer extends Core_Widget
{
	public function run(){
		$site = strtolower(trim($this->getRequest()->getParam('game')));
            $this->render('footer', array(
                'site' => $site,
				'game' => '?game='.$site			
            ));
            
            
	}					
}
?>