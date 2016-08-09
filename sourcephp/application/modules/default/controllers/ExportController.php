<?php

/**
 * Created by PhpStorm.
 * User: bangnk
 * Date: 8/9/16
 * Time: 7:29 AM
 */
class ExportController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);
    }

    public function excel()
    {
        $output = '  
                <table class="table" bordered="1">  
                     <tr>  
                          <th>Id</th>  
                          <th>First Name</th>  
                          <th>Last Name</th>  
                     </tr>  
           ';

        $output .= '</table>';
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=download.xls");
        echo $output;
    }
}