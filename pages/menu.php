<?php
if (!defined('BYPASS')) exit(header('Location: /'));
?>
<div id="page_menu" style="display: none;">
	<div class="bg" style="background: url('./assets/img/bg.png'); background-size: cover;"></div>
	<div class='container'>
		<div style="display: none;">
			<div class="box-modal" id="globalmessage">
				<div class="content" id="globalmessagetext"></div>
				<div class="clear"></div>
				<br>
			</div>
		</div>
		<h1>Главное меню</h1>
		<div class="menu">
			<a onclick="newGame();">
				<div class="soundbtn menublock" id='mblock'>
					<div class='border'>
						<h2>Новая игра</h2>
						<img src='./assets/img/icon1.png' alt='Новая игра' />
						<p>Начать приключения с чистого листа.</p>
					</div>
				</div>
			</a>
			<?if ($user_saves) {?>
				<a onclick="continueGame();">
					<div class="soundbtn menublock" id='mblock'>
						<div class='border'>
							<h2>Продолжить</h2>
							<img src='./assets/img/icon2.png' alt='Новая игра' />
							<p>Продолжить текущую игру.</p>
						</div>
					</div>
				</a>
			<? } ?>
			<a onclick="toPage('menu', 'load');"><!-- listGame(2); -->
				<div class="soundbtn menublock" id='mblock'>
					<div class='border'>
						<h2>Загрузка</h2>
						<img src='./assets/img/icon3.png' alt='Новая игра' />
						<p>Исправить ошибки прошлого.</p>
					</div>
				</div>
			</a>
			<a onclick="fullScreen(document.getElementById('game_window'));"><!-- listGame(1); -->
				<div class="soundbtn menublock" id='mblock'>
					<div class='border'>
						<h2>Ачивки</h2>
						<img src='./assets/img/icon4.png' alt='Новая игра' />
						<p>Твои последние достижения в игре!</p>
					</div>
				</div>
			</a>
			<div class='clear'></div>
			<a onclick="toPage('menu', 'settings');">
				<button class='btn width soundbtn'>
					<div class='border'>Настройки</div>
				</button>
			</a>
		</div>
	</div>
</div>
