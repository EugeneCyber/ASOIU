<?php
	session_start();
	
	if ( empty($_SESSION["login"]) ){
		header("Location: /asoiu/auth/");
		die();
	}
	else{
		$login = $_SESSION["login"];
	}
	
	require_once '../db.php';
?>

<html>
	<head>
		<title>Настолки</title>
		<link rel="stylesheet" href="/asoiu/style.css" type="text/css"/>
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
			<form method="post">
				<div class="authMenu">
					<div class="bigText" align="center" style="padding: 10px 20px; font-size: 32px;">Библиотека игр</div>
					<a href="http://localhost:3000/" class="btn">Битва на мечах Online</a>
				</div>
			</form>
		</div>
	</body>
</html>