<?php
if (!defined('BYPASS')) exit(header('Location: /'));
?>
<div id="page_load" style="display: none;">
	<div class="bg" style="background: url('./assets/img/bg.png'); background-size: cover; filter: blur(5px);"></div>
	<div class='container'>
		<h1 class='left title'>Загрузка</h1>
		<h1 class='right'><a onclick="toPage('load', 'menu');" class='soundbtn'>В меню</a></h1>
		<div class='clear'></div>
		<div class="selectmenu" id="savesList">
			
		</div>
		<input type="hidden" id="selectSave" value="" />
		<h1 class='left'><a onclick='loadGame();' class='soundbtn'>Загрузить</a></h1>
		<h1 class='right'><a onclick='removeGame("load")' class='soundbtn'>Удалить</a></h1>
		<div class='clear'></div>
	</div>
</div>
