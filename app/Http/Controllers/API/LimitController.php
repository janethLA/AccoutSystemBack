<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Limit;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class LimitController extends Controller
{
    public function store($id, Request $request)
    {
        //$user=User::find($id);
        $expense = Expense::find($id);

        $limit = new Limit();
        $limit->month = $request->month;
        $limit->year = $request->year;
        $limit->limit = $request->limit;
        $limit->expense_id = $expense->id;
        $limit->save();

        return  $limit;
    }

    public function getByAccount( $idExpense,$year)
    {
        $expense = Expense::find($idExpense);
        $allLimits = $expense->limit;
        $allLimitsByOrder = collect([]);

        if($allLimits->isNotEmpty()){
            foreach ($allLimits as $found) {

                // $date = strtotime($year);
                // $foundYear = date("Y", $date);
                // echo $foundYear;
                if ($found->year == $year) {
    
                    $newLimit = new Limit();
                    $newLimit->id = $found->id;
                    $newLimit->month = $found->month;
                    $newLimit->year = $found->year;
                    $newLimit->limit = $found->limit;
                    $allLimitsByOrder->push($newLimit);
                };
            }
        }
       
        return $allLimitsByOrder->all();
    }

    public function updateLimit(Request $request)
    {

        $limit = Limit::find($request->idLimit);

        $limit->limit = $request->limit;
        $limit->save();
        return $limit;
    }
}
