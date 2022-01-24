<?php

namespace App\Dao;

class UserPasswordDao
{
    public $idUser;
   

    public function getIdUser() {
		return $this->idUser;
	}
	public function setIdUser($idUser) {
		$this->idUser = $idUser;
	}

}