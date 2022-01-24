<?php


namespace App\Http\Controllers\Functions;

use App\Dao\ReportDao;
use App\Models\User;
use DateTime;

class MessageExpiryFunction
{
    
    static function messageExpiry($expiryDate) {

		
            $expiry=$expiryDate;
            $nowDate=now();

            $date1 = new DateTime($expiry);
            $date2 = new DateTime($nowDate);
            $diff = $date1->diff($date2);

            $result="";
            if(  $diff->days <31) {
                $result= "Su cuenta expira en ".$diff->days." días";
            }
            if( $diff->days==1) {
                $result= "Su cuenta expira en ".$diff->days." día";
            }
            if( $diff->days==0) {
                $result= "Su cuenta expira hoy!!! ";
            }
        
            return $result;
        
    }
}
