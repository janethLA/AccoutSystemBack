<?php

namespace App\Http\Controllers\API;

use App\Dao\ExpenseUserDao;
use App\Dao\IncomeUserDao;
use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\IncomeUser;
use App\Models\User;
use Illuminate\Http\Request;

class IncomeUserController extends Controller
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
		$newIncome=Income::find($request->idIncome);
		$incomeUser=new IncomeUser();
		$incomeUser->date=$request->date;
		$incomeUser->month=$request->month;
		$incomeUser->amount=$request->amount;
		$incomeUser->comment=$request->comment;
		$incomeUser->concept=$request->concept;
		$incomeUser->user_id=$user->id;
		$incomeUser->income_id=$newIncome->id;
		$incomeUser->save();
		
	     return  $incomeUser;
    }

    public function allIncomesByUser($id)
    {

        $user=User::find($id);
		$allIncomes = $user->income_user;
		$allIncomesByOrder = collect();

		foreach ($allIncomes as  $found) {

			$income = new IncomeUserDao();
			$income->setIdIncomeUser($found->id);
			$income->setDate($found->date);
			$income->setMonth($found->month);
			$income->setAmount($found->amount);
			$income->setConcept($found->concept);
			$income->setComment($found->comment);
			$income->setIncomeAccount($found->income->income_name);
			
			$allIncomesByOrder->push($income);

		}

		return $allIncomesByOrder;
    }

    public function updateIncomeOfUser($id, Request $request){

        $income=IncomeUser::find($id);
		
		if($request->date) {
			$income->date=$request->date;
		}
		if($request->amount) {
			$income->amount=$request->amount;
		}
		if($request->month) {
			$income->month=$request->month;
		}
		if($request->concept) {
			$income->concept=$request->concept;
		}
		if($request->comment) {
			$income->comment=$request->comment;
		}
		if($request->idIncome) {
            
			$e=Income::find($request->idIncome);
			$income->income_id=$e->id;
		}
		$income->save();
		return $income;

        
    }

    public function deleteIncomeOfUser($id){
        $income=IncomeUser::find($id);
        $income->delete();
        return "Se eliminó correctamente";
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
