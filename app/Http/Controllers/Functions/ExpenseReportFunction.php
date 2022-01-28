<?php


namespace App\Http\Controllers\Functions;

use App\Dao\ReportDao;
use App\Dao\ReportExpenseDao;
use App\Models\User;
use phpDocumentor\Reflection\Types\Self_;

class ExpenseReportFunction
{

	static function incomesReport($id, $year)
	{
		$user = User::find($id);
		$allExpenses = $user->expense;
		$allExpensesForReport = collect();


		foreach ($allExpenses as $found) {

			$expense = new ReportExpenseDao();
			$expense->setAccountName($found->expense_name);

			$amountForMonth = collect();

			$amountJanuary = 0.0;
			$amountFebruary = 0.0;
			$amountMarch = 0.0;
			$amountApril = 0.0;
			$amountMay = 0.0;
			$amountJune = 0.0;
			$amountJuly = 0.0;
			$amountAugust = 0.0;
			$amountSeptember = 0.0;
			$amountOctuber = 0.0;
			$amountNovember = 0.0;
			$amountDecember = 0.0;

			for ($j = 0; $j < $found->expense_user->count(); $j++) {

				$expenseUser = $found->expense_user[$j];
				$date = strtotime($expenseUser->date);
				$foundYear = date("Y", $date);
				// echo $foundYear;
				if ($foundYear == $year) {

					if (strcasecmp($expenseUser->month, "Enero") == 0) {
						$amountJanuary += $expenseUser->amount;
					}
					if (strcasecmp($expenseUser->month, "Febrero") == 0) {
						$amountFebruary += $expenseUser->amount;
					}
					if (strcasecmp($expenseUser->month, "Marzo") == 0) {
						$amountMarch += $expenseUser->amount;
					}
					if (strcasecmp($expenseUser->month, "Abril") == 0) {
						$amountApril += $expenseUser->amount;
					}
					if (strcasecmp($expenseUser->month, "Mayo") == 0) {
						$amountMay += $expenseUser->amount;
					}
					if (strcasecmp($expenseUser->month, "Junio") == 0) {
						$amountJune += $expenseUser->amount;
					}
					if (strcasecmp($expenseUser->month, "Julio") == 0) {
						$amountJuly += $expenseUser->amount;
					}
					if (strcasecmp($expenseUser->month, "Agosto") == 0) {
						$amountAugust += $expenseUser->amount;
					}
					if (strcasecmp($expenseUser->month, "Septiembre") == 0) {
						$amountSeptember += $expenseUser->amount;
					}
					if (strcasecmp($expenseUser->month, "Octubre") == 0) {
						$amountOctuber += $expenseUser->amount;
					}
					if (strcasecmp($expenseUser->month, "Noviembre") == 0) {
						$amountNovember += $expenseUser->amount;
					}
					if (strcasecmp($expenseUser->month, "Diciembre") == 0) {
						$amountDecember += $expenseUser->amount;
					}
				}
			}
			$amountForMonth->push($amountJanuary);
			$amountForMonth->push($amountFebruary);
			$amountForMonth->push($amountMarch);
			$amountForMonth->push($amountApril);
			$amountForMonth->push($amountMay);
			$amountForMonth->push($amountJune);
			$amountForMonth->push($amountJuly);
			$amountForMonth->push($amountAugust);
			$amountForMonth->push($amountSeptember);
			$amountForMonth->push($amountOctuber);
			$amountForMonth->push($amountNovember);
			$amountForMonth->push($amountDecember);

			$expense->setAmount($amountForMonth);
			$expense->setLimits(Self::getLimitByAccount($found,$year));

			$allExpensesForReport->push($expense);
		}

		return $allExpensesForReport;
	}

	static function getLimitByAccount($found, $year)
	{

		$allLimits = $found->limit;
		//$allLimitsForReport = array();

		$limitForMonth = collect();

		$limitJanuary = 0.0;
		$limitFebruary = 0.0;
		$limitMarch = 0.0;
		$limitApril = 0.0;
		$limitMay = 0.0;
		$limitJune = 0.0;
		$limitJuly = 0.0;
		$limitAugust = 0.0;
		$limitSeptember = 0.0;
		$limitOctuber = 0.0;
		$limitNovember = 0.0;
		$limitDecember = 0.0;

		foreach ($allLimits as $limit) {


			if ($limit->year == $year) {

				if (strcasecmp($limit->month, "Enero") == 0) {
					$limitJanuary = $limit->limit;
				}
				if (strcasecmp($limit->month, "Febrero") == 0) {
					$limitFebruary = $limit->limit;
				}
				if (strcasecmp($limit->month, "Marzo") == 0) {
					$limitMarch = $limit->limit;
				}
				if (strcasecmp($limit->month, "Abril") == 0) {
					$limitApril = $limit->limit;
				}
				if (strcasecmp($limit->month, "Mayo") == 0) {
					$limitMay = $limit->limit;
				}
				if (strcasecmp($limit->month, "Junio") == 0) {
					$limitJune = $limit->limit;
				}
				if (strcasecmp($limit->month, "Julio") == 0) {
					$limitJuly = $limit->limit;
				}
				if (strcasecmp($limit->month, "Agosto") == 0) {
					$limitAugust = $limit->limit;
				}
				if (strcasecmp($limit->month, "Septiembre") == 0) {
					$limitSeptember = $limit->limit;
				}
				if (strcasecmp($limit->month, "Octubre") == 0) {
					$limitOctuber = $limit->limit;
				}
				if (strcasecmp($limit->month, "Noviembre") == 0) {
					$limitNovember = $limit->limit;
				}
				if (strcasecmp($limit->month, "Diciembre") == 0) {
					$limitDecember = $limit->limit;
				}
			}
		}
		$limitForMonth->push($limitJanuary);
		$limitForMonth->push($limitFebruary);
		$limitForMonth->push($limitMarch);
		$limitForMonth->push($limitApril);
		$limitForMonth->push($limitMay);
		$limitForMonth->push($limitJune);
		$limitForMonth->push($limitJuly);
		$limitForMonth->push($limitAugust);
		$limitForMonth->push($limitSeptember);
		$limitForMonth->push($limitOctuber);
		$limitForMonth->push($limitNovember);
		$limitForMonth->push($limitDecember);



		return $limitForMonth;
	}
}
