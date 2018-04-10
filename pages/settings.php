<?php
if (!defined('BYPASS')) exit(header('Location: /'));
?>
<div id="page_settings" style="display: none;">
	<div class="bg" style="background: url('./assets/img/bg.png'); background-size: cover; filter: blur(5px);"></div>
	<div class='bigmsg'>
		<h1 class='left title'>Настройки</h1>
		<br>
		<h1 class='right'>
			<a onclick="musicTrigger();" id="musicTrigger" class='soundbtn <?if ($music != 'false') { echo 'music_on'; } else { echo 'music_off'; }?>'>Музыка</a>
			<input oninput="musicVolume(this.value);" onchange="musicVolume(this.value);" id="musicVolume" type="range" min="0" max="100" step="1" value="<?=$volume;?>" /> 
		</h1>
		<br><br>
		<?if ($is_admin) {?>
			<h1 class='right'>
				<a onclick="toPage('settings', 'admin');" class='soundbtn'>ADMIN</a>
			</h1>
			<br><br>
		<? } ?>
		<h1 class='right'>
			<a onclick="toPage('settings', 'menu');" class='soundbtn'>Назад</a>
		</h1>
	</div>
	<div id='character' class='miku1 bigcharacter'></div>
</div>
