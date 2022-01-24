<?php


namespace App\Http\Controllers\Functions;

use App\Dao\ReportDao;
use App\Models\User;

class IncomeReportFunction
{
    
    static function incomesReport($id,$year) {
        $user=User::find($id);
		$allIncomes = $user->income;
		$allIncomesForReport = collect();

		
		foreach ($allIncomes as $found) {

			$income = new ReportDao();
			$income->setAccountName($found->income_name);

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

			for ($j = 0; $j < $found->income_user->count(); $j++) {
				
				$incomeUser = $found->income_user[$j];
                $date = strtotime($incomeUser->date);
                $foundYear = date("Y", $date);
               // echo $foundYear;
				if($foundYear == $year) {
					
					if (strcasecmp($incomeUser->month,"Enero")==0) {
						$amountJanuary += $incomeUser->amount;
					}
					if (strcasecmp($incomeUser->month,"Febrero")==0) {
						$amountFebruary += $incomeUser->amount;
					}
                    if (strcasecmp($incomeUser->month,"Marzo")==0) {
						$amountMarch += $incomeUser->amount;
					}
                    if (strcasecmp($incomeUser->month,"Abril")==0) {
						$amountApril += $incomeUser->amount;
					}
                    if (strcasecmp($incomeUser->month,"Mayo")==0) {
						$amountMay += $incomeUser->amount;
					}
                    if (strcasecmp($incomeUser->month,"Junio")==0) {
						$amountJune += $incomeUser->amount;
					}
                    if (strcasecmp($incomeUser->month,"Julio")==0) {
						$amountJuly += $incomeUser->amount;
					}
                    if (strcasecmp($incomeUser->month,"Agosto")==0) {
						$amountAugust += $incomeUser->amount;
					}
                    if (strcasecmp($incomeUser->month,"Septiembre")==0) {
						$amountSeptember += $incomeUser->amount;
					}
                    if (strcasecmp($incomeUser->month,"Octubre")==0) {
						$amountOctuber += $incomeUser->amount;
					}
                    if (strcasecmp($incomeUser->month,"Noviembre")==0) {
						$amountNovember += $incomeUser->amount;
					}
                    if (strcasecmp($incomeUser->month,"Diciembre")==0) {
						$amountDecember += $incomeUser->amount;
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

			$income->setAmount($amountForMonth);

			$allIncomesForReport->push($income);
		}

		return $allIncomesForReport;
    }
}