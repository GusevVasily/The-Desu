<?php
if (!defined('BYPASS')) exit(header('Location: /'));
?>
<div id="page_save" style="display: none;">
	<div class="bg" style="background: url('./assets/img/bg.png'); background-size: cover; filter: blur(5px);"></div>
	<div class='container'>
		<h1 class='left title'>Сохранить</h1>
		<h1 class='right'><a onclick="toPage('save', 'game');" class='soundbtn'>Назад</a></h1>
		<div class='clear'></div>
		<div class="selectmenu">
			<a onclick='selectGame("*new");'>
				<div class='menublock soundbtn' id='saveblock'>
					<img src='./assets/img/save.png' />
					<span class='date'>
						<center><b>НОВОЕ СОХРАНЕНИЕ</b></center>
					</span>
				</div>
			</a>
			<div id="gamesList">

			</div>			
		</div>
		<input type="hidden" id="selectGame" value="" />
		<h1 class='left'><a onclick='saveGame();' class='soundbtn'>Сохранить</a></h1>
		<h1 class='right'><a onclick='removeGame("save")' class='soundbtn'>Удалить</a></h1>
		<div class='clear'></div>
	</div>
</div>
