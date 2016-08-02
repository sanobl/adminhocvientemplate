<?php
/**
/**
 * CBreadcrumbs displays a list of links indicating the position of the current page in the whole website.
 *
 * For example, breadcrumbs like "Home > Sample Post > Edit" means the user is viewing an edit page
 * for the "Sample Post". He can click on "Sample Post" to view that page, or he can click on "Home"
 * to return to the homepage.
 *
 * To use CBreadcrumbs, one usually needs to configure its {@link links} property, which specifies
 * the links to be displayed. For example,
 *
 * <pre>
 * $this->widget('Core_Breadcrumbs', array(
 *     'links'=>array(
 *         'Sample post'=>'post/view',
 *         'Edit',
 *     ),
 * ));
 * </pre>
 *
 * Because breadcrumbs usually appears in nearly every page of a website, the widget is better to be placed
 * in a layout view. One can define a property "breadcrumbs" in the base controller class and assign it to the widget
 * in the layout, like the following:
 *
 * <pre>
 * $this->widget('Core_Breadcrumbs', array(
 *     'links'=>$this->breadcrumbs,
 * ));
 * </pre>
 *
 */
class Core_Breadcrumbs extends Core_Widget
{
	/**
	 * @var string the tag name for the breadcrumbs container tag. Defaults to 'div'.
	 */
	public $tagName='ul';
	
	public $childTagName='li';
	/**
	 * @var array the HTML attributes for the breadcrumbs container tag.
	 */
	public $htmlOptions=array('class'=>'navigator');
	/**
	 * @var boolean whether to HTML encode the link labels. Defaults to true.
	 */
	public $encodeLabel=true;
	/**
	 * @var string the first hyperlink in the breadcrumbs (called home link).
	 * If this property is not set, it defaults to a link pointing to {@link CWebApplication::homeUrl} with label 'Home'.
	 * If this property is false, the home link will not be rendered.
	 */
	public $homeLink='/';
	/**
	 * @var array list of hyperlinks to appear in the breadcrumbs. If this property is empty,
	 * the widget will not render anything. Each key-value pair in the array
	 * will be used to generate a hyperlink by calling CHtml::link(key, value). For this reason, the key
	 * refers to the label of the link while the value can be a string or an array (used to
	 * create a URL). For more details, please refer to {@link CHtml::link}.
	 * If an element's key is an integer, it means the element will be rendered as a label only (meaning the current page).
	 *
	 * The following example will generate breadcrumbs as "Home > Sample post > Edit", where "Home" points to the homepage,
	 * "Sample post" points to the "index.php?r=post/view&id=12" page, and "Edit" is a label. Note that the "Home" link
	 * is specified via {@link homeLink} separately.
	 *
	 * <pre>
	 * array(
	 *     'Sample post'=>'post/view',
	 *     'Edit',
	 * )
	 * </pre>
	 */
	public $links=array();
	/**
	 * @var string the separator between links in the breadcrumbs. Defaults to ' &raquo; '.
	 */
	public $separator='';


	public $name='';
	
	public $url_support=array();
	/**
	 * Renders the content of the portlet.
	 */		
	
	public function run()
	{		
		if(empty($this->links))
			return;

		echo Core_Html::openTag($this->tagName,$this->htmlOptions)."\n";
		$links=array();
		if(isset($_GET['category']) || $this->links =='not category'){
			$links[]=Core_Html::openTag($this->childTagName, array('class'=>'noarrow')).Core_Html::link($this->homeLink, '/').Core_Html::closeTag($this->childTagName);
			$links[]=Core_Html::openTag($this->childTagName, array('class'=>'nohover')).Core_Html::link('Kết quả tìm kiếm', '').Core_Html::closeTag($this->childTagName);
		}else if ($this->links == 'support'){ // support subsite			
			$links[]=Core_Html::openTag($this->childTagName, array('class'=>'noarrow')).Core_Html::link($this->homeLink, '/').Core_Html::closeTag($this->childTagName);						
			if($name = $this->getRequest()->getParam('name')){
				$links[]=Core_Html::openTag($this->childTagName, array('class'=>'nohover')).Core_Html::link('Hỗ trợ', '').Core_Html::closeTag($this->childTagName);
				$links[]=Core_Html::openTag($this->childTagName, array('class'=>'nohover')).Core_Html::link($this->url_support[0], '').Core_Html::closeTag($this->childTagName);
				$links[]=Core_Html::openTag($this->childTagName, array('class'=>'nohover')).Core_Html::link($this->url_support[1], '').Core_Html::closeTag($this->childTagName);
				if(isset($this->url_support[2]) || !empty($this->url_support[2])){
					$links[]=Core_Html::openTag($this->childTagName, array('class'=>'nohover')).Core_Html::link($this->url_support[2], '').Core_Html::closeTag($this->childTagName);
				}
				if(isset($this->url_support[3]) || !empty($this->url_support[3])){
					$links[]=Core_Html::openTag($this->childTagName, array('class'=>'nohover')).Core_Html::link($this->url_support[3], '').Core_Html::closeTag($this->childTagName);
				}
			}else{
				$links[]=Core_Html::openTag($this->childTagName, array('class'=>'nohover')).Core_Html::link('Hỗ trợ', '').Core_Html::closeTag($this->childTagName);
			}			
		}else{														
			if($this->homeLink!==false)
				$links[]=Core_Html::openTag($this->childTagName, array('class'=>'noarrow')).Core_Html::link($this->homeLink, '/').Core_Html::closeTag($this->childTagName);						
			foreach($this->links as $label=>$url){			
				$links[]=Core_Html::openTag($this->childTagName).Core_Html::link($this->encodeLabel ? Core_Html::encode($label) : $label, $url).Core_Html::closeTag($this->childTagName);
			}
			//product name current position 
			$links[]=Core_Html::openTag($this->childTagName,array('class'=>'nohover')).Core_Html::link($this->encodeLabel ? Core_Html::encode($this->name) : $this->name, '').Core_Html::closeTag($this->childTagName);
		}		
		echo implode($this->separator,$links);
		echo Core_Html::closeTag($this->tagName);
	}
}