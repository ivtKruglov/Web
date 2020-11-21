<?php
session_start();
// Подключаемся к базе данных (параметры: имя сервера, имя пользователя, пароль и имя базы данных)
$db = mysqli_connect("localhost", "id15277221_student", "Fttx1100-778-239", "id15277221_webtest");
if ($db)
{
	if(empty($_POST['login']) || empty($_POST['passw']))
	{
		$_SESSION['msg'] = "Введите логин и пароль";
		header("Location: login.html");
	}
	else
	{
		$login = $_POST['login'];
		$passw = $_POST['passw'];
		// Ищем пользователя с введенными логином и паролем в таблице
		$query = "SELECT name, id,email FROM users WHERE(login = '$login' AND password = '$passw')";
		$result = mysqli_query($db, $query);
		// Если пользователь, не найден, выводим ошибку
		if (mysqli_num_rows($result) > 0)
		{
			$row = mysqli_fetch_row($result);
			$_SESSION['username'] = $row[0];
			$_SESSION['id'] = $row[1];
			$_SESSION['usermail'] = $row[2];
			header("Location: index.html");
		}
		else
		{
			$_SESSION['msg'] = "Неверный логин или пароль";
			header("Location: login.html");
		}
	}
}
else
{
	$_SESSION['msg'] = "Не удалось подключиться к серверу";
}
?>