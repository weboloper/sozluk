<?php
 
namespace Weboloper\Utils;

use Phalcon\Di\Injectable;

 
class ZFunction extends Injectable
{


	public static function getHumanDate($date)
    {
        $diff = time() - $date;
        if ($diff > (86400 * 30)) {
            return date(' j.m.y   h:i', $date);
        } else {
            if ($diff > 86400) {
                return ((int)($diff / 86400)) . ' gün önce';
            } else {
                if ($diff > 3600) {
                    return ((int)($diff / 3600)) . ' sa önce';
                } else {
                    return ((int)($diff / 60)) . ' dk önce';
                }
            }
        }
    }

}