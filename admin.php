<?php
session_start();

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	define('BYPASS', true);

	require_once 'core.php';

	$core = new DesuCore();
	class DesuAdmin
	{
		public function get_Users()
		{
			$directory = opendir(GAME_USERS_DIR);
			$count = 0;
			$users = '';
			while ($dir = readdir($directory)) {
				if ($dir == '.' || $dir == '..' || is_file($directory . $dir) || $dir == '.htaccess') {
					continue;
				}
	
				$count++;
				$users .= "<button>{$dir}</button><br>";
			}

			return die(json_encode(array("result" => true, "count" => $count, "users" => $users)));
		}

		public function get_Levels()
		{
			$directory = opendir('prolog/');
			$count = 0;
			$levels = '';
			while ($dir = readdir($directory)) {
				if ($dir == '.' || $dir == '..' || is_dir($directory . $dir) || $dir == 'default.php') {
					continue;
				}
	
				$count++;
				$level = explode('.', $dir);
				$levels .= "<a onclick='getLevelTree(\"{$level[0]}\");'>
								<button>{$level[0]}</button><br>
							</a>";
			}

			return die(json_encode(array("result" => true, "count" => $count, "levels" => $levels)));
		}

		public function get_LevelTree($level)
		{
			if (isset($level)) {
				$file = 'prolog/' . $level . '.php';
				if (file_exists($file)) {
					include $file;

					$titles = "<table width='500'>" .
									"<tr width='100'>" .
										"<td>id</td>" .
										"<td>title</td>" .
									"</tr>" .
									"<tr width='400'>";
					foreach ($level_data as $name => $key) {
						//$title = (strlen(strip_tags($key['title'])) <= 30) ? $key['title'] : substr($key['title'], 0, 30) . '...';
						$title = $key['title'];
						$titles .=  	"<td>" . $name . "</td>" .
										"<td>" . $title . "</td>";
					}

					$titles .= 	   "</tr>" .
							  "</table>";

					return die(json_encode(array("result" => true, "title" => $titles)));
				} else return die(json_encode(array("result" => false)));
			} else return die(json_encode(array("result" => false)));
		}

		public function create_Prolog()
		{
			$directory = opendir('prolog/');
			while ($dir = readdir($directory)) {
				if ($dir == '.' || $dir == '..' || is_file($directory . $dir)) {
					continue;
				}

				$level = $dir;
			}

			$id = explode('.', $level);
			$id = explode('_', $id[0]);
			$file = 'prolog/level_' . ($id[1] + 1) . '.php';
			if (!file_exists($file)) {
				file_put_contents($file, file('prolog/default.php'));

				return die(json_encode(array("result" => true, "level" => $file)));
			} else {
				return die(json_encode(array("result" => false)));
			}
		}

		public function update_Prolog($level, $data)
		{
			if (isset($level) && isset($temp)) {
				$file = 'prolog/' . $level . '.php';
				if (file_exists($file)) {
					/*
					$content = file_get_contents($file);
					$data = json_decode($data, TRUE);
					$new = substr($content, 0, -3) . ".\r\n" . $data . "\r\n);";
					$fp = fopen($file, 'w');
					fwrite($fp, $new);
					fclose($fp);
					*/
					$data = json_decode($data, TRUE);
					for ($i = 0; $i < count($data); $i++) {
					     $buff .= $data[$i] . ' ';
					}

					// обрезаем последний пробел и добавляем переход на новую строку
					$buff = substr($buff, 0, -1) . "\n"; // Для кирилицы
					// если вы работаете с utf
					mb_internal_encoding('UTF-8');
					$buff = mb_substr($buff, 0, -1) . "\n";
					// как вариант можно избежать необходимость substr полностью
					$count = count($data);
					for ($i = 0; $i < $count; $i++) {
					     $buff .= $data[$i];
					     if($i != $count - 1)
					          $buff .= ' ';
					}

					$buff .= "\n";
					file_put_contents($file, $buff, FILE_APPEND);

					return die(json_encode(array("result" => true)));
				} else return die(json_encode(array("result" => false)));
			} else return die(json_encode(array("result" => false)));
		}

		public function update_Config($data)
		{
			// TODO...
		}
	}

	$posted        =  array(
		'admin_id' => htmlspecialchars(ltrim($_POST['admin_id'])),
		//'user_id'  => htmlspecialchars(ltrim($_POST['user_id'])),
		'method'   => htmlspecialchars(ltrim($_POST['method'])),
		'level'    => htmlspecialchars(ltrim($_POST['level'])),
		'data'     => htmlspecialchars(ltrim($_POST['data']))
	);
	if (isset($_SESSION['USER_ID']) && $posted['admin_id'] == $_SESSION['USER_ID']) {
		if ($core->get_UserInfo('group') == 2) {
			$admin = new DesuAdmin();
			switch ($posted['method']) {
				case "getUsers":
					$admin->get_Users();
					break;

				case "getLevels":
					$admin->get_Levels();
					break;

				case "getLevelTree":
					$admin->get_LevelTree($posted['level']);
					break;

				case "createProlog":
					$admin->create_Prolog();
					break;

				case "updateProlog":
					$admin->update_Prolog($posted['level'], $posted['data']);
					break;

				case "updateConfig":
					$admin->update_Config($posted['data']);
					break;
			}
		}
	} else {
		return die(json_encode(array("result" => false)));
	}
} else {
	header('Location: https://vk.com/app' . VK_APP_ID);
}
