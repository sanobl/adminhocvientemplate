<?php 
class Widget_Public_Layout extends Core_Widget{	
	public function run(){		
		$page = Core_Page::getInstance();		
		if($layout = $page->_page['layout']){
			$this->render("template/{$layout}");
		}else{
			throw new Zend_Exception(Core_Global::getMessage()->public_error404);
		}
	}
}
?>