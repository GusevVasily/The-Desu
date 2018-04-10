$(document).ready(function() {
	var hoveraudio = new Audio();
	hoveraudio.src = './assets/sounds/hover.mp3';
	var clickaudio = new Audio();
	clickaudio.src = './assets/sounds/click.mp3';

	$('.soundbtn').hover(function() {
		hoveraudio.pause();
		hoveraudio.currentTime = 0;
		hoveraudio.play();
	}, function() { });

	$('.soundbtn').click(function() {
		clickaudio.play();
	});
});

//var music_Theme = new Audio();
//music_Theme.src = './assets/sounds/theme.mp3';
var music_Theme = document.getElementById('music_theme');
if (MUSIC) {
	//music_Theme.volume('-' + VOLUME);
	console.log('-' + VOLUME);
	music_Theme.play();
}
