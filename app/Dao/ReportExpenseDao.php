<?php

namespace App\Dao;

class ReportExpenseDao
{
    public $accountName;
    public $amount;
    public $limits;

	public function getAccountName() {
		return $this->accountName;
	}
	public function setAccountName($accountName) {
		$this->accountName = $accountName;
	}
	public function getAmount() {
		return $this->amount;
	}
	public function setAmount($amount) {
		$this->amount = $amount;
	}
    public function getLimits() {
		return $this->limits;
	}
	public function setLimits($limits) {
		$this->limits = $limits;
	}

}