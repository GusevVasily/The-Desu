<?php
if (!defined('BYPASS')) exit(header('Location: /'));
?>
<div id="page_admin" style="display: none;">
	<div class="bg" style="background: url('./assets/bg/ext_square_day.jpg'); background-size: cover; filter: blur(5px);"></div>
	<div class="container">
		<div class='bigmsg'>
			<a onclick="getUsers();">
				<button class="soundbtn" id="nextGame">Пользователи</button>
			</a>
			<a onclick="getLevels();">
				<button class="soundbtn" id="nextGame">Уровни пролога</button>
			</a>
			<a onclick="createProlog();">
				<button class="soundbtn" id="nextGame">Создать новый уровень</button>
			</a>
			<a onclick="toPage('admin', 'menu');">
				<button class="soundbtn" id="nextGame">В меню</button>
			</a>
			<a onclick="toPage('admin', 'settings');">
				<button class="soundbtn" id="nextGame">В настройки</button>
			</a>
			<br><br>
			<div id="admin_box">
				<?=var_dump($_SESSION);?>
			</div>
			<br><br>
			<h1 class='right'>
				<a onclick="unset();" class='soundbtn'>UNSET</a>
			</h1>
		</div>
	</div>
	<div id='character' class='miku1 bigcharacter'></div>
</div>
<script type="text/javascript">
	function getUsers() {
		try {
			$('#admin_box').html('<h1>LOADING...</h1>');
			$.post("admin.php", {"method": "getUsers", "admin_id": USER_ID},
				function onAjaxSuccess(data) { 
					var json = JSON.parse(data);
					if (json.result == true) {
						$('#admin_box').html(json.users);
					}
				}
			);
		} catch (e) { }
	}

	function getLevels() {
		try {
			$('#admin_box').html('<h1>LOADING...</h1>');
			$.post("admin.php", {"method": "getLevels", "admin_id": USER_ID},
				function onAjaxSuccess(data) { 
					var json = JSON.parse(data);
					if (json.result == true) {
						$('#admin_box').html(json.levels);
					}
				}
			);
		} catch (e) { }
	}

	function getLevelTree(level) {
		try {
			$('#admin_box').html('<h1>LOADING...</h1>');
			$.post("admin.php", {"method": "getLevelTree", "admin_id": USER_ID, "level": level},
				function onAjaxSuccess(data) { 
					var json = JSON.parse(data);
					if (json.result == true) {
						$('#admin_box').html(json.title);
					}
				}
			);
		} catch (e) { }
	}

	function createProlog() {
		try {
			$('#admin_box').html('<h1>LOADING...</h1>');
			$.post("admin.php", {"method": "createProlog", "admin_id": USER_ID},
				function onAjaxSuccess(data) { 
					var json = JSON.parse(data);
					if (json.result == true) {
						$('#admin_box').html(json.level);
					}
				}
			);
		} catch (e) { }
	}
</script>
