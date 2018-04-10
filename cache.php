<?php
session_start();

require_once 'config.php';

$get = htmlspecialchars(ltrim($_GET['f']));
if (!empty($get)) {
	$file = GAME_USERS_DIR . $_SESSION['USER_ID'] . '/cache/' . $get . '.png';
	if (file_exists($file)) {
		die(file_get_contents($file));
	} else {
		die(file_get_contents('./assets/img/save.png'));
	}
} else {
	exit(header('Location: https://vk.com/app5653633'));
}
