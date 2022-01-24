<?php

namespace App\Dao;

class ReportDao
{
    public $accountName;
    public $amount;

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

}