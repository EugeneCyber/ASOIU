<?php
	session_start();
	session_unset();
	
	require_once '../db.php';
	
	//Берем данные из формы
	$login = $_POST["login"] ?? "";
	$password = $_POST["password"] ?? "";
	
	$result = $conn->query("SELECT id FROM users WHERE login='$login'");
	$myrow = $result->fetch_assoc();
	//Проверка наличия пользователя с таким логином
	if (!empty($myrow['id'])) {
		//Проверка пароля
		$checkPass = $conn->query("SELECT password FROM users WHERE login='$login'");
		$passRow = $checkPass->fetch_assoc();
		
		if ($passRow['password'] == $password) {
			//echo "<script>alert('Успешный вход!');</script>";
			$_SESSION["login"] = $login;
			setcookie(
				"cookieLogin",
				$login,
				$expires_or_options = 0,
				$path = "/");
			
			//Переход на главную страницу
			header("Location: /asoiu/");
			die();
		}
		else {
			echo "<script>alert('Неверный пароль!');</script>";
		}
	}
	else {
		//echo "<script>alert('Пользователь с таким логином не найден!');</script>";
	}
	
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
				<div class="header-right">
					<img src="/asoiu/user.png">
				</div>
			</a>
		</header>
		
		<div class="main">
			<form method="post">
				<div class="authMenu">
					<div class="bigText" style="padding: 10px 88px;">Вход</div>
					
					<input type="text" placeholder="Логин" name="login">
					<input type="password" placeholder="Пароль" name="password">
					<input type="submit" value="Войти" style="margin: 30px 0px 10px;">
					<a href="/asoiu/reg" class="btn">Регистрация</a>
				</div>
			</form>
		</div>
	</body>
</html>