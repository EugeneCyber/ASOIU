<?php
	session_start();
	
	//Берем данные из формы
	$login = $_SESSION["login"];
	$password = $_POST["password"] ?? "";
	$password2 = $_POST["password2"] ?? "";
	
	if (  ($password != "") and ($password2 != "")  ) {
		if ($password != $password2) {
			$conn->query("UPDATE users 
				SET password = '$password2' 
				WHERE login = '$login'
				");
			echo "<script>alert('Пароль успешно изменен!');</script>";
		}
		else {echo "<script>alert('Новый пароль не должен совпадать со старым!');</script>";}
	}
	//else {echo "<script>alert('Неправильный ввод данных!');</script>";}
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
					<div class="bigText" style="padding: 10px 37px;">Изменение пароля</div>
					
					<input type="password" placeholder="Старый пароль" name="password">
					<input type="password" placeholder="Новый пароль" name="password2">
					<input type="submit" value="Изменить пароль" style="padding: 10px 47px; margin: 30px 0px 10px;">
					<a href="/asoiu/info" style="padding: 10px 95px;" class="btn">Назад</a>
				</div>
			</form>
		</div>
	</body>
</html>