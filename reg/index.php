<?php
	session_start();
	session_unset();
	
	require_once '../db.php';
	
	//Берем данные из формы
	$login = $_POST["login"] ?? "";
	$password = $_POST["password"] ?? "";
	$password2 = $_POST["password2"] ?? "";
	
	if (  ($login != "") and ($password != "") and ($password2 != "")  ) {
		if ($password == $password2) {
			$result = $conn->query("SELECT id FROM users WHERE login='$login'");
			$myrow = $result->fetch_assoc();
			if (!empty($myrow['id'])) {
				echo "<script>alert('Пользователь с таким логином уже зарегистрирован!');</script>";
			}
			else {
				$conn->query("insert into users(login,password)
					values('$login','$password')");
				echo "<script>alert('Вы успешно зарегистрировались!');</script>";
			}
		}
		else {
			echo "<script>alert('Пароли должны совпадать!');</script>";
		}
	}
	else {
		//echo "<script>alert('Неправильный ввод данных!');</script>";
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
					<div class="bigText" style="padding: 10px 37px;">Регистрация</div>
					
					<input type="text" placeholder="Логин" name="login">
					<input type="password" placeholder="Пароль" name="password">
					<input type="password" placeholder="Повторите пароль" name="password2">
					<input type="submit" value="Создать аккаунт" style="padding: 10px 60px; margin: 30px 0px 10px;">
					<a href="/asoiu/auth" style="padding: 10px 50px;" class="btn">Уже есть аккаунт</a>
				</div>
			</form>
		</div>
	</body>
</html>