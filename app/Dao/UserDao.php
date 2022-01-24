<?php

namespace App\Dao;

class UserDao
{
    public $idUser;
    public $name;
    public $username;
    public $password;
    public $telephone;
    public $registrationDate;
    public $expiryDate;

    public function getIdUser() {
		return $this->idUser;
	}
	public function setIdUser($idUser) {
		$this->idUser = $idUser;
	}
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function getUsername() {
		return $this->username;
	}
	public function setUsername($username) {
		$this->username = $username;
	}
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
	}
	public function getTelephone() {
		return $this->telephone;
	}
	public function setTelephone($telephone) {
		$this->telephone = $telephone;
	}
	public function getRegistrationDate() {
		return $this->registrationDate;
	}
	public function setRegistrationDate($registrationDate) {
		$this->registrationDate = $registrationDate;
	}
	public function getExpiryDate() {
		return $this->expiryDate;
	}
	public function setExpiryDate($expiryDate) {
		$this->expiryDate = $expiryDate;
	}
	
}