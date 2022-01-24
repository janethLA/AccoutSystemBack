<?php


namespace App\Http\Controllers\Functions;

class UserFunction
{
    
    static function getTotalIncomeUser($user) {
    	$incomes=$user->income_user;
    	$total=0.0;
    	foreach($incomes as $incomeUser) {
    		$total+=$incomeUser->amount;
    	}
    	$total=round($total);
    	return "".$total ." Bs";
    }
    
    static function getTotalExpenseUser($user) {
    	$expenses=$user->expense_user;
    	$total=0.0;
    	foreach($expenses as $expenseUser) {
    		$total+=$expenseUser->amount;
    	}
    	$total=round($total);
    	return "".$total ." Bs";
    }
    static function getTotalIncomeAccount($user) {
    	$incomes=$user->income;
    	$resultado="";
    	$newIncomes=collect();
    	foreach($incomes as $i) {
    		if($i->active) {
    			$newIncomes->push($i);
    		}
    	}
    	if($newIncomes->count() ==1) {
    		$resultado="".$newIncomes->count() ." Cuenta";
    	}else {
    		$resultado="".$newIncomes->count() ." Cuentas";
    	}
    	return $resultado;
    }
    
    static function getTotalExpenseAccount($user) {
    	$expenses=$user->income;
    	$resultado="";
    	$newExpenses=collect();
    	foreach($expenses as $i) {
    		if($i->active) {
    			$newExpenses->push($i);
    		}
    	}
    	if($newExpenses->count() ==1) {
    		$resultado="".$newExpenses->count() ." Cuenta";
    	}else {
    		$resultado="".$newExpenses->count() ." Cuentas";
    	}
    	return $resultado;

    }
}