<?php

namespace App\Http\Controllers\API;

use App\Dao\IncomeDao;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Functions\IncomeReportFunction;
use App\Models\Income;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {
        $user=User::find($id);
      
        $newIncome=new Income();
        $newIncome->income_name=$request->incomeName;
        $newIncome->registration_date=now();
        $newIncome->active=true;
        $newIncome->user_id= $user->id;
        $newIncome->save();
        
         return  $newIncome;
    }

    public function getAllIncomes($id)
    {
        $user=User::find($id);
        $allIncomes =$user->income;
	    $allIncomesByOrder = collect([]);
		foreach($allIncomes as $found) {
		
			if($found->active==true) {
				$newIncome = new IncomeDao();
				$newIncome->setIdIncome($found->id);
				$newIncome->setIncomeName($found->income_name);
				$newIncome->setRegistrationDate($found->registration_date);
				$allIncomesByOrder->push($newIncome);
              
			}
			
		}

		return $allIncomesByOrder;
    }

    public function deleteIncome($id){

        try {
            $income=Income::find($id);
            // $income->active=false;
            // $income->removal_date=now();
           // $income->save();
         
            if($income->income_user->count()==0){

                $income->delete();
                // echo 'incomeUser : ' ;
                return "Se eliminó la cuenta de ingreso ".$income->income_name;
            }else{
                return "No se puede eliminar la cuenta de ingreso ".$income->income_name;
            }
           
       
		} catch (Exception $e) {
			return "No se eliminó la cuenta de ingreso";
		}

   
    }

    public function updateIncome($id, Request $request){

        $income=Income::find($id);
		
		if($request->incomeName) {
			$income->income_name=$request->incomeName;
		}
        $income->save();
		return $income;
    }

    
    public function incomesReport($id, $year){

        return  IncomeReportFunction::incomesReport($id,$year);
    }

    public function noExistsIncomeName($incomeName){

        //$result=true;
        $result='true';
    	$allIncomes = Income::all();
		foreach($allIncomes as $a) {
			if(strcasecmp($a->income_name, $incomeName) === 0) {
                $result='false';
			}
		}
		
		return $result;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
