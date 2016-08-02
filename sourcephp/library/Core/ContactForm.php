<?php

class Core_ContactForm {

    private $config;
    protected static $_instance = null;
    private $form1 = '<div class="form-group">
                                <label class="col-sm-3 col-xs-12 control-label">Tên khách hàng </label>
                                <div class="col-sm-5 col-xs-12">
                                    <input class="form-control" name="cstoolContactName"  placeholder="Tên khách hàng">
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group" id="contactphone">
                                <label class="col-sm-3 col-xs-12 control-label">Điện thoại liên hệ </label>
                                <div class="col-sm-5 col-xs-12">
                                    <input class="form-control" name="cstoolContactPhone"  placeholder="Số điện thoại liên hệ">
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                </div>
                            </div>
                            
                            <div class="form-group" id="contactemail">
                                <label class="col-sm-3 control-label">Email liên hệ </label>
                                <div class="col-sm-5">
                                    <input class="form-control"  name="cstoolEmailContact" placeholder="Email liên hệ">
                                </div>
                                <div class="col-sm-4">
                                </div>
                            </div>
                            
        ';

    public function __construct() {
        $this->config = Core_Global::getApplicationIni()->app->static->api;
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance; //singleton
    }

    public static function getFormContact($account, $idform = 0) {
        if ($account != '') {
            $arrInfoAccount = Core_PostRequest::getInstance()->getInfoAccountByAccount($account);
            $contactname = '';
            $phonenumber = '';
            $timecontact = '';
            $emailcontact = '';
            if ($arrInfoAccount == 'No_data') {
                $form = '<div class="form-group" id="contactphone">
                                <label class="col-sm-3 col-xs-12 control-label">Điện thoại liên hệ <span class="red">*</span></label>
                                <div class="col-sm-5 col-xs-12">
                                    <input type="number" class="form-control" name="cstoolContactPhone"  placeholder="Số điện thoại liên hệ">
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <span class="red" id="Phone-Error"></span>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="col-sm-3 col-xs-12 control-label">Tên khách hàng </label>
                                <div class="col-sm-5 col-xs-12">
                                    <input class="form-control" name="cstoolContactName" placeholder="Tên khách hàng">
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                </div>
                            </div>
                            
                           
                            <div class="form-group hide" id="contactemail">
                                <label class="col-sm-3 control-label">Email liên hệ </label>
                                <div class="col-sm-5">
                                    <input type="textbox" class="form-control"  name="cstoolEmailContact" placeholder="Email liên hệ">
                                </div>
                                <div class="col-sm-4">
                                    <span class="red" id="Email-Error"></span>
                                </div>
                            </div>                            
        ';
            } else {
                $arrInfo = json_decode($arrInfoAccount);
                $arrInfo = $arrInfo->Data[0];

                if ($arrInfo->AccountName != '') {
                    $contactname = $arrInfo->AccountName;
                } else {
                    $contactname = 'Tên khách hàng';
                }
                $checkinfopp = Core_User::getInstance()->checkAccountFromPassport($account);
                if ($arrInfo->PhoneContact != '') {
                    if ($arrInfo->PhoneContact != $checkinfopp->string[14]) {
                        $phonenumber = $arrInfo->PhoneContact;
                    } else {
                        $phonenumber = strlen($arrInfo->PhoneContact) > 10 ? '********' . (substr($arrInfo->PhoneContact, -3)) : '*******' . (substr($arrInfo->PhoneContact, -3));
                    }
                } else {
                    $phonenumber = 'Số điện thoại liên hệ';
                }
                if ($arrInfo->ContactTime != '') {
                    $timecontact = $arrInfo->ContactTime;
                } else {
                    $timecontact = 'Thời gian liên hệ';
                }
                if ($arrInfo->EmailContact != '') {
                    if ($arrInfo->EmailContact != $checkinfopp->string[3]) {
                        $emailcontact = $arrInfo->EmailContact;
                    } else {
                        $arrValue = explode('@', $arrInfo->EmailContact);
                        $firstValue = $arrValue[0];
                        $bottom = substr($firstValue, -3);
                        $emailcontact = '********' . $bottom . '@' . '*********';
                    }
                } else {
                    $emailcontact = 'Email liên hệ';
                }
                $form = '<div class="form-group" id="contactphone">
                                <label class="col-sm-3 col-xs-12 control-label">Điện thoại liên hệ <span class="red">*</span></label>
                                <div class="col-sm-5 col-xs-12">
                                    <input type="number" class="form-control" name="cstoolContactPhone"  placeholder="' . $phonenumber . '">
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <span class="red" id="Phone-Error"></span>
                                </div>
                            </div>
                            <div class="form-group hide" >
                                <label class="col-sm-3 col-xs-12 control-label">Tên khách hàng </label>
                                <div class="col-sm-5 col-xs-12">
                                    <input class="form-control" name="cstoolContactName"  placeholder="' . $contactname . '">
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                </div>
                            </div>                            
                            
                            <div class="form-group hide" id="contactemail">
                                <label class="col-sm-3 control-label">Email liên hệ </label>
                                <div class="col-sm-5">
                                    <input class="form-control"  name="cstoolEmailContact" placeholder="' . $emailcontact . '">
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <span class="red" id="Email-Error"></span>
                                </div>
                            </div>
                            ';
            }
            
        } else {
            $form = '<div class="form-group" id="contactphone">
                                <label class="col-sm-3 col-xs-12 control-label">Điện thoại liên hệ </label>
                                <div class="col-sm-5 col-xs-12">
                                    <input type="number" class="form-control" name="cstoolContactPhone"  placeholder="Số điện thoại liên hệ">
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                    <span class="red" id="Phone-Error"></span>
                                </div>
                            </div>
                            <div class="form-group hide">
                                <label class="col-sm-3 col-xs-12 control-label">Tên khách hàng </label>
                                <div class="col-sm-5 col-xs-12">
                                    <input class="form-control" name="cstoolContactName" placeholder="Tên khách hàng">
                                </div>
                                <div class="col-sm-4 col-xs-12">
                                </div>
                            </div>
                            
                            
                            <div class="form-group hide" id="contactemail">
                                <label class="col-sm-3 control-label">Email liên hệ </label>
                                <div class="col-sm-5">
                                    <input type="textbox" class="form-control"  name="cstoolEmailContact" placeholder="Email liên hệ">
                                </div>
                                <div class="col-sm-4">
                                    <span class="red" id="Email-Error"></span>
                                </div>
                            </div>                            
        ';
        }
        return $form;
    }

}
