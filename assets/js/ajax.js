function actionGame(type, modal) {
	try {
		var modalPost = modal;
		$('#actionGame').prop('disabled', true);
		$.post("ajax.php", {"method": "game_Action", "user_id": USER_ID, "type": type, "modal": modalPost},
			function onAjaxSuccess(data) {
				console.log(data);
				var json = JSON.parse(data);
				if (json.result == true) {
					if (json.options) {
						var modal = '';
						for (var i = 1; i <= json.options [0].count; i++) {
							modal += ("<a onclick=\"actionGame(2, " + i + ");\"><button>" + json.options [0][i] + "</button></a><br>");
						}

						setMessage(modal);
					} else {
						//$('#globalmessage').css('display', 'none'); //TEST!!
						$('#page_game_bg').css("background-image", "url(./assets/bg/" + json.bg + ".jpg)");
						$('#img').css("background-image", "url(./assets/img/" + json.img + ".png");
						$('#titleSlide').html(json.title);
						$('#textSlide').html(json.text);
						$('#actionGame').prop('disabled', false);
					}
				} else if (json.result == false) {
					//window.location.href = "https://vk.com/app5653633";
					//return;
				}
			}
		);
	} catch (e) { }
}

function newGame() {
	try {
		$('#newGame').prop('disabled', true);
		$.post("ajax.php", {"method": "game_New", "user_id": USER_ID},
			function onAjaxSuccess(data) { 
				var json = JSON.parse(data);
				if (json.result == true) {
					$('#page_menu').css("display", "none");
					$('#page_game').css("display", "block");
					$('#page_game_bg').css("background-image", "url(./assets/bg/" + json.bg + ".jpg)");
					//$('#img').css("background-image", "url(./assets/img/" + json.img + ".png");
					$('#titleSlide').html(json.title);
					$('#textSlide').html(json.text);
					$('#newGame').prop('disabled', false);
				} else if (json.result == false) {
					//window.location.href = "https://vk.com/app5653633";
					//return;
				}
			}
		);
	} catch (e) { }
}

function saveGame() {
	var save_name = $('#selectGame').val();
	var save_cache = $('#game_cache').val();
	try {
		//$('#saveGame').prop('disabled', true);
		$.post("ajax.php", {"method": "game_Save", "user_id": USER_ID, "save_name": save_name, "cache": save_cache},
			function onAjaxSuccess(data) { 
				var json = JSON.parse(data);
				if (json.result == true) {
					$('#gamesList').html(json.title);
					//$('#saveGame').prop('disabled', false);
				} else if (json.result == false) {
					//window.location.href = "https://vk.com/app5653633";
					//return;
				}
			}
		);
	} catch (e) { }
}

function savesGame() {
	try {
		html2canvas($('#game_window'), {
	        onrendered: function(canvas) {
	        	$('#saveGame').prop('disabled', true);
	        	$('#gamesList').html('<h1>LOADING...</h1>');
	        	toPage('game', 'save');
	            var cache = canvas.toDataURL('image/png').replace(/data:image\/png;base64,/, '');
	            $('#game_cache').val(cache);
	            console.log(cache);
				$.post("ajax.php", {"method": "game_Saves", "user_id": USER_ID},
					function onAjaxSuccess(data) { 
						var json = JSON.parse(data);
						if (json.result == true) {
							$('#gamesList').html(json.title);
							$('#saveGame').prop('disabled', false);
						} else if (json.result == false) {
							//window.location.href = "https://vk.com/app5653633";
							//return;
						}
					}
				);
	        }
	    });
	} catch (e) { }
}

function continueGame() {
	try {
		$('#continueGame').prop('disabled', true);
		$.post("ajax.php", {"method": "game_Continue", "user_id": USER_ID},
			function onAjaxSuccess(data) { 
				var json = JSON.parse(data);
				if (json.result == true) {
					$('#page_menu').css("display", "none");
					$('#page_game').css("display", "block");
					$('#page_game_bg').css("background-image", "url(./assets/bg/" + json.bg + ".jpg)");
					//$('#img').css("background-image", "url(./assets/img/" + json.img + ".png");
					$('#titleSlide').html(json.title);
					$('#textSlide').html(json.text);
					$('#continueGame').prop('disabled', false);
				} else if (json.result == false) {
					//window.location.href = "https://vk.com/app5653633";
					//return;
				}
			}
		);
	} catch (e) { }
}

function listGame(type) {
	try {
		$.post("ajax.php", {"method": "game_List", "user_id": USER_ID, "type": type},
			function onAjaxSuccess(data) { 
				var json = JSON.parse(data);
				if (json.result == true) {
					$('#page_menu').css("display", "none");
					$('#page_load').css("display", "block");
					$('#savesList').html(json.title);
				} else if (json.result == false) {
					//window.location.href = "https://vk.com/app5653633";
					//return;
				}
			}
		);
	} catch (e) { }
}

function removeSave() {
	var save_name = $('#selectSave').val();
	alert(save_name);
}

function removeGame(type) {
	if (type == 'load') {
		var save_name = $('#selectSave').val();
		var page = 1;
	} else {
		var save_name = $('#selectGame').val();
		var page = 2;
	}

	try {
		$.post("ajax.php", {"method": "game_Remove", "user_id": USER_ID, "save_name": save_name, "type": page},
			function onAjaxSuccess(data) { 
				var json = JSON.parse(data);
				if (json.result == true) {
					$('#page_menu').css("display", "none");
					if (type == 'load')
						$('#page_load').css("display", "block");
					else
						$('#page_save').css("display", "block");

					if (type == 'load')
						$('#savesList').html(json.title);
					else
						$('#gamesList').html(json.title);

					if (json.title == null)
						$('#selectGame').val('');
				} else if (json.result == false) {
						if (json.error == 'active_save')
							alert('Нельзя удалить загруженное сохранение!');

					//window.location.href = "https://vk.com/app5653633";
					//return;
				}
			}
		);
	} catch (e) { }
}

function loadGame() {
	var save_name = $('#selectSave').val();
	try {
		$.post("ajax.php", {"method": "game_Load", "user_id": USER_ID, "save_name": save_name},
			function onAjaxSuccess(data) { 
				var json = JSON.parse(data);
				if (json.result == true) {
					$('#page_load').css("display", "none");
					$('#page_game').css("display", "block");
					$('#page_game_bg').css("background-image", "url(./assets/bg/" + json.bg + ".jpg)");
					$('#img').css("background-image", "url(./assets/img/" + json.img + ".png");
					$('#titleSlide').html(json.title);
					$('#textSlide').html(json.text);
				} else if (json.result == false) {
					//window.location.href = "https://vk.com/app5653633";
					//return;
				}
			}
		);
	} catch (e) { }
}

function preloadCached() {
	for (var i = 0; i < arguments.length; i++) {
		new Image().src = arguments[i];
	}
}

function cachedLoad(page) {
	try {
		$.post("ajax.php", {"method": "game_SavesCache", "user_id": USER_ID},
			function onAjaxSuccess(data) { 
				var json = JSON.parse(data);
				if (json.result == true) {
					console.log(json);
					if (json.cached != "null")
						preloadCached(json.cached);

					listGame(2);
				} else if (json.result == false) {
					//window.location.href = "https://vk.com/app5653633";
					//return;
				}
			}
		);
	} catch (e) { }
}

function unset() {
	$.post('unset.php', { }, function() {
		location.reload();
	});
}
