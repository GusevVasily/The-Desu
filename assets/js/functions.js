function session() {
	var result = '';
	$.post("session.php", function(result) { });
}

function fullScreen(element) {
  if(element.requestFullscreen) {
    element.requestFullscreen();
  } else if(element.webkitrequestFullscreen) {
    element.webkitRequestFullscreen();
  } else if(element.mozRequestFullscreen) {
    element.mozRequestFullScreen();
  } else if(element.msRequestFullscreen) {
    element.msRequestFullscreen();
  }
}

function fullScreenCancel() {
  if(document.requestFullscreen) {
    document.requestFullscreen();
  } else if(document.webkitRequestFullscreen ) {
    document.webkitRequestFullscreen();
  } else if(document.mozRequestFullscreen) {
    document.mozRequestFullScreen();
  }
}

function setMessage(text) {
	$('#globalmessagetext').html(text);
	$('#globalmessage').arcticmodal();
}

function toPage(x, y) {
  $('#page_' + x).css("display", "none");
  $('#page_' + y).css("display", "block");
  if (y == 'load') {
    $('#savesList').html('<h1>LOADING...</h1>');
    cachedLoad();
  }
}

function selectSave(save) {
  $('#selectSave').val(save);
}

function selectGame(save) {
  $('#selectGame').val(save);
}
