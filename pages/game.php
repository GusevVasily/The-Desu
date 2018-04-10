<?php
if (!defined('BYPASS')) exit(header('Location: /'));
?>
<div id="page_game" style="display: none;">
	<div class="bg" id="page_game_bg" style="background: url('./assets/img/save.png'); background-size: cover;"></div>
	<div style="display: none;">
		<div class="box-modal" id="globalmessage">
			<div class="content" id="globalmessagetext"></div>
			<div class="clear"></div>
			<br>
		</div>
	</div>
	<div class="container">
		<div class='bigmsg'>
			<a onclick="actionGame(1);">
				<button class="soundbtn" id="nextGame">Назад</button>
			</a>
			<a onclick="savesGame();">
				<button class="soundbtn" id="saveGame">Сохранить игру</button>
			</a>
			<a onclick="actionGame(2);">
				<button class="soundbtn" id="nextGame">Дальше</button>
			</a>
			<a onclick="toPage('game', 'settings');">
				<button class="soundbtn" id="nextGame">Настройки</button>
			</a>
			<a onclick="toPage('game', 'menu');">
				<button class="soundbtn" id="nextGame">В меню</button>
			</a>
			<!--
			<?if ($is_admin) {?>
				<a onclick="adminPanel();">
					<button class="soundbtn" id="adminPanel">Админ-Панель</button>
				</a>
			<? } ?>
			<a onclick="fullScreen(html);">
				<button class="soundbtn" id="listGame">Развернуть</button>
			</a>
			-->
			<div id="titleSlide"></div><br>
			<div id="textSlide"></div><br>
			<div id="img" style="width: 100px; height: 100px;"></div>
			<div id='character' class='miku1 bigcharacter'></div>
			<input type="hidden" id="game_cache" value="" />
		</div>
	</div>
</div>
