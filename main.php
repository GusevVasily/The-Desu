<?php
if (!defined('BYPASS')) exit(header('Location: /'));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>The Desu!</title>
	<script type="text/javascript" src="./assets/js/jquery.min.js"></script>
	<script type="text/javascript">
		var USER_ID = <?=$user_id;?>;
		var MUSIC = <?if ($music != 'false') { echo 'true'; } else { echo 'false'; }?>;
		var VOLUME = <?=$volume;?>;

		function preloadImages() {
		  for (var i = 0; i < arguments.length; i++) {
		    new Image().src = arguments[i];
		  }
		}

		preloadImages(
			<?php
			$arr = '';
			foreach ($page_main['img'] as $name) {
				$arr .= '"' . $name . '",';
			}

			echo substr($arr, 0, -1);
		  	?>
		);
	</script>
	<link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
	<link rel="stylesheet" type="text/css" href="./assets/css/font-awesome.min.css" />
	<link rel="stylesheet" type="text/css" href="./assets/css/jquery.arcticmodal.css" />
	<?php
	foreach ($page_main['music'] as $name => $key) {
		echo "<audio id='music_" . $name . "' src='" . $key['src'] . "' preload='auto'></audio>\r\n";
	}
  	?>
</head>
<body>
	<div id="game_window">
		<!--<div class="container">-->
			<div id="page-preloader">
				<div class="spinner"></div>
			</div>
			<?php
			require_once 'pages/warning.php';
			require_once 'pages/menu.php';
			require_once 'pages/load.php';
			require_once 'pages/settings.php';
			require_once 'pages/game.php';
			require_once 'pages/save.php';
			if ($is_admin)
				require_once 'pages/admin.php';
			?>
		<!--</div>-->
	</div>
	<script type="text/javascript" src="./assets/js/functions.js"></script>
	<script type="text/javascript" src="./assets/js/ajax.js"></script>
	<script type="text/javascript" src="./assets/js/settings.js"></script>
	<script type="text/javascript" src='./assets/js/sounds.js'></script>
	<script type="text/javascript" src='./assets/js/html2canvas.js'></script>
	<script type="text/javascript" src='./assets/js/typed.js'></script>
	<script type="text/javascript">
		$(window).on('load', function () {
			setTimeout(function(){
				$('#page_warning').css('display', 'block');
			    var $preloader = $('#page-preloader'),
				    $spinner   = $preloader.find('.spinner');
			    $spinner.fadeOut();
			    $preloader.delay(350).fadeOut('slow');
			    setTimeout(function(){
					$('#page_warning').css('display', 'none');
					$('#page_menu').css('display', 'block');
				}, 1000);
			}, 1000); //!!
		});

		$(document).ready(function() {
			setInterval(session, 300000);
		});
	</script>
</body>
</html>
