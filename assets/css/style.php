<?php
header("Content-type: text/css");
?>
@font-face {
    font-family: NeoSansProRegular;
    src: url(./NeoSansProRegular.ttf);
}

@font-face {
    font-family: NeoSansProBold;
    src: url(./NeoSansProBold.ttf);
}

b, h1, h2, h3, h4, h5 {
	font-family:NeoSansProBold;
}

b { font-weight: bold; }
a { cursor: url('pointer.cur'), pointer; text-decoration: none; }
button, input, textarea, select, option { cursor: url('pointer.cur'), pointer; border: none; outline:none; }
html, body  {
	padding: 0;
	margin: 0;
	font-family: NeoSansProRegular;
	height: 100%;
    cursor: url('default.cur'), default;
}

.container { width: 800px; margin: 0 auto; }
.link { cursor: pointer; }
.clear { clear: both; }

.box-modal { position: relative; width: 560px; min-height: 50px; background: #fff; color: #202020; text-align: center; }
.box-modal .content { width: 500px; margin: 25px 0 0 20px; font-size: 16px; float: left; padding: 0px; }

.wrapper {
	min-height: 100%;
	color: #FFD76E;
	background-position: center top;
	background-repeat: no-repeat;
	background-attachment: fixed;
}

#titleSlide, #textSlide {
    width: 40em;
    font-size: 22px;
    white-space:nowrap;
    overflow:hidden;
    -webkit-animation: type 5s steps(50, end);
    animation: type 3s steps(50, end);
}
@keyframes type{
    from { width: 0; }
}
 
@-webkit-keyframes type{
    from { width: 0; }
}

#page-preloader {
    position: fixed;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    background: #000;
    z-index: 100500;
}

#page-preloader .spinner {
    width: 32px;
    height: 32px;
    position: absolute;
    left: 50%;
    top: 50%;
    background: url('spinner.gif') no-repeat 50% 50%;
    margin: -16px 0 0 -16px;
}