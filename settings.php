<?php
session_start();

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	define('BYPASS', 'https://2desu.ru/');

	class DesuSettings
	{
		public $one_month = 30 * 24 * 60 * 60,
			   $one_year  = 365 * 24 * 60 * 60;
		public function musicTrigger($user_id, $status)
		{

			if ($status != "false") {
				setcookie('music', 'false', time() + $one_year, '/');
			} else {
				setcookie('music', 'true', time() + $one_year, '/');
			}

			return die(json_encode(array("result" => true)));
		}

		public function musicVolume($user_id, $volume)
		{
			if (isset($volume)) {
				//$volume = ($volume == 0) ? 0 : '-' . $volume;
				setcookie('volume', $volume, time() + $one_year, '/');

				return die(json_encode(array("result" => true)));
			} else return die(json_encode(array("result" => false)));
		}
	}

	$posted       =  array(
		'user_id' => htmlspecialchars(ltrim($_POST['user_id'])),
		'method'  => htmlspecialchars(ltrim($_POST['method'])),
		'status'  => htmlspecialchars(ltrim($_POST['status'])),
		'volume'  => htmlspecialchars(ltrim($_POST['volume']))
	);
	if (isset($_SESSION['USER_ID']) && $posted['user_id'] == $_SESSION['USER_ID']) {
		$settings = new DesuSettings();
		switch ($posted['method']) {
			case 'musicTrigger':
				$settings->musicTrigger($posted['user_id'], $posted['status']);
				break;

			case 'musicVolume':
				$settings->musicVolume($posted['user_id'], $posted['volume']);
				break;
		}
	} else {
		return die(json_encode(array("result" => false)));
	}
} else {
	header('Location: https://vk.com/' . VK_APP_ID);
}
