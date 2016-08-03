<?php

class Core_Utilities
{

    public static function convertListDayToVN($ls)
    {
        $str = '';
        $arr = explode(',', $ls);
        if (count($arr) > 0) {
            foreach ($arr as $ar) {

                switch ($ar) {
                    case 'monday':
                        $str .= 'Hai,';
                        break;
                    case 'tuesday':
                        $str .= 'Ba,';
                        break;
                    case 'wednesday':
                        $str .= 'Tư,';
                        break;
                    case 'thursday':
                        $str .= 'Năm,';
                        break;
                    case 'friday':
                        $str .= 'Sáu,';
                        break;
                    case 'saturday':
                        $str .= 'Bảy,';
                        break;
                    case 'sunday':
                        $str .= 'Chủ nhật,';
                        break;
                    default:
                        break;
                }
            }
        }
        return trim($str, ",");
    }
}