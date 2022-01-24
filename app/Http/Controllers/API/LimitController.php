<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Limit;
use App\Models\User;
use Illuminate\Http\Request;

class LimitController extends Controller
{
    public function store($id,Request $request)
    {
        $user=User::find($id);
      
        $limit=new Limit();
        $limit->month=$request->month;
        $limit->year=$request->year;
        $limit->limit=$request->limit;
        $limit->user_id= $user->id;
        $limit->save();
        
         return  $limit;
    }

    public function getAll($id)
    {
        $user=User::find($id);
        $allLimits =$user->limit;
	    $allLimitsByOrder = collect([]);
		foreach($allLimits as $found) {
            
				$newLimit = new Limit();
				$newLimit->id=$found->id;
				$newLimit->month=$found->month;
				$newLimit->year=$found->year;
				$newLimit->limit=$found->limit;
				$allLimitsByOrder->push($newLimit);          
		
		}
        return $allLimitsByOrder->all();
    }

}
