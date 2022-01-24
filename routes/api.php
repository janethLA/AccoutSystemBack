<?php

use App\Http\Controllers\API\ExpenseController;
use App\Http\Controllers\API\ExpenseUserController;
use App\Http\Controllers\API\IncomeController;
use App\Http\Controllers\API\IncomeUserController;
use App\Http\Controllers\API\LimitController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//PermitAll
Route::get('auth/uniqueTelephoneAll/{telephone}', [AuthController::class, 'noExistsTelephone']);
Route::get('auth/recoverByPhone/{telephone}', [AuthController::class, 'recoverByPhone']);
Route::put('auth/changePassword', [AuthController::class, 'changePassword']);

Route::post('auth/authenticate', [AuthController::class, 'authenticate']);

Route::get('setting/getSetting', [SettingController::class, 'getSetting']);

Route::group(['middleware' => ['auth:sanctum']], function () {


    //Admin
    Route::get('user/allUser', [UserController::class, 'index']);
    Route::post('user/createUser', [UserController::class, 'store']);
    Route::get('user/uniqueUserName/{userName}', [UserController::class, 'noExistsUserName']);
    Route::put('user/updateDataUser/{id}', [UserController::class, 'setUser']);
    Route::put('user/deleteUser/{id}', [UserController::class, 'deleteUser']);

    //UserFinal
    Route::get('user/getIncomeAndExpenseTotal/{id}', [UserController::class, 'getIncomeAndExpenseTotalUser']);
    Route::put('user/updateDataFinalUser/{id}', [UserController::class, 'updateDataFinalUser']);
    Route::get('user/getDataUser/{id}', [UserController::class, 'getDataUser']);

    Route::post('income/createIncome/{id}', [IncomeController::class, 'store']);
    Route::get('income/allIncomes/{id}', [IncomeController::class, 'getAllIncomes']);
    Route::put('income/deleteIncome/{id}', [IncomeController::class, 'deleteIncome']);
    Route::put('income/updateIncome/{id}', [IncomeController::class, 'updateIncome']);
    Route::get('income/incomesReport/{id}/{year}', [IncomeController::class, 'incomesReport']);

    Route::post('expense/createExpense/{id}', [ExpenseController::class, 'store']);
    Route::get('expense/allExpenses/{id}', [ExpenseController::class, 'getAllExpenses']);
    Route::put('expense/deleteExpense/{id}', [ExpenseController::class, 'deleteExpense']);
    Route::put('expense/updateExpense/{id}', [ExpenseController::class, 'updateExpense']);
    Route::get('expense/expensesReport/{id}/{year}', [ExpenseController::class, 'expensesReport']);


    Route::post('incomeUser/registerIncome/{id}', [IncomeUserController::class, 'store']);
    Route::get('incomeUser/allIncomesByUser/{id}', [IncomeUserController::class, 'allIncomesByUser']);
    Route::put('incomeUser/updateIncomeOfUser/{id}', [IncomeUserController::class, 'updateIncomeOfUser']);

    Route::post('expenseUser/registerExpense/{id}', [ExpenseUserController::class, 'store']);
    Route::get('expenseUser/allExpesesByUser/{id}', [ExpenseUserController::class, 'allExpensesByUser']);
    Route::put('expenseUser/updateExpenseOfUser/{id}', [ExpenseUserController::class, 'updateExpenseOfUser']);

    //Admin
    Route::post('setting/updateImage', [SettingController::class, 'store']);
    Route::post('setting/updateWelcomeMessage', [SettingController::class, 'updateWelcomeMessage']);

    //UserFinal
    Route::get('limit/getAll/{id}', [LimitController::class, 'getAll']);
    Route::post('limit/store/{id}', [LimitController::class, 'store']);
});
