<?php

namespace App\Dao;

class LoginDao
{
    public $authority;

	
	public function setAuthority($authority) {
		$this->authority = $authority;
	}
}