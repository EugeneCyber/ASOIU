<?php
	session_start();
	
	if ( empty($_SESSION["login"]) ){
		header("Location: auth");
		die();
	}
	else{
		$login = $_SESSION["login"];
	}
?>

<html>
	<head>
		<title>Настолки</title>
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>
	
	<body>
		<header>
			<a href="/asoiu/" style="color: #000000;">
				<div class="header-left">
					<img src="/asoiu/dice.png"
					style="width: 55px; height: 55px; margin: 5px 5px 5px 20px;">
					
					<div class="nametag">НАСТОЛКИ</div>
				</div>
			</a>
			
			<a href="/asoiu/info">
				<div class="name">
					<div class="login"><?php print ("$login"); ?></div>
					<div class="header-right">
						<img src="/asoiu/user.png">
					</div>
				</div>
			</a>
		</header>
		
		<div class="main">
			<a href="play/">
				<div class="menuButton">
					ИГРАТЬ
				</div>
			</a>
			
			<a href="analytics/">
				<div class="menuButton" style="margin: 0 400 0 400">
					АНАЛИТИКА
				</div>
			</a>
		</div>
	</body>
</html>