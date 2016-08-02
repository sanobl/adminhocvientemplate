<?php

class Core_Page {

    protected static $_instance = null;
    public $_request = null;
    public $_view = null;
    public $image;
    public $_page = array(
        'title' => null,
        'meta' => array(
            'description' => null,
            'keywords' => null,
            'robots' => null,
        ),
        'layout' => null,
        'widget' => array()
    );

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function init($request, $view) {
        $this->_request = $request;
        $this->_view = $view;
    }

    public function load() {
	
//        $title = $this->_request->getParam('title');
//        $index4 = $this->_request->getParam('index4');
//        if( $title == ''){
//            if(isset($index4))
//                $title = 'guidedetail';
//            else 
//                $title = 'index';
//        }
        $title = $this->_request->getParam('title');
//		if (preg_match("/^\/([0-9a-z\-]+\/)?([0-9a-z\-]*)_([0-9a-z\-]*)_([0-9a-z\-]*)_([0-9a-z\-]*)_([0-9a-z\-]*)\.html\?tfolder/", $_SERVER['REQUEST_URI'])) {
//			$title = 'guidedetail';
//		}
        $URI = $_SERVER['REQUEST_URI'];
        if (preg_match("/^\/(gui-yeu-cau\/)/", $URI)) {
                $title = 'gui-yeu-cau';                
        }
        else if (preg_match("/^\/(tin-tuc\/)/", $URI)) {
                $title = 'tin-tuc';                
        }
        else if (preg_match("/^\/(tim-kiem\/)/", $URI)) {
                $title = 'tim-kiem';                
        }
        if( $title == ''){
               $title = 'index';
        }
        $req = array(
            //'title' => $this->_request->getParam("title", "index"),
            'title' => $title,
            'category_id' => $this->_request->getParam("category_id"),
            'product_id' => $this->_request->getParam("product_id"),
        );
        list($this->_page, $req) = Model_Page::getInstance()->find($req);  		
        if (!empty($this->_page) && !empty($req)) {
            foreach ($req as $k => $v) {
                $this->_request->setParam($k, $v);
                if (preg_match('/^meta\_(\w+)$/', $k, $match)) {
                    if ('title' == $match[1]) {
                        if (!empty($this->_page['title'])) {
                            $this->_page['title'] = strtr($this->_page['title'], array('{title}' => $v));
                        } else {
                            $this->_page['title'] = $v;
                        }
                    } else {
                        if (!empty($this->_page['meta'][$match[1]])) {
                            $this->_page['meta'][$match[1]] = strtr($this->_page['meta'][$match[1]], array('{' . $match[1] . '}' => $v));
                        } else {
                            $this->_page['meta'][$match[1]] = $v;
                        }
                    }
                }
            }
        }
		 if (empty($this->_page)) {
		          echo '<table width="600" cellspacing="0" cellpadding="20" border="0" align="center" style="border: 1px dashed #999999">
  <tbody><tr>
    <td align="center"><center>
    <p style="color:#FF0000">Hệ thống không tìm thấy trang bạn yêu cầu, Xin vui lòng kiểm tra lại URL!</p>
    [ <a href="/">Quay lại trang chủ</a> ]
    <br>
    </center>
                </td>
  </tr>
</tbody></table>';die;

            $this->_request->setParam('sp_site_page_find', $req);
            throw new Zend_Exception(Core_Global::getMessage()->public_error404);
        }

//        if (empty($this->_page['title']))
//            $this->_page['title'] = PAGE_TITLE;
        if (empty($this->_page['meta']['description']))
            $this->_page['meta']['description'] = PAGE_DESCRIPTION;

        if (empty($this->_page['meta']['keywords']))
            $this->_page['meta']['keywords'] = PAGE_KEYWORDS;       

//        if (!empty($this->_page['title'])) {
//            $this->_page['title'] = str_replace('| hotro.zing.vn', '', $this->_page['title']) . ' | hotro.zing.vn';
//        }

        if ($meta = Model_MetaData::find()) {
            if (!empty($meta['title'])) {
                $this->_page['title'] = $meta['title'];
            }
            if (!empty($meta['description'])) {
                $this->_page['meta']['description'] = $meta['description'];
            }
            if (!empty($meta['keywords'])) {
                $this->_page['meta']['keywords'] = $meta['keywords'];
            }
        }
    }

    public function loadProduct($title) {
        $req = array(
            'title' => $title,
            'category_id' => $this->_request->getParam("category_id"),
            'product_id' => $this->_request->getParam("product_id"),
        );
        list($this->_page, $req) = Model_Page::getInstance()->find($req);  		
        if (!empty($this->_page) && !empty($req)) {
            foreach ($req as $k => $v) {
                $this->_request->setParam($k, $v);
                if (preg_match('/^meta\_(\w+)$/', $k, $match)) {
                    if ('title' == $match[1]) {
                        if (!empty($this->_page['title'])) {
                            $this->_page['title'] = strtr($this->_page['title'], array('{title}' => $v));
                        } else {
                            $this->_page['title'] = $v;
                        }
                    } else {
                        if (!empty($this->_page['meta'][$match[1]])) {
                            $this->_page['meta'][$match[1]] = strtr($this->_page['meta'][$match[1]], array('{' . $match[1] . '}' => $v));
                        } else {
                            $this->_page['meta'][$match[1]] = $v;
                        }
                    }
                }
            }
        }
       
        if (empty($this->_page)) {
		          echo '<table width="600" cellspacing="0" cellpadding="20" border="0" align="center" style="border: 1px dashed #999999">
  <tbody><tr>
    <td align="center"><center>
    <p style="color:#FF0000">                                         Hệ thống không tìm thấy trang bạn yêu cầu, Xin vui lòng kiểm tra lại URL   !                       </p>
                                                                [ <a href="/">Quay lại trang chủ</a> ]
                                                                <br>
    </center>
                </td>
  </tr>
</tbody></table>';die;

            $this->_request->setParam('sp_site_page_find', $req);
            throw new Zend_Exception(Core_Global::getMessage()->public_error404);
        }

//        if (empty($this->_page['title']))
//            $this->_page['title'] = PAGE_TITLE;

        if (empty($this->_page['meta']['description']))
            $this->_page['meta']['description'] = PAGE_DESCRIPTION;

        if (empty($this->_page['meta']['keywords']))
            $this->_page['meta']['keywords'] = PAGE_KEYWORDS;       

//        if (!empty($this->_page['title'])) {
//            $this->_page['title'] = str_replace('| hotro.zing.vn', '', $this->_page['title']) . ' | hotro.zing.vn';
//        }

        if ($meta = Model_MetaData::find()) {
            if (!empty($meta['title'])) {
                $this->_page['title'] = $meta['title'];
            }
            if (!empty($meta['description'])) {
                $this->_page['meta']['description'] = $meta['description'];
            }
            if (!empty($meta['keywords'])) {
                $this->_page['meta']['keywords'] = $meta['keywords'];
            }
        }
    }
    public function getPane($i) {
        return isset($this->_page['widget'][$i]) ? $this->_page['widget'][$i] : array();
    }

}

?>