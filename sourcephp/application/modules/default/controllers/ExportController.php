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

    public function excelAction()
    {
        $output = '<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8"> 
</head>
<style>.xlText { mso-number-format: "\@"; } th,td { border:solid 0.1pt #000000; }body { border:solid 0.1pt #000000; }</style>';
        $output .= '  
                <table class="table">  <THEAD>
                     <tr>  
                          <th>Id</th>  
                          <th>First Name</th>  
                          <th>Last Name</th>  
                     </tr>  </THEAD>
                     <TBODY>
                      <tr>  
                          <th>1</th>  
                          <th>First Name</th>  
                          <th>Last Name</th>  
                     </tr>  </TBODY>

           ';

        $output .= '</table>';
//        header("Content-Type: application/xlsx");
//        header("Content-Disposition: attachment; filename=download.xlsx");
//        header("Content-Type: application/vnd.ms-excel;");
//        header("Content-Disposition: attachment; filename=reports.xls");
//        header("Pragma: no-cache");
//        header("Expires: 0");
        header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
        header("Content-Disposition: attachment; filename=card-history-reports.xls");
//        header("Pragma: no-cache");
//        header("Expires: 0");
        echo $output;
        die;
    }

}