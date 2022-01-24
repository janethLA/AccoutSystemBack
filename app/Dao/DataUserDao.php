<?php

namespace App\Dao;

class DataUserDao
{
    public $username;
    public $name;
    public $telephone;

	public function getUsername() {
		return $this->username;
	}
	public function setUsername($username) {
		$this->username = $username;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function getTelephone() {
		return $this->telephone;
	}
	public function setTelephone($telephone) {
		$this->telephone = $telephone;
	}
	
}