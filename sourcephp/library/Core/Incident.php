<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Core_Incident {
    private $config;
    protected static $_instance = null;

    public function __construct() {
        $this->config = Core_Global::getApplicationIni()->app->static->api;
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance; //singleton
    }
    /*
     * get list current incident 
     */
    public function GetListIncOfForm($productId, $server, $formId, $conditionForm) {
//        $arrResult = array();
//        $arrResult[0] = 1;
//        $arrResult[1] = "INC-00001";
//        $arrResult[2] = "Test incident 1";
//        $arrResult[3] = "INC-00002";
//        $arrResult[4] = "Test incident 2";
//        
//        return $arrResult;
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'GET_LISTINC_OF_FORM';
            $aData["body"] = array($productId, $server, $formId, $conditionForm);
            $aData["userIP"] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
            $aData['signal'] = md5(md5($signal));

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
			//var_dump($arrResult);die;
            if ($arrResult[0] == "1" && $arrResult[1] != 'No_data') {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
			Core_Log::writeScribe(0, 0, 0, 33, 'Incident GetListIncOfForm, input: '+json_encode($aData['body'])+ ' error: '+ $e->getMessage());
            Core_SendMail::getInstance()->SendMailError('GetListIncOfForm (Lấy danh sách incident hien co )', $e->getMessage().'san pham: '.$productId.'server: '. $server.'form: '. $formId.'dien kien: '. $conditionForm);
            return '';
        }
    }
    public function GetListIncOfFormByProduct($productId) {
//        $arrResult = array();
//        $arrResult[0] = 1;
//        $arrResult[1] = "INC-00001";
//        $arrResult[2] = "Test incident 1";
//        $arrResult[3] = "0"; server
//        $arrResult[4] = "0"; formId
//        
//        return $arrResult;
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'GET_LISTINC_OF_FORM_BY_PRODUCT';
            $aData["body"] = array($productId);
            $aData["userIP"] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
            $aData['signal'] = md5(md5($signal));

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            if ($arrResult[0] == "1" && $arrResult[1] != 'No_data') {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
			Core_Log::writeScribe(0, 0, 0, 33, 'Incident GetListIncOfForm, input: '+json_encode($aData['body'])+ ' error: '+ $e->getMessage());
            Core_SendMail::getInstance()->SendMailError('GetListIncOfForm (Lấy danh sách incident hien co )', $e->getMessage().'san pham: '.$productId);
            return '';
        }
    }
    /*
     * get list field of incident 
     */
    public function GetListFieldINC($incidentCode) {
//        $arrResult = array();
//        $arrResult[0] = 1;
//        $arrResult[1] = 1;
//        $arrResult[2] = 1;
//        $arrResult[3] = "Số lần bị lỗi";
//        $arrResult[4] = 1;
//        $arrResult[5] = "";
//        $arrResult[6] = 2;
//        $arrResult[7] = "Thoi gian bị loi";
//        $arrResult[8] = 11;
//        $arrResult[9] = "";
//        $arrResult[10] = 3;
//        $arrResult[11] = "Loại điểm bị lỗi";
//        $arrResult[12] = 13;
//        $arrResult[13] = "vật phẩm;kinh nghiệm";
//        $arrResult[14] = 4;
//        $arrResult[15] = "Địa điểm";
//        $arrResult[16] = 3;
//        $arrResult[17] = "HCM;HN";
//        $arrResult[18] = 5;
//        $arrResult[19] = "check box";
//        $arrResult[20] = 12;
//        $arrResult[21] = "aaaaa;bbbbb";
//        
//        
//        return $arrResult;
        
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'GET_LISTFIELD_INC_BY_INCIDENTCODE';
            $aData["body"] = array($incidentCode);
            $aData["userIP"] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
            $aData['signal'] = md5(md5($signal));

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            
            if ($arrResult[0] == "1" && $arrResult[1] != 'No_data') {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
			Core_Log::writeScribe(0, 0, 0, 33, 'Incident GetListFieldINC, input: '+json_encode($aData['body'])+ ' error: '+ $e->getMessage());
            Core_SendMail::getInstance()->SendMailError('GetListFieldINC (Lấy danh sách field của inc đã chọn )', $e->getMessage().'incidentCode: '.$incidentCode);
            return '';
        }
    }
    /*
     * get incident from RequestId
     */
    public function GetIncByRequestId($requestId) {
//        $arrResult = array();
//        $arrResult[0] = 1;
//        $arrResult[1] = 'INC-00001';
//        $arrResult[2] = 'test thoi ma';
//        return $arrResult;
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'GET_INC_BY_REQUESTID';
            $aData["body"] = array($requestId);
            $aData["userIP"] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
            $aData['signal'] = md5(md5($signal));

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            
            if ($arrResult[0] == "1" && $arrResult[1] != 'No_data') {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
			Core_Log::writeScribe(0, 0, 0, 33, 'Incident GetIncByRequestId, input: '+json_encode($aData['body'])+ ' error: '+ $e->getMessage());
            Core_SendMail::getInstance()->SendMailError('GetIncByRequestId (Lấy incident cua requestId )', $e->getMessage().'requestId: '.$requestId);
            return '';
        }
    }
    
    /*
     * get templateAnswer from incidentCode
     */
    public function GetTemplateAnswerByIncCode($incCode) {
        try {
            $functionNo = 'RequestPortalService';
            $aData["serviceName"] = 'GET_TEMPLATE_BY_INCCODE';
            $aData["body"] = array($incCode);
            $aData["userIP"] = Core_Map::getIp();
            $aData['browserName'] = trim($_SERVER['HTTP_USER_AGENT']);
            $signal = $this->config->sig;
            $aData['signal'] = md5(md5($signal));

            $client = new SoapClient($this->config->support);
            $oResult = $client->__soapCall($functionNo, array($aData));
            $arrResult = $oResult->RequestPortalServiceResult->string;
            
            if ($arrResult[0] == "1" && $arrResult[1] != 'No_data') {
                return $arrResult;
            } else {
                return '';
            }
        } catch (Exception $e) {
			Core_Log::writeScribe(0, 0, 0, 33, 'Incident GetTemplateAnswerByIncCode, input: '+json_encode($aData['body'])+ ' error: '+ $e->getMessage());
            Core_SendMail::getInstance()->SendMailError('GetTemplateAnswerByIncCode (Lấy templateAnswer cua incident )', $e->getMessage().'incCode: '.$incCode);
            return '';
        }
    }
    /*public function Incform ($incCode){
        $listField = Core_Incident::getInstance()->GetListFieldINC($incCode);
        $value = '';
        $jScript = '';
        if ($listField != '' && $listField[1] != 'No_data') {
            for ($i = 2; $i < count($listField); $i = $i + 4) {
                if ($listField[$i + 2] == 11) {//datetime
                    $value .= '<div class="form-group">
                                    <label class="col-sm-3 col-xs-12 control-label">' . $listField[$i + 1] . '</label>
                                        <div class="col-sm-5 col-xs-12">
                                        <input class="form-control" type="text" id="cstool' . $incCode . $listField[$i] . '" name="cstool' . $incCode . $listField[$i] . '" placeholder="' . $listField[$i + 1] . '">
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <span id="cstoolError' . $incCode . $listField[$i] . '" class="FieldError"></span>
                                    </div>                                    
                               </div>
                               <script>
                                $("#cstool' . $incCode . $listField[$i] . '").datepicker({
                                        language: "vi",
                                        autoclose: true,
                                        todayHighlight: true
                                });
                                </script>
                        ';
                } else if ($listField[$i + 2] == 1) {//text
                    $value .= '<div class="form-group">
                                    <label class="col-sm-3 col-xs-12 control-label">' . $listField[$i + 1] . '</label>
                                        <div class="col-sm-5 col-xs-12">
                                        <input class="form-control" type="text" id="cstool' . $incCode . $listField[$i] . '" name="cstool' . $incCode . $listField[$i] . '" placeholder="' . $listField[$i + 1] . '">
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                        <span id="cstoolError' . $incCode . $listField[$i] . '" class="FieldError"></span>
                                    </div>                                    
                               </div>
                        ';
                } else if ($listField[$i + 2] == 13) {//radio
                    $defaultValue = explode(';', $listField[$i + 3]);
                    if (count($defaultValue) >= 1) {
                        $value .= '<input type="hidden" id="cstool' . $incCode . $listField[$i] . '" name="cstool' . $incCode . $listField[$i] . '" value="">
                                    <div class="form-group">
                                    <label class="col-sm-3 col-xs-12 control-label">' . $listField[$i + 1] . '</label>
                                        <div class="col-sm-5 col-xs-12">';
                        $value .= '<div class="radio radioinc" id="cach0">
                                    <label>
                                        <input type="radio" name="cstool' . $incCode . $listField[$i] . '" value="' . $defaultValue[0] . '" id="' . $incCode . '0">
                                        ' . $defaultValue[0] . '
                                    </label>
                                </div>';
                        for ($j = 1; $j < count($defaultValue); $j++) {
                            $value .= '<div class="radio radioinc" id="cach' . $j . '">
                                    <label>
                                        <input type="radio" name="cstool' . $incCode . $listField[$i] . '" value="' . $defaultValue[$j] . '" id="' . $incCode . $j . '">
                                         ' . $defaultValue[$j] . '
                                    </label>
                                </div>';
                        }
                        $value .= '</div>
                                    <div class="col-sm-4 col-xs-12">
                                        <span id="cstoolError' . $incCode . $listField[$i] . '" class="FieldError"></span>
                                    </div>                                    
                               </div>
                                ';
                    }
                } else if ($listField[$i + 2] == 12) {//check box
                    $defaultValue = explode(';', $listField[$i + 3]);
                    if (count($defaultValue) >= 1) {
                        $value .= '<input type="hidden" id="cstool' . $incCode . $listField[$i] . '" name="cstool' . $incCode . $listField[$i] . '" value="">
                                    <div class="form-group">
                                    <label class="col-sm-3 col-xs-12 control-label">' . $listField[$i + 1] . '</label>
                                        <div class="col-sm-5 col-xs-12">';
                        $value .= '<div class="checkbox checkboxinc" id="cach0">
                                    <label>
                                        <input type="checkbox"  value="' . $defaultValue[0] . '" id="' . $incCode . '0">
                                        ' . $defaultValue[0] . '
                                    </label>
                                </div>';

                        for ($j = 1; $j < count($defaultValue); $j++) {
                            $value .= '<div class="checkbox checkboxinc" id="cach' . $j . '">
                                    <label>
                                        <input  value="' . $defaultValue[$j] . '" type="checkbox" id="' . $defaultValue[$j] . '">
                                         ' . $defaultValue[$j] . '
                                    </label>
                                </div>';
                        }

                        $value .= '</div>
                                    <div class="col-sm-4 col-xs-12">
                                        <span id="cstoolError' . $incCode . $listField[$i] . '" class="FieldError"></span>
                                    </div>                                    
                               </div>
                                ';
                        $jScript .= ' $(".checkboxinc input:checkbox:checked").each(function(){
                                            $("#cstool' . $incCode . $listField[$i] . '").val($("#cstool' . $incCode . $listField[$i] . '").val()!=""?($("#cstool' . $incCode . $listField[$i] . '").val()+"@INC@"+$(this).val()):$(this).val());
                                        });
                                            
                                        ';
                    }
                } else if ($listField[$i + 2] == 3) {//combobox
                    $value .= '<div class="form-group">
                                        <label class="col-sm-3 col-xs-12 control-label">' . $listField[$i + 1] . '</label>
                                        <div class="col-sm-5 col-xs-12">
                                            <select class="form-control" id="cstool' . $incCode . $listField[$i] . '" name="cstool' . $incCode . $listField[$i] . '">';

                    $defaultValue = explode(';', $listField[$i + 3]);
                    $value .='<option value="">Vui lòng chọn</option>';
                    for ($j = 0; $j < count($defaultValue); $j++) {
                        $value .='<option value="' . $defaultValue[$j] . '">' . $defaultValue[$j] . '</option>';
                    }

                    $value.='               </select>
                                        </div>
                                        <div class="col-sm-4 col-xs-12">
                                            <span id="cstoolError' . $incCode . $listField[$i] . '" class="FieldError"></span>
                                        </div>
                                    </div>';
                }
            }
        }
        if ($jScript != '') {
            $value .= '<script>
                            
                            function isValidInputInc() {

                                //isValidInputInc = function () {
                                    var isValid = true; 
                                        ' . $jScript . '
                                    return isValid;
                                //}
                            }</script>';
        }
        echo $value;
        
    }*/
    public function GetListInc($productId,$formId){
        $server = 0;
        $conditionForm = 0;
        $listForm = Core_Incident::getInstance()->GetListIncOfForm($productId, $server, $formId, $conditionForm);
        $value = '';
        if ($listForm != '' && $listForm[1] != 'No_data') {
             //$value .= '<span class="introcontact class="col-sm-offset-3 col-sm-9 col-xs-12">'
            //         . '<i class="icobuld"></i> Hiện tại, Ban Quản Trị đang tiến hành ghi nhận các vấn đề dưới đây. Nếu gặp phải, Bạn hãy bổ sung thông tin để được hỗ trợ nhanh chóng hơn</span>';
            for ($i = 1; $i < count($listForm); $i = $i + 2) {
                $value .='<div class="checkbox" id="cach' . $i . '">
                        <label class="col-md-offset-3 col-md-6 col-xs-12">
                            <input type="checkbox" name="preoptioninc" value="' . $listForm[$i] . '" id="' . $listForm[$i] . '">
                            ' . $listForm[$i] . ' ' . $listForm[$i + 1] . '
                        </label>
                    </div>';
                $value .= '<div id="table' . $listForm[$i] . '" class="tableinc"></div>';
               
            }
        }

        if ($value != '') {        
            $value .= '<script type="text/javascript">
                    $("#inc input:checkbox").on("click", function() {
                        var inc = $(this).val();
                        if(!$(this).is(":checked"))
                        {
                            $("#inc input:checkbox").each(function(){
                                    $(this).attr("checked",false);
                            });
                            $(".tableinc").html("");
                            $("#cstool10111").val("");
                        }
                        else if($(this).is(":checked"))
                        {
                            
                            $(".tableinc").html("");
                            $(this).attr("checked",true);
                            $("#cstool10111").val(inc);
                            var control = $(this).parent().parent().parent();
                            $.ajax({
                                url: "/ajax/getlistfieldingame",
                                type: "POST",
                                cache: false,
                                async: false,
                                data: {
                                    inc:inc
                                },
                                success: function(result)
                                {
                                    if($.trim(result) != "")
                                    {
                                        control.find(".tableinc").html("");
                                        control.find("#table"+inc).html($.trim(result));
                                    }
                                    else
                                    {
                                        control.find(".tableinc").html("");
                                    }
                                }
                            });
                        }
                        
                    });
                    </script>';
        }
        return $value;
        }
    }
    
?>
