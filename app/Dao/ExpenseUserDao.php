<?php

namespace App\Dao;

class ExpenseUserDao
{
    public $idExpenseUser;
    public $date;
    public $month;
    public $concept;
    public $amount;
    public $comment;
    public $expenseAccount;

	
	public function setIdExpenseUser($idExpenseUser) {
		$this->idExpenseUser = $idExpenseUser;
	}
	
	public function setDate($date) {
		$this->date = $date;
	}
	
	public function setMonth($month) {
		$this->month = $month;
	}
    public function setConcept($concept) {
		$this->concept = $concept;
	}
	
	public function setAmount($amount) {
		$this->amount = $amount;
	}
	
	public function setComment($comment) {
		$this->comment = $comment;
	}

    public function setExpenseAccount($expenseAccount) {
		$this->expenseAccount = $expenseAccount;
	}
}