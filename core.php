<?php
if (!defined('BYPASS')) exit(header('Location: /'));

require_once 'config.php';

class DesuCore
{
	public  $user_id,
			$user_info = null;

	public function escapeString($string)
	{
		$string = htmlspecialchars(ltrim($string));

		return $string;
	}

	public function get_UserInfo($value)
	{
		$file = GAME_USERS_DIR . $_SESSION['USER_ID'] . '/profile.json';
		if (file_exists($file)) {
			$get = file_get_contents($file);
			$json = json_decode($get, TRUE);

			return $json[$value];
		} else {
			return false;
		}
	}

	public function edit_UserInfo($value, $key)
	{
		$file = GAME_USERS_DIR . $_SESSION['USER_ID'] . '/profile.json';
		if (file_exists($file)) {
			$get = file_get_contents($file);
			$json = json_decode($get, TRUE);
			$json[$value] = $key;
			$newJson = array_merge(array(), $json);
			$newJson = json_encode($newJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			file_put_contents($file, $newJson);
		} else {
			return false;
		}
	}

	public function check_User($get_data)
	{
		$hash = md5(VK_APP_ID . '_' . $get_data['viewer_id'] . '_' . VK_SECRET_KEY);
		if ($get_data['auth_key'] == $hash) {
			$user_id = $get_data['viewer_id'];
			$_SESSION['USER_ID'] = $user_id;
			$this->user_id = $user_id;
			$file = GAME_USERS_DIR . $user_id . '/profile.json';
			if (file_exists($file)) {
				$get = file_get_contents($file);
				$user_info = json_decode($get, TRUE);
				if ($get_data['access_token'] != $user_info['access_token']) {
					self::edit_UserInfo('access_token', $get_data['access_token']);
				}

				$this->user_info = $user_info;

				return true;
			} else {
				if ($get_data['is_app_user']) {
					$userArray         =  array(
						'user_id'      => $get_data['viewer_id'],
						'group'        => 1,
						'auth_key'     => $get_data['auth_key'],
						'access_token' => $get_data['access_token'],
						'referrer'     => $get_data['referrer'],
						'add_date'     => time(),
						'active_save'  => null,
						'achivments'   => array()
					);
					$userJson = json_encode($userArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
					mkdir(GAME_USERS_DIR . $user_id);
					mkdir(GAME_USERS_DIR . $user_id . '/saves');
					mkdir(GAME_USERS_DIR . $user_id . '/cache');
					file_put_contents($file, $userJson);
					$this->user_info = $userArray;

					return true;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}

	public function check_Saves()
	{
		$dir = GAME_USERS_DIR . $_SESSION['USER_ID'] . '/saves';
		$open = opendir($dir);
		$count = 0;
		while ($file = readdir($open)) {
			if ($file == '.' || $file == '..' || is_dir($dir . $file)) {
				continue;
			}
				
			if ($count) {
				break;
			} else {
				$count++;
			}
		}

		if ($count) {
			return true;
		} else {
			return false;
		}
	}

	public function check_IsAdmin()
	{
		$group = self::get_UserInfo('group');
		if ($group == 2) {
			return true;
		} else {
			return false;
		}
	}
}
