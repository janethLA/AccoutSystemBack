<?php

namespace App\Dao;

class IncomeDao
{
    public $idIncome;
    public $incomeName;
    public $registrationDate;

	public function getIdIncome() {
		return $this->idIncome;
	}
	public function setIdIncome($idIncome) {
		$this->idIncome = $idIncome;
	}
	public function getIncomeName() {
		return $this->incomeName;
	}
	public function setIncomeName($incomeName) {
		$this->incomeName = $incomeName;
	}
	public function getRegistrationDate() {
		return $this->registrationDate;
	}
	public function setRegistrationDate($registrationDate) {
		$this->registrationDate = $registrationDate;
	}
}