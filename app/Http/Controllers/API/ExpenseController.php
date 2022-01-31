<?php

namespace App\Http\Controllers\API;

use App\Dao\ExpenseDao;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Functions\ExpenseReportFunction;
use App\Models\Expense;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class ExpenseController extends Controller
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

    public function store($id,Request $request)
    {
        $user=User::find($id);
      
        $newExpense=new Expense();
        $newExpense->expense_name=$request->expenseName;
        $newExpense->registration_date=now();
        $newExpense->active=true;
        $newExpense->user_id= $user->id;
        $newExpense->save();
        
         return  $newExpense;
    }

    public function getAllExpenses($id)
    {
        $user=User::find($id);
        $allExpenses =$user->expense;
	    $allExpensesByOrder = collect([]);
		foreach($allExpenses as $found) {
		
			if($found->active==true) {
				$newExpense = new ExpenseDao();
				$newExpense->setIdExpense($found->id);
				$newExpense->setExpenseName($found->expense_name);
				$newExpense->setRegistrationDate($found->registration_date);
				$allExpensesByOrder->push($newExpense);
              
			}
			
		}

		return $allExpensesByOrder;
    }

    public function deleteExpense($id){

        try {
            $expense=Expense::find($id);
            // $expense->active=false;
            // $expense->removal_date=now();
            // $expense->save();
            if($expense->expense_user->count()==0 && $expense->limit->count()==0){

                $expense->delete();
                return "Se eliminó la cuenta de egreso ".$expense->expense_name;
            }else{
                return "No se puede eliminar la cuenta de egreso ".$expense->expense_name;
            }
            
       
		} catch (Exception $e) {
			return "No se eliminó la cuenta de egreso";
		}

   
    }

    public function updateExpense($id, Request $request){

        $expense=Expense::find($id);
		
		if($request->expenseName) {
			$expense->expense_name=$request->expenseName;
		}
        $expense->save();
		return $expense;
    }

    
    public function expensesReport($id, $year){

        return  ExpenseReportFunction::incomesReport($id,$year);
    }

    public function noExistsExpenseName($expenseName){

        //$result=true;
        $result='true';
    	$allExpenses = Expense::all();
		foreach($allExpenses as $a) {
			if(strcasecmp($a->expense_name, $expenseName) === 0) {
                $result='false';
			}
		}
		
		return $result;
    }

    
}
