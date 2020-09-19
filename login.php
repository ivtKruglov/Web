<?php
session_start();
// Подключаемся к базе данных (параметры: имя сервера, имя пользователя, пароль и имя базы данных)
$db = mysqli_connect("localhost", "root", "Fttx1100-778-239", "web");
if ($db)
{
	if(empty($_POST['login']) || empty($_POST['passw']))
	{
		$_SESSION['msg'] = "Неверный логин или пароль";
		header("Location: login.html");
	}
	else
	{
		$login = $_POST['login'];
		$passw = $_POST['passw'];
		// Ищем пользователя с введенными логином и паролем в таблице
		$query = "SELECT * FROM users WHERE(login = '$login' AND password = '$passw')";
		$result = mysqli_query($db, $query);
		// Если пользователь, не найден, выводим ошибку
		if (mysqli_num_rows($result) > 0)
		{
			$_SESSION['user'] = 
			[
				"name" => $user['id'],
				"login" => $user['login'],
				"email" => $user['email']
			];
			header("Location: main.html");
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
	$_SESSION['msg'] = "Не удалось подключиться к базе данных";
}
?>