<?php

namespace App\Dao;

class IncomeUserDao
{
    public $idIncomeUser;
    public $date;
    public $month;
    public $concept;
    public $amount;
    public $comment;
    public $incomeAccount;

	
	public function setIdIncomeUser($idIncomeUser) {
		$this->idIncomeUser = $idIncomeUser;
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

    public function setIncomeAccount($incomeAccount) {
		$this->incomeAccount = $incomeAccount;
	}
}