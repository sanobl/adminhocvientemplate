<?php

class Core_CheckKey {

    private $config;
    protected static $_instance = null;
    public static $keychangeserver = array(
        'myplus' => 'bXlwbHVzY3N2bmc3MjAxNQ=='
    );
    public static $keyset = array(
        338 => 'bXlwbHVzdm5nY3M=',
        357 => 'dGxiYjNkbXZuZ2Nz',
        201 => 'bG9uZ3R1b25ndm5nY3M=',
        264 => 'dGhvaWxvYW52bmdjcw==',
        286 => 'Z2lhaWN1dXZuZ2Nz',
        267 => 'bGllbm1pbmh2bmdjcw==',
        265 => 'dHVvbmd0aGFudm5nY3M=',
        294 => 'dmxjbTJ2bmdjcw==',
        231 => 'YWlteW5oYW52bmdjcw==',
        257 => 'dHBhaGN2bmdjcw==',
        293 => 'dmxodXllbnRob2Fpdm5nY3M=',
        284 => 'dmxsdWFua2llbXZuZ2Nz',
        345 => 'ZG90YWxlZ2VuZHZuZ2Nz',
        295 => 'QVpBSFR2bmdjcw==',
        236 => 'QVpCQnZuZ2Nz',
        297 => 'QVpCTEV2bmdjcw==',
        298 => 'QVpCRER2bmdjcw==',
        237 => 'QVpDSEx2bmdjcw==',
        300 => 'QVpDSFZ2bmdjcw==',
        343 => 'QVpDVk12bmdjcw==',
        271 => 'QVpDVkl2bmdjcw==',
        240 => 'QVpESFR2bmdjcw==',
        301 => 'QVpETkF2bmdjcw==',
        302 => 'QVpGUHZuZ2Nz',
        303 => 'QVpGUDJ2bmdjcw==',
        330 => 'QVpHSEt2bmdjcw==',
        242 => 'QVpHVEt2bmdjcw==',
        305 => 'QVpHVkl2bmdjcw==',
        306 => 'QVpHVUJ2bmdjcw==',
        307 => 'QVpIVDJ2bmdjcw==',
        308 => 'QVpIVkd2bmdjcw==',
        309 => 'QVpIVFR2bmdjcw==',
        310 => 'QVpIUDJ2bmdjcw==',
        311 => 'QVpIVEF2bmdjcw==',
        312 => 'QVpLREl2bmdjcw==',
        314 => 'QVpMUVV2bmdjcw==',
        315 => 'QVpMS0l2bmdjcw==',
        269 => 'QVpMVEh2bmdjcw==',
        341 => 'QVpNQlZ2bmdjcw==',
        317 => 'QVpOSE92bmdjcw==',
        331 => 'QVpOVVR2bmdjcw==',
        332 => 'QVpQSUd2bmdjcw==',
        238 => 'QVpQT0t2bmdjcw==',
        268 => 'QVpUUUN2bmdjcw==',
        320 => 'QVpUSFR2bmdjcw==',
        340 => 'QVpUVEt2bmdjcw==',
        322 => 'QVpUQ0JUdm5nY3M=',
        325 => 'QVpUSFV2bmdjcw==',
        326 => 'QVpUT1V2bmdjcw==',
        333 => 'QVpUQkN2bmdjcw==',
        327 => 'QVpUUVB2bmdjcw==',
        328 => 'QVpUVEx2bmdjcw==',
        342 => 'QVpUVFR2bmdjcw==',
        241 => 'QVpWSEl2bmdjcw==',
        239 => 'QVpTSFR2bmdjcw==',
        329 => 'QVpYREV2bmdjcw==',
        359 => 'QVpNQ1R2bmdjcw==',
        360 => 'QVpPUE92bmdjcw==',
        361 => 'QVpLdm5nY3M=',
        362 => 'QVpLVHZuZ2Nz',
        363 => 'QVpMVjJ2bmdjcw==',
        364 => 'QVpDQ1ZWdm5nY3M=',
        365 => 'QVpEVHZuZ2Nz',
        366 => 'QVpEQ0x2bmdjcw==',
        367 => 'QVpWVHZuZ2Nz',
        368 => 'QVpURERCdm5nY3M=',
        369 => 'QVpOSFR2bmdjcw==',
        370 => 'QVpUREt2bmdjcw==',
        371 => 'QVpURHZuZ2Nz',
        372 => 'QVpUUVRCdm5nY3M=',
        373 => 'QVpCVkxDdm5nY3M=',
        352 => 'Q0JHdm5nY3M=',
        227 => 'WmFsb3ZuZ2Nz',
        289 => 'MzYwR0FNRXZuZ2Nz',
        374 => 'aUNhdm5nY3M=',
        229 => 'UEFZTUVOVHZuZ2Nz',
        336 => 'WkFMT1B2bmdjcw==',
        280 => 'Rk1SWnZuZ2Nz',
        162 => 'R052bmdjcw==',
        351 => 'R05Ddm5nY3M=',
        188 => 'SFJ2bmdjcw==',
        189 => 'S1ZUTXZuZ2Nz',
        182 => 'V0xZdm5nY3M=',
        288 => 'RlZ2bmdjcw==',
        213 => 'VEtIVUN2bmdjcw==',
        180 => 'SUFOdm5nY3M=',
        258 => 'SUFOVlVJR3ZuZ2Nz',
        426 => 'SUFOWk12bmdjcw==',
        252 => 'SUFOWlBMdm5nY3M=',
        192 => 'WlBMdm5nY3M=',
        254 => 'MlV2bmdjcw==',
        348 => 'QkN2bmdjcw==',
        204 => 'RFJGQnZuZ2Nz',
        261 => 'TUNLdm5nY3M=',
        276 => 'SkpTR3ZuZ2Nz',
        290 => 'VFZMSkJTdm5nY3M=',
        169 => 'Wk12bmdjcw==',
        163 => 'WlN2bmdjcw==',
        282 => 'OUt2bmdjcw==',
        151 => 'Qm5Cdm5nY3M=',
        220 => 'M1F2bmdjcw==',
        285 => 'WUxaVHZuZ2Nz',
        158 => 'RlN2bmdjcw==',
        337 => 'S1MxMTN2bmdjcw==',
        150 => 'Slgydm5nY3M=',
        216 => 'Slgzdm5nY3M=',
        165 => 'S1RIRXZuZ2Nz',
        281 => 'SlgxQ1RDdm5nY3M=',
        166 => 'SlhGdm5nY3M=',
        164 => 'Slgxdm5nY3M=',
        283 => 'Q09DQ01Cdm5nY3M=',
        291 => 'QUhDSHZuZ2Nz',
        349 => 'Q1RNR1NOdm5nY3M=',
        251 => 'Rk1Sdm5nY3M=',
        260 => 'RkhNR1NTdm5nY3M=',
        346 => 'R05Ndm5nY3M=',
        263 => 'S1ZUTU1Cdm5nY3M=',
        287 => 'WkxNT0NISXZuZ2Nz',
        262 => 'V0xZTUJ2bmdjcw==',
        335 => 'TUFUQ0hBdm5nY3M=',
        347 => 'VFBEQ3ZuZ2Nz',
        192 => 'TVBMQXZuZ2Nz',
        354 => 'V0pYMnZuZ2Nz',
        375 => 'S1ZUTTJ2bmdjcw==',
        376 => 'UFJPSkVDVEtWTkdDU1RE',
        355 => 'RlNXVk5HQ1NURA==',
        339 => 'REJWTkdDU1RE',
        379 => 'QlBWTkdDU1RE',
        378 => 'Q1RWU0NTVERWTkc=',
        380 => 'VEZaRkJTMkNTVERWTkc=',
        381 => 'TVVIVGhvYWlDU1REVk5H',
        384 => 'RE1ITVAxVk5HQ1NURA==',
        385 => 'UVZIVE1QMVZOR0NTVEQ=',
        386 => 'VEdWTkdDU1RE',
        387 => 'RFBUS1ZOR0NTVEQ=',
        388 => 'UE1DTE1QNlZOR0NTVEQ',
        350 => 'SEFDUVZOR0NTVEQ=',
        382 => 'SFhWTkdDU1RE',
        383 => 'QkMyVk5HQ1NURA==',
        389 => 'QkZWTkdDU1RE',
        398 => 'M0dUS1ZOR0NTVEQ=',
        424 => 'U0dNR0ZCUzFWTkdDU1RE',
        425 => 'TlNUVFZOR0NTVEQ=',
        426 => 'VFRIU1ZOR0NTVEQ=',
        399 => 'VExCQldWTkdDU1RE',
        400 => 'QVo0MzNWTkdDU1RE',
        401 => 'QVo0VFZOR0NTVEQ=',
        412 => 'QVpPUEkyVk5HQ1NURA==',
        428 => 'QVpUR0RDVk5HQ1NURA==',
        429 => 'QVpOR1RWTkdDU1RE',
        430 => 'QVpMTVdWTkdDU1RE',
        431 => 'TklLUEcyVk5HQ1NURA==',
        432 => 'SFRDUEcxVk5HQ1NURA==',
        433 => 'RFBQRzNWTkdDU1RE',
        434 => 'VFZMUEcxVk5HQ1NURA==',
        435 => 'WlNNVk5HQ1NURA==',
        436 => 'QkxSUFBWTkdDU1RE',
        437 => 'UHJvamVjdFNNVk5HQ1NURA==',
        438 => 'QVpMS1RIVk5HQ1NURA==',
        439 => 'QVpLWVRWTkdURENT',
        440 => 'QVpIQ1RNVk5HQ1NURA==',
        441 => 'QVpMREhNVk5HQ1NURA==',
        442 => 'QVpDS1ZOR0NTVEQ=',
        443 => 'TFZWTkdDU1RE',
        444 => 'Q1RQR1NOVk5HQ1NURA==',
        445 => 'UFZNUDJWTkdDU1RE',
        446 => 'M1FNUEcyVk5HQ1NURA==',
        447 => 'VFRUUVZOR0NTVEQ=',
        448 => 'Q0tWTkdDU1RE',
        449 => 'RzEwU0VBUFBWTkdDU1RE',
        450 => 'S0ZDVk1QMVZOR0NTVEQ=',
        451 => 'QktMUk1QMlZOR0NTVEQ=',
        452 => 'Q1RNUDZWTkdDU1RE',
        453 => 'Q0FDS1BHM1ZOR0NTVEQ=',
        454 => 'TVBHU05WTkdDU1RE',
        455 => 'RElTTkVZTVAxQ1NURFZORw==',
        456 => 'RENUQ1NURFZORw==',
        457 => 'RlRHRkJTMlZOR0NTVEQ=',
        458 => 'QkMzVk5HQ1NURA==',
        459 => 'TklOSkFDU1REVk5H',
        460 => 'S1ZDU1REVk5H',
        461 => 'WlBUR1NOQ1NURFZORw==',
    );
    public static $offsite = array(
        220,237,240,241,242,268,295,297,298,300,302,303,305,306,307,309,311,312,315,317,320,325,327,328,330,332
        ,340,342,360,361,362,368,369,370,370,276,379
    );
    private $keyconfig = '';

    public function __construct() {
        $this->config = Core_Global::getApplicationIni()->app->static->api;
    }

    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance; //singleton
    }

    public static function checkkey($user, $productid, $inputvalue, $source, $sig) {
        $key = self::$keyset;
        $keyconfig = $key[$productid];
        //echo md5($user.$productid.$inputvalue.$keyconfig);
        if (md5($user . $productid . $inputvalue . $source . $keyconfig) == $sig) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public static function checkkeychangeserver($user, $productid, $source, $time, $platform, $sig) {
        $key = self::$keychangeserver;
        $keyconfig = $key[$source];
        if (md5($user . $productid . $source. $time. $platform . $keyconfig) == $sig) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public static function checkoffsite($productid){
        $off = self::$offsite;
        if (in_array($productid, $off)) {
            return TRUE;
        }else {
            return FALSE;
        }
    }

}
?>

