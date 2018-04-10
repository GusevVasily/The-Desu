<?php
session_start();

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
	define('BYPASS', true);

	require_once 'config.php';
	require_once 'prolog.php';

	class DesuAjax
	{
		public function game_Action($user_id, $type, $modal = null)
		{
			if ($type == 1 || $type == 2) {
				$prolog = new DesuProlog();
				$level_file = $prolog->level_Get($user_id, null, 2);
				if ($level_file != false) {
					include $level_file;

					$active_save = $_SESSION['ACTIVE_SAVE'];
					if (isset($active_save)) {
						$data = explode('||', $active_save);
						$new = ($type == 2) ? ($data[1] + 1) : ($data[1] - 1);
						if ($level_data[$new]['type'] == ('next' or 'option')) {
							$returnArray  =  array(
								"result"  => true,
								"bg"      => $level_data[$new]['bg'],
								"img"     => $level_data[$new]['img'],
								"title"   => $level_data[$new]['name'],
								"text"    => $level_data[$new]['title']
							);
							if ($level_data[$new]['type'] == 'option') {
								if (isset($modal) && $modal != null) {
									$dialog = explode('_', $data[2]);
									$option = (isset($dialog[1])) ? $dialog[1] : 0;
									$newData = $level_data[$new]['options']['option_' . $modal][$option];
									if (isset($newData)) {
										$newDialog = ($type == 2) ? ($option + 1) : ($option - 1);
										$uid = $data[1] . '||' . $modal . '_' . $newDialog;
										$uid2 = $data[1] . '||' . ($modal + 1) . '_' . ($newDialog + 1); //DUPE FIX
										$_SESSION['ACTIVE_SAVE'] = $data[0] . '||' . $uid;
										$points = $level_data[$new]['options']['points'][$modal];
										if (isset($points) && (!isset($_SESSION['BLOCK']) || $_SESSION['BLOCK'] != $uid)) { //DUPE FIX
											$_SESSION['BLOCK'] = $uid2; //DUPE FIX
											$save_points = $_SESSION['SAVE_POINTS'];
											if (isset($save_points)) {
												$checkPoints = explode('||', $save_points);
												$exPoints = explode(':', $points);
												for ($i = 0; $i < (count($checkPoints) - 1); $i++) {
													$exSavePoints = explode(':', $checkPoints[$i]);
													if ($exSavePoints[0] == $exPoints[0]) {
														$newPoint = ($exSavePoints[1] + $exPoints[1]);
														$good = $checkPoints[$i];
														unset($checkPoints[$i]);
														$newPoints = '';
														for ($r = 0; $r < count($checkPoints); $r++) {
															if (isset($checkPoints[$r])) {
																$newPoints .= $checkPoints[$r] . '||';
															}
														}

														$exRePoints = explode(':', $good);
														$newPoints .= $exRePoints[0] . ':' . $newPoint . '||';
														$_SESSION['SAVE_POINTS'] = $newPoints;
														break;
													}

													$_SESSION['SAVE_POINTS'] = $save_points . $points . '||';
												} 
											} else {
												$_SESSION['SAVE_POINTS'] = $points . '||';
											}
										} else {
											$_SESSION['BLOCK'] = $uid2; //DUPE FIX
										}

										$newArray     =  array(
											"result"  => true,
											"bg"      => $newData['bg'],
											"img"     => $newData['img'],
											"title"   => $newData['name'],
											"text"    => $newData['title']
										);

										return die(json_encode($newArray));
									} else {
										$new = ($type == 2) ? ($new + 1) : ($new - 1);
										$_SESSION['ACTIVE_SAVE'] = $data[0] . '||' . $new;
										$returnArray  =  array(
											"result"  => true,
											"bg"      => $level_data[$new]['bg'],
											"img"     => $level_data[$new]['img'],
											"title"   => $level_data[$new]['name'],
											"text"    => $level_data[$new]['title']
										);

										return die(json_encode($returnArray));
									}
								} else {
									$_SESSION['ACTIVE_SAVE'] = $data[0] . '||' . $data[1] . '||0';
									$returnArray["options"] = array($level_data[$new]['options']['select']);
								}
							} else {
								$_SESSION['ACTIVE_SAVE'] = $data[0] . '||' . $new;
							}

							return die(json_encode($returnArray));
						} elseif ($check[$new]['type'] == 'new_game') {
							$level_file = $prolog->level_Get($user_id, null, 3);
							if ($level_file != false) {
								include $level_file;
								include 'core.php';

								$file = GAME_USERS_DIR . $user_id . '/saves/' . $_SESSION['ACTIVE_SAVE'] . '.json';
								$get = file_get_contents($file, TRUE);
								$getSave = json_decode($get, TRUE);
								$getSave['prolog']['level'] = ((int)$getSave['prolog']['level'] + 1);
								$getSave['prolog']['slide'] = (int)0;
								$save_points = $_COOKIE['SAVE_POINTS'];
								if (isset($save_points)) {
									$saves = explode('||', $save_points);
									for ($i = 0; $i < (count($saves) - 1); $i++) {
										$hero = explode(':', $saves[$i]);
										$getSave['prolog']['points'][$hero[0]] = $getSave['prolog']['points'][$hero[0]] + $hero[1];
									}
								}

								$getSave['update'] = time();
								$getSave['prolog']['location'] = $level_info['name'];
								$newJson = array_merge(array(), $getSave);
								$newJson = json_encode($newJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
								$id = md5(uniqid());
								$newFile = GAME_USERS_DIR . $user_id . '/saves/auto_' . $id . '.json';
								$fp = fopen($newFile, 'w');
								fwrite($fp, $newJson);
								fclose($fp);
								$core = new DesuCore();
								$core->edit_UserInfo('active_save', 'auto_' . $id);
								unset($_SESSION['SAVE_POINTS']);
								unset($_SESSION['BLOCK']);
								$_SESSION['ACTIVE_SAVE'] = $data[0] . '||0';
								$returnArray  =  array(
									"result"  => true,
									"bg"      => $level_data[0]['bg'],
									"img"     => $level_data[0]['img'],
									"title"   => $level_data[0]['name'],
									"text"    => $level_data[0]['title']
								);

								return die(json_encode($returnArray));
							} else {
								return die(json_encode(array("result" => false, "error_type" => "prolog_is_ended")));
							}
						} else {
							return die(json_encode(array("result" => false)));
						}
					} else {
						return die(json_encode(array("result" => false)));
					}
				} else {
					return die(json_encode(array("result" => false)));
				}
			} else {
				return die(json_encode(array("result" => false)));
			}
		}

		public function game_New($user_id)
		{
			$prolog = new DesuProlog();
			$level_file = $prolog->level_Get($user_id, null, 1);
			if ($level_file != false) {
				include $level_file;
				include 'core.php';

				$dir = GAME_USERS_DIR . $user_id . '/saves/';
				$open = opendir($dir);
				$count = 0;
				while ($file = readdir($open)) {
					if ($file == '.' || $file == '..' || is_dir($dir . $file)) {
						continue;
					}

					$check = explode('_', $file);
					if ($check[0] == 'auto') {
						continue;
					}

					$count++;
				}

				if ($count < GAME_MAX_SAVES) {
					$id = md5(uniqid());
					$newArray = array(
						'user_id' => (int)$user_id,
						'create'  => time(),
						'update'  => time(),
						'name'    => $id,
						'prolog'       => array(
							'location' => "Пролог",
							'level'    => 0,
							'slide'    => 0,
							'points'   => array()
						)
					);
					$newData = json_encode($newArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
					$newFile = 'save_' . $id . '.json';
					$fp = fopen($dir . '/' . $newFile, 'w');
					fwrite($fp, $newData);
					fclose($fp);
					$core = new DesuCore();
					$core->edit_UserInfo('active_save', 'save_' . $id);
					unset($_SESSION['SAVE_POINTS']);
					unset($_SESSION['BLOCK']);
					$_SESSION['ACTIVE_SAVE'] = 'save_' . $id . '||0';
					$returnArray  =  array(
						"result"  => true,
						"bg"      => $level_data[0]['bg'],
						"img"     => $level_data[0]['img'],
						"title"   => $level_data[0]['name'],
						"text"    => $level_data[0]['title']
					);

					return die(json_encode($returnArray));
				} else {
					return die(json_encode(array("result" => false, "error_type" => "max_saves")));
				}
			} else {
				return die(json_encode(array("result" => false)));
			}
		}

		public function game_List($user_id, $type, $new)
		{
			//include 'core.php';

			if ($type == 1 || $type == 2) {
				$dir = GAME_USERS_DIR . $user_id . '/saves/';
				$open = opendir($dir);
				$saveType = ($type == 2) ? 'auto' : 'save';
				$files = array();
				while ($file = readdir($open)) {
					if ($file == '.' || $file == '..' || is_dir($dir . $file)) {
						continue;
					}

					$check = explode('_', $file);
					if ($check[0] == $saveType) {
						continue;
					}

					array_push($files, $file);
				}

				$param = ($new) ? 'selectGame' : 'selectSave';
				$text = '';
				if ($files) {
					for ($i = 0; $i < count($files); $i++) {
						$name = explode('.', $files[$i]);
						$save = file_get_contents($dir . $name[0] . '.json');
						$info = json_decode($save, TRUE);
						$text .= "<a onclick='{$param}(\"{$name[0]}\");'>
									<div class='menublock soundbtn' id='saveblock'>
										<img src='/cache.php?f=" . substr($files[$i], 0, -5) . "' />
										<span class='date'>
											<i class='fa fa-clock-o' aria-hidden='true'></i> " . date('d.m.y H:i', $info['update']) . "
										</span>
										<span class='level'>{$info['prolog']['location']}</span>
									</div>
								</a>";
					}

				}

				return die(json_encode(array("result" => true, "title" => $text)));
			} else {
				return die(json_encode(array("result" => "false22")));
			}
		}

		public function game_Save($user_id, $save_name, $cache)
		{
			$active_save = $_SESSION['ACTIVE_SAVE'];
			if (isset($active_save)) {
				$data = explode('||', $active_save);
				if (isset($save_name) && $save_name != '*new') {
					$file = GAME_USERS_DIR . $user_id . '/saves/' . $save_name . '.json';
					$cacheDir = GAME_USERS_DIR . $user_id . '/cache/' . $save_name . '.png';
					file_put_contents($cacheDir, base64_decode($cache));
					if (file_exists($file)) {
						$get = file_get_contents($file, TRUE);
						$getSave = json_decode($get, TRUE);
						$getSave['prolog']['slide'] = (int)$data[1];
						$save_points = $_COOKIE['SAVE_POINTS'];
						if (isset($save_points)) {
							$saves = explode('||', $save_points);
							for ($i = 0; $i < (count($saves) - 1); $i++) {
								$hero = explode(':', $saves[$i]);
								$getSave['prolog']['points'][$hero[0]] = $getSave['prolog']['points'][$hero[0]] + $hero[1];
							}
						}

						$getSave['update'] = time();
						$newJson = array_merge(array(), $getSave);
						$newJson = json_encode($newJson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
						$fp = fopen($file, 'w');
						fwrite($fp, $newJson);
						fclose($fp);
						self::game_List($user_id, 2, true);
					} else {
						return die(json_encode(array("result" => false)));
					}
				} elseif (isset($save_name) && $save_name == '*new') {
					$file = GAME_USERS_DIR . $user_id . '/saves/' . $data[0] . '.json';
					include 'core.php';

					$dir = GAME_USERS_DIR . $user_id . '/saves/';
					$open = opendir($dir);
					$count = 0;
					while ($ffile = readdir($open)) {
						if ($ffile == '.' || $ffile == '..' || is_dir($dir . $ffile)) {
							continue;
						}

						$check = explode('_', $ffile);
						if ($check[0] == 'auto') {
							continue;
						}

						$count++;
					}

					if ($count < GAME_MAX_SAVES) {
						if (file_exists($file)) {
							$get = file_get_contents($file, TRUE);
							$getSave = json_decode($get, TRUE);
						}

						$id = md5(uniqid());
						$newArray = array(
							'user_id' => (int)$user_id,
							'create'  => time(),
							'update'  => time(),
							'name'    => $id,
							'prolog'       => array(
								'location' => 'Пролог',
								'level'    => (int)$getSave['prolog']['level'],
								'slide'    => (int)$data[1],
								'points'   => array()
							)
						);
						$save_points = $_COOKIE['SAVE_POINTS'];
						if (isset($save_points)) {
							$saves = explode('||', $save_points);
							for ($i = 0; $i < (count($saves) - 1); $i++) {
								$hero = explode(':', $saves[$i]);
								if (file_exists($file)) {
									$newArray['prolog']['points'][$hero[0]] = $getSave['prolog']['points'][$hero[0]] + $hero[1];
								} else {
									$newArray['prolog']['points'][$hero[0]] = $hero[1];
								}
							}
						}

						$newData = json_encode($newArray, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
						$newFile = 'save_' . $id;
						$cacheDir = GAME_USERS_DIR . $user_id . '/cache/' . $newFile . '.png';
						file_put_contents($cacheDir, base64_decode($cache));
						$fp = fopen($dir . '/' . $newFile . '.json', 'w');
						fwrite($fp, $newData);
						fclose($fp);
						$core = new DesuCore();
						$core->edit_UserInfo('active_save', 'save_' . $id);
						unset($_SESSION['SAVE_POINTS']);
						unset($_SESSION['BLOCK']);
						$_SESSION['ACTIVE_SAVE'] = 'save_' . $id . '||0';
						self::game_List($user_id, 2, true);
					} else {
						return die(json_encode(array("result" => false, "error_type" => "max_saves")));
					}
				}
			} else {
				return die(json_encode(array("result" => false)));
			}
		}

		public function game_Saves($user_id)
		{
			include 'core.php';

			$dir = GAME_USERS_DIR . $user_id . '/saves/';
			$open = opendir($dir);
			$files = array();
			while ($file = readdir($open)) {
				if ($file == '.' || $file == '..' || is_dir($dir . $file)) {
					continue;
				}

				$check = explode('_', $file);
				if ($check[0] == 'auto') {
					continue;
				}

				array_push($files, $file);
			}

			if ($files) {
				for ($i = 0; $i < count($files); $i++) {
					$name = explode('.', $files[$i]);
					$save = file_get_contents($dir . $name[0] . '.json');
					$info = json_decode($save, TRUE);
					$text .= "<a onclick='selectGame(\"{$name[0]}\");'>
								<div class='menublock soundbtn' id='saveblock'>
									<img src='/cache.php?f=" . substr($files[$i], 0, -5) . "' />
									<span class='date'>
										<i class='fa fa-clock-o' aria-hidden='true'></i> " . date('d.m.y H:i', $info['update']) . "
									</span>
									<span class='level'>{$info['prolog']['location']}</span>
								</div>
							</a>";
				}

				return die(json_encode(array("result" => true, "title" => $text)));
			} else {
				return die(json_encode(array("result" => true, "title" => null)));
			}
		}

		public function game_Continue($user_id)
		{
			include 'core.php';

			$core = new DesuCore();
			$activeSave = $core->get_UserInfo('active_save');
			if ($activeSave != null) {
				$file = GAME_USERS_DIR . $user_id . '/saves/' . $activeSave . '.json';
				if (file_exists($file)) {
					$get = file_get_contents($file, TRUE);
					$getSave = json_decode($get, TRUE);
					$new = $getSave['prolog']['slide'];
					unset($_SESSION['SAVE_POINTS']);
					unset($_SESSION['BLOCK']);
					$_SESSION['ACTIVE_SAVE'] = $activeSave . '||' . $new;
					$prolog = new DesuProlog();
					$level_file = $prolog->level_Get($user_id, null, 2);
					if ($level_file != false) {
						include $level_file;

						$returnArray  =  array(
							"result"  => true,
							"bg"      => $level_data[$new]['bg'],
							"img"     => $level_data[$new]['img'],
							"title"   => $level_data[$new]['name'],
							"text"    => $level_data[$new]['title']
						);

						return die(json_encode($returnArray));
					} else {
						return die(json_encode(array("result" => false)));
					}
				} else {
					unset($_SESSION['ACTIVE_SAVE']);
					$core->edit_UserInfo('active_save', null);

					return die(json_encode(array("result" => false)));
				}
			} else {
				unset($_SESSION['ACTIVE_SAVE']);
				return die(json_encode(array("result" => false)));
			}
		}

		public function game_Load($user_id, $save_name)
		{
			$prolog = new DesuProlog();
			$level_file = $prolog->level_Get($user_id, $save_name, 2);
			if ($level_file != false) {
				include $level_file;
				include 'core.php';

				if (isset($save_name)) {
					$file = GAME_USERS_DIR . $user_id . '/saves/' . $save_name . '.json';
					if (file_exists($file)) {
						$get = file_get_contents($file, TRUE);
						$getSave = json_decode($get, TRUE);
						$new = $getSave['prolog']['slide'];
						unset($_SESSION['SAVE_POINTS']);
						unset($_SESSION['BLOCK']);
						$_SESSION['ACTIVE_SAVE'] = $save_name . '||' . $new;
						$core = new DesuCore();
						$core->edit_UserInfo('active_save', $save_name);
						$returnArray  =  array(
							"result"  => true,
							"bg"      => $level_data[$new]['bg'],
							"img"     => $level_data[$new]['img'],
							"title"   => $level_data[$new]['name'],
							"text"    => $level_data[$new]['title']
						);

						return die(json_encode($returnArray));
					} else {
						return die(json_encode(array("result" => "false3")));
					}
				} else {
					return die(json_encode(array("result" => "false2")));
				}
			} else {
				return die(json_encode(array("result" => "false1/" . $level_file)));
			}
		}

		public function game_Remove($user_id, $save_name, $type)
		{
			if ($type == 1 || $type == 2) {
				if (isset($save_name)) {
					if ($type == 2) {
						if (!empty($_SESSION['ACTIVE_SAVE'])) {
							$session = explode('||', $_SESSION['ACTIVE_SAVE']);
							if ($save_name == $session[0]) {
								return die(json_encode(array("result" => false, "error" => "active_save")));
							}
						}
					}

					$save = GAME_USERS_DIR . $user_id . '/saves/' . $save_name . '.json';
					$cache = GAME_USERS_DIR . $user_id . '/cache/' . $save_name . '.png';
					if (file_exists($save)) {
						unlink($save);

						if (file_exists($cache)) {
							unlink($cache);
						}

						self::game_List($user_id, 2, true);
					} else {
						return die(json_encode(array("result" => false)));
					}
				} else {
					return die(json_encode(array("result" => false)));
				}
			} else {
				return die(json_encode(array("result" => false)));
			}
		}

		public function game_SavesCache($user_id)
		{
			$dir = GAME_USERS_DIR . $user_id . '/cache/';
			$open = opendir($dir);
			$files = '';
			while ($file = readdir($open)) {
				if ($file == '.' || $file == '..' || is_dir($dir . $file)) {
					continue;
				}

				$files .= '/cache.php?f=' . substr($file, 0, -4) . ',';
			}

			if ($files) {
				return die(json_encode(array("result" => true, "cached" => substr($files, 0, -1))));
			} else {
				return die(json_encode(array("result" => true, "cached" => null)));
			}

		}
	}

	$posted         =  array(
		'user_id'   => htmlspecialchars(ltrim($_POST['user_id'])),
		'method'    => htmlspecialchars(ltrim($_POST['method'])),
		'save_name' => htmlspecialchars(ltrim($_POST['save_name'])),
		'cache'     => htmlspecialchars(ltrim($_POST['cache'])),
		'type'      => (int)$_POST['type'],
		'modal'     => (int)$_POST['modal']
	);
	if (isset($_SESSION['USER_ID']) && $posted['user_id'] == $_SESSION['USER_ID']) {
		$ajax = new DesuAjax();
		switch ($posted['method']) {
			case 'game_New':
				$ajax->game_New($posted['user_id']);
				break;

			case 'game_Action':
				$ajax->game_Action($posted['user_id'], $posted['type'], $posted['modal']);
				break;

			case 'game_Continue':
				$ajax->game_Continue($posted['user_id']);
				break;

			case 'game_Save':
				$ajax->game_Save($posted['user_id'], $posted['save_name'], $posted['cache']);
				break;

			case 'game_Saves':
				$ajax->game_SaveS($posted['user_id']);
				break;

			case 'game_Load':
				$ajax->game_Load($posted['user_id'], $posted['save_name']);
				break;

			case 'game_List':
				$ajax->game_List($posted['user_id'], $posted['type'], false);
				break;

			case 'game_Remove':
				$ajax->game_Remove($posted['user_id'], $posted['save_name'], $posted['type']);
				break;

			case 'game_SavesCache':
				$ajax->game_SavesCache($posted['user_id']);
				break;
		}
	} else {
		return die(json_encode(array("result" => false)));
	}
} else {
	header('Location: https://vk.com/app' . VK_APP_ID);
}
