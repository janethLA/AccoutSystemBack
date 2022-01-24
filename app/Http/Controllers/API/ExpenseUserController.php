<?php

namespace App\Http\Controllers\API;

use App\Dao\ExpenseUserDao;
use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseUser;
use App\Models\User;
use Illuminate\Http\Request;

class ExpenseUserController extends Controller
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
		$newExpense=Expense::find($request->idExpense);
		$expenseUser=new ExpenseUser();
		$expenseUser->date=$request->date;
		$expenseUser->month=$request->month;
		$expenseUser->amount=$request->amount;
		$expenseUser->comment=$request->comment;
		$expenseUser->concept=$request->concept;
		$expenseUser->user_id=$user->id;
		$expenseUser->expense_id=$newExpense->id;
		$expenseUser->save();
		
	     return  $expenseUser;
    }

    public function allExpensesByUser($id)
    {

        $user=User::find($id);
		$allExpenses = $user->expense_user;
		$allExpensesByOrder = collect();

		foreach ($allExpenses as  $found) {

			$expense = new ExpenseUserDao();
			$expense->setIdExpenseUser($found->id);
			$expense->setDate($found->date);
			$expense->setMonth($found->month);
			$expense->setAmount($found->amount);
			$expense->setConcept($found->concept);
			$expense->setComment($found->comment);
			$expense->setExpenseAccount($found->expense->expense_name);
			
			$allExpensesByOrder->push($expense);

		}

		return $allExpensesByOrder;
    }

    public function updateExpenseOfUser($id, Request $request){

        $expense=ExpenseUser::find($id);
		
		if($request->date) {
			$expense->date=$request->date;
		}
		if($request->amount) {
			$expense->amount=$request->amount;
		}
		if($request->month) {
			$expense->month=$request->month;
		}
		if($request->concept) {
			$expense->concept=$request->concept;
		}
		if($request->comment) {
			$expense->comment=$request->comment;
		}
		if($request->idIncome) {
			$e=Expense::find($request->idExpense);
			$expense->expense_id=$e->id;
		}
		$expense->save();
		return $expense;

        
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
