<?php
define('BYPASS', true);

session_start();

require_once 'preload.php';
require_once 'core.php';

$core = new DesuCore();

$one_month = 30 * 24 * 60 * 60;
$one_year  = 365 * 24 * 60 * 60;
if (empty($_COOKIE['music'])) {
	setcookie('music', 'true', time() + $one_year, '/');
}

if (empty($_COOKIE['volume'])) {
	setcookie('volume', '30', time() + $one_year, '/');
}

if (SYSTEM_ERRORS) {
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
}

if (!empty($_GET)) {
	$get_data          =  array(
		'viewer_id'    => (int)$_GET['viewer_id'],
		'access_token' => $core->escapeString($_GET['access_token']),
		'auth_key'     => $core->escapeString($_GET['auth_key']),
		'referrer'     => $core->escapeString($_GET['referrer']),
		'is_app_user'  => (int)$_GET['is_app_user']
	);
	if ($core->check_user($get_data)) {
		$auth_type = 'VK';
		$user_id = (int)$_SESSION['USER_ID'];
		$user_saves = $core->check_Saves();
		$is_admin = $core->check_IsAdmin();
		$music = $core->escapeString($_COOKIE['music']);
		$volume = $core->escapeString($_COOKIE['volume']);

		require_once 'main.php';
	}
}
