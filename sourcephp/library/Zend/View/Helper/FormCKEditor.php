<?php
class Zend_View_Helper_FormCKEditor extends Zend_View_Helper_FormElement
{
    public $rows = 8;

    public $cols = 60;
	
	public $basePath = "/ckeditor/";

    public function formCKEditor($name, $value = null, $attribs = null)
    {
		$info = $this->_getInfo($name, $value, $attribs);
        extract($info);
				
		if (!empty($attribs['rows'])) {
            $this->rows = (int)$attribs['rows'];
        }
        if (!empty($attribs['cols'])) {
			$this->cols = (int)$attribs['cols'];
        }
		if (!empty($attribs['basePath'])) {
			$this->basePath = $attribs['basePath'];
        }		
		if (!empty($attribs['configs'])) {
			$configs = $attribs['configs'];
        }
				
		$editor = new Core_CKEditor();
		$editor->basePath = $this->basePath;
		$editor->textareaAttributes["rows"] = $this->rows;
		$editor->textareaAttributes["cols"] = $this->cols;
		
		if(empty($configs['toolbar'])){
			$configs['toolbar'] = array(	array('Source'),
											array('Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
											array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'),
											array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
											'/',
											array('Styles','Format','Font','FontSize'),
											array('TextColor','BGColor'),
											array('Maximize', 'ShowBlocks'),
											array('Image'));
		
			$configs['filebrowserImageBrowseUrl']  = '/admin/upload/index';			
		}		
		
		return $editor->editor($this->view->escape($name), $value, $configs);
    }
}
?>