function musicTrigger() {
	var sound_element = $('#musicTrigger');
	try {
		$.post("settings.php", {"method": "musicTrigger", "user_id": USER_ID, "status": MUSIC},
			function onAjaxSuccess(data) { 
				var json = JSON.parse(data);
				if (json.result == true) {
					if (sound_element.hasClass('music_off')) {
						MUSIC = true;
						sound_element.removeClass('music_off');
						sound_element.addClass('music_on');
						music_Theme.currentTime = 0;
						music_Theme.play();
					} else {
						MUSIC = false;
						sound_element.removeClass('music_on');
						sound_element.addClass('music_off');
						music_Theme.currentTime = 0;
						music_Theme.pause();
					}
				}
			}
		);
	} catch (e) { }
}

function mu2sicVolume(v) {
	alert(v);
}

function musicVolume() {
	var sound_element = $('#musicVolume').val();
	console.log(sound_element);
	try {
		$.post("settings.php", {"method": "musicVolume", "user_id": USER_ID, "volume": volume},
			function onAjaxSuccess(data) { 
				var json = JSON.parse(data);
				if (json.result == true) {
					music_Theme.volume('-' + sound_element);
				}
			}
		);
	} catch (e) { }
}
