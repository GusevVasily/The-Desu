<?php
if (!defined('BYPASS')) exit(header('Location: /'));

session_start();

require_once 'config.php';

class DesuProlog
{
	public function level_Get($user_id, $save_name, $type)
	{
		if ($type == 2 || $type == 3) {
			$save = GAME_USERS_DIR . $user_id . '/saves/' . $save_name . '.json';
			if (empty($save_name)) {
				$data = explode('||', $_SESSION['ACTIVE_SAVE']);
				$save = GAME_USERS_DIR . $user_id . '/saves/' . $data[0] . '.json';
			}

			if (file_exists($save)) {
				$get = file_get_contents($save);
				$decode = json_decode($get, TRUE);
				$switch = ($type == 3) ? ($decode['prolog']['level'] + 1) : $decode['prolog']['level'];
				switch ($switch) {
					case 0:
						$file = './prolog/level_0.php';
						break;
					case 1:
						$file = './prolog/level_1.php';
						break;
					default:
						$file = false;
						break;
				}

				return $file;
			} else {
				return false;
			}
		} elseif ($type == 1) {
			$file = './prolog/level_0.php';

			return $file;
		}
	}
}
