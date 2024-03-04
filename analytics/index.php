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
	
	//сегодняшняя дата
	//$today = date( 'Y-m-d H:i:s', time()+25200);
	$today = date( 'Y-m-d', time()+25200);
	
	//берем данные из форм
	$firstDate = $_POST["firstDate"] ?? "";
	$secondDate = $_POST["secondDate"] ?? "";
	$selGames = $_POST["selGames"] ?? "";
	//echo ($selGames);
	
	//выбор игры
	if ($selGames == '0' || $selGames == '') { $sel = ""; }
	else { $sel = "AND complitedgames.game_ID = '$selGames'"; }
	
	//проверка на отправку ПОСТ
	if (!isset($_POST["firstDate"])) {
		$firstDate = $today;
		$secondDate = $today;
	}
	
	//если вторая дата больше первой, то меняем их местами
	if ($firstDate > $secondDate) {
		$temp = $firstDate;
		$firstDate = $secondDate;
		$secondDate = $temp;
	}
	
	//вытаскиваем данные для аналитики
	$data = $conn->query("	SELECT users.login, games.name, complitedgames.date, complitedgames.result
							FROM complitedgames, games, users
							WHERE users.id = complitedgames.user_ID AND
							users.login = '$login' AND
							complitedgames.date >= '$firstDate' AND complitedgames.date <= '$secondDate' AND
							complitedgames.game_ID = games.id $sel");
	
	//таблица с аналитикой
	$table = "<table border='1'>";
	$table .= "";
	
	//шапка таблицы
	/*$table .= "<thead>";
		$table .= "<tr>";
		$table .= "<td>Название игры</td>";
		$table .= "<td>Дата</td>";
		$table .= "<td>Счет</td>";
		$table .= "</tr>";
	$table .= "</thead>"; */
	
	//тело таблицы
	while ($row = $data->fetch_assoc()) {
		$table .= "<tr>";
			$table .= "<td>";$table .= $row['name']; $table .= "</td>";
			$table .= "<td>";$table .= $row['date']; $table .= "</td>";
			$table .= "<td>";$table .= $row['result']; $table .= "</td>";
		$table .= "</tr>";
	}
	//конец таблицы
	$table .= "</table>";
	
	//выбор игры
	$selectGame = "";
	$dataSelectGame = $conn->query("SELECT games.id, games.name FROM games");
	while ($row = $dataSelectGame->fetch_assoc()) {
		$selectGame .= "<option value='"; $selectGame .= $row['id']; $selectGame .= "'>";
		$selectGame .= $row['name'];
		$selectGame .= "</option>";
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
				<div class="analyticsMenu">
					<div class="bigText" align="center" style="padding: 10px 20px; font-size: 32px;">Аналитика</div>
					
					<div style="display: flex;">
						<div class="analyticsDate">
							<div style="display: flex;">
								<div class="otDateDoDate">От</div>
								<input type="date" name="firstDate" value="<?php print("$firstDate") ?>" max="<?php print("$today") ?>">
							</div>
							
							<div style="display: flex;">
								<div class="otDateDoDate">До</div>
								<input type="date" name="secondDate" value="<?php print("$secondDate") ?>" max="<?php print("$today") ?>">
							</div>
							
							<div style="display: flex;">
								<div class="otDateDoDate">Игры</div>
								<select style="color: #000000" name="selGames">
									<option value="0" selected>Все</option>
									<?php print("$selectGame") ?>
								</select>
							</div>
							
							<input type="submit" value="Выбор" style="margin: 30px 0px 10px;">
						</div>
						
						<div>
							<table border='1'><thead><tr>
								<td>Название игры</td> <td>Дата</td> <td>Счет</td>
							</tr></thead></table>
							<div class="contentTable"><?php print("$table") ?></div>
						</div>
						
					</div>
				</div>
			</form>
		</div>
	</body>
</html>