<?php
define('APP_MSG', 'appMessage');
define('APP_CONFIG', 'appConfig');
define('APP_NAVIGATION', 'appNavigation');
define('CACHING_PREFIX', 'hotro-');
define('CACHING_CONFIG', 'cachingConfig');
define('PARENT_PARAMS_CONFIG', 'parentParams');
define('RUN_EVN', 'staging');
define('APP_SITECONFIG', '1');
define('APP_TYPEFOLDER_PRODUCT', '0');
define('APP_TYPEFOLDER_ACC', '1');
define('APP_TYPEFOLDER_PAYMENT', '2');
define('APP_TYPEFOLDER_HOMEPAGE', '4');
define('PRODUCTAUTO', '162,164,150,166,165,207,189,156,210');

define('CONFIG_TRACKING', serialize(array (
	'trackingAction' => '3',//0 khong tracking, 1 call db directly, 2 call service BE , 3 su dung Scribe Log
	'scribeServers' => '10.199.18.122',
	'trackingConfig' => array(
                                    '1' => 1, //View guide detail
                                    '2' => 1, //Search guide on search_Page
                                    '3' => 1, //List guide
                                    '5' => 1, //Post request
                                    '6' => 1, //Post request quickly (none login)
                                    '8' => 1, //Login
                                    '9' => 1, //Logout
                                    '10' => 1, //View detail postedrequest
                                    '11' => 1, //View detail postedrequest none login (from email)
                                    '12' => 1, //Home
                                    '14' => 1, //View list of posted request
                                    '16' => 1, //Confirm posted request
                                    '17' => 1, //Change CID form 1
                                    '18' => 1, //Change CID Confirm posted request
                                    '19' => 1, //Resend sms code
                                    '20' => 1, //Change CID post request
                                    '21' => 1, //Change SMS info
                                    '22' => 1, //View register SMS
                                    '23' => 1, //Register SMS
                                    '24' => 1, //lien he
                                    '25' => 1, //gop ý
                                    ), 
)));

define('PAGE_DESCRIPTION', 'Nhà thiếu nhi quận 4 - Thành phố Hồ Chí Minh');
define('PAGE_KEYWORDS', 'nha thieu nhi, quan 4, ho chi minh');
define('PAGE_TITLE','Nhà thiếu nhi quận 4 - Hồ Chí Minh');
?>
