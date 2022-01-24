<?php

namespace App\Dao;

class SettingDao
{
    public $idSetting;
    public $welcomeMessage;
    public $image;

	public function setIdSetting($idSetting) {
		$this->idSetting = $idSetting;
	}
	public function setWelcomeMessage($welcomeMessage) {
		$this->welcomeMessage = $welcomeMessage;
	}
    public function setImage($image) {
		$this->image = $image;
	}

}