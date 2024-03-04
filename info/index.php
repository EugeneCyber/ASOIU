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
	
	//Берем данные из формы
	$birth = $_POST["birth"] ?? "";
	$gender = $_POST["gender"] ?? "";
	
	if ($birth != "") {
		$conn->query("UPDATE users SET birth = '$birth'	WHERE login = '$login'"); }
		
	if ($gender != "") {
		$conn->query("UPDATE users SET gender = '$gender'	WHERE login = '$login'"); }
	
	//переводим дату в строку
	$rightBirth = $conn->query("SELECT birth FROM users WHERE login='$login'");
	$date = "";
	while ($row = $rightBirth->fetch_assoc()) {$date .= $row['birth'];}
	
	//сегодняшняя дата
	$today = date( 'Y-m-d', time()+25200);
	
	//переводим гендер в строку
	$rightGender = $conn->query("SELECT gender FROM users WHERE login='$login'");
	$gen = "";
	while ($row = $rightGender->fetch_assoc()) {$gen .= $row['gender'];}
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
					<div class="bigText" align="center" style="padding: 10px 20px; font-size: 32px;">Информация об игроке <?php print ("$login"); ?></div>
					
					<select style="color: #000000" name="gender">
						<option value="1" <?php if ($gen == '1') {print("selected");} ?> >Мужчина</option>
						<option value="2" <?php if ($gen == '2') {print("selected");} ?> >Женщина</option>
						<option value="3" <?php if ($gen == '3') {print("selected");} ?> >Не определилось(ась)</option>
					</select>
					
					<input type="date" style="padding: 10px 53px; font-size: 20px; color: #000000" max="<?php print("$today") ?>" value="<?php print("$date") ?>" name="birth">
					
					<input type="submit" value="Сохранить" style="padding: 10px 75px; margin: 30px 0px 10px;">
					
					<a href="/asoiu/info/change-password" style="padding: 10px 47px;" class="btn">Изменить пароль</a>
					<a href="/asoiu/auth" style="padding: 10px 92px;" class="btn">Выйти</a>
				</div>
			</form>
		</div>
	</body>
</html>