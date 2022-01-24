<?php
namespace App\Dao;

class DataTotalDao
{
 
    public $name;
    public $total;

	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	public function getTotal() {
		return $this->total;
	}
	public function setTotal($total) {
		$this->total = $total;
	}

}