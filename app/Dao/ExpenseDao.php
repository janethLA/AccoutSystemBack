<?php

namespace App\Dao;

class ExpenseDao
{
    public $idExpense;
    public $expenseName;
    public $registrationDate;

	public function getIdExpense() {
		return $this->idExpense;
	}
	public function setIdExpense($idExpense) {
		$this->idExpense = $idExpense;
	}
	public function getExpenseName() {
		return $this->expenseName;
	}
	public function setExpenseName($expenseName) {
		$this->expenseName = $expenseName;
	}
	public function getRegistrationDate() {
		return $this->registrationDate;
	}
	public function setRegistrationDate($registrationDate) {
		$this->registrationDate = $registrationDate;
	}
}