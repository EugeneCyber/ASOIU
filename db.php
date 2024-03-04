<?php
	//Данные для подключения к БД
	$hostDB = "localhost";
	$userDB = "root";
	$passDB = "";
	$db = "asoiu";
	
	//Подключение к БД
	$conn = new mysqli($hostDB, $userDB, $passDB, $db);
?>