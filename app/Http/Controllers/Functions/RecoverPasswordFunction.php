<?php


namespace App\Http\Controllers\Functions;

use App\Dao\UserPasswordDao;
use App\Models\User;
use DateTime;
use Exception;

class RecoverPasswordFunction
{
    
    static function recover($telephone) {

        $user=new UserPasswordDao();
    	try {
    		$u=User::select()->where('telephone','=',$telephone)->first();
            // $date1 = new DateTime(now());
            // $date2 = new DateTime("2021-10-10");
            // $diff = $date1->diff($date2);
            // echo $diff->days;

    		if($u->active==true && $u->expiry_date>now()){
    			$user->setIdUser($u->id);
    		}else {
    			$user=null;
    		}
    		
		} catch (Exception $e) {
				$user=null;
		}
    	return $user ;
    }
}