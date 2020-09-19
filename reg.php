<?php
// Запуск сессии
session_start();
// Подключаемся к базе данных (параметры: имя сервера, имя пользователя, пароль и имя базы данных)
$db = mysqli_connect("localhost", "root", "Fttx1100-778-239", "web");
// Если подключились к базе данных, то
if ($db)
{
	if(empty($_POST['login']) || empty($_POST['passw']) || $_POST['passw'] != $_POST['passw2'])
	{
		if(empty($_POST['login']) || empty($_POST['passw']))
			$_SESSION['msg'] = "Введите логин или пароль";
		if ($_POST['passw'] != $_POST['passw2'])
			$_SESSION['msg2'] = "Пароли не совпадают";
	}
	else
	{
		// Запоминаем данные input, отправленные с формы
		$name = $_POST['name'];
		$email = $_POST['email'];
		$login = $_POST['login'];
		$passw = $_POST['passw'];

		// Определяем индекс нового пользователя
		$query = "SELECT MAX(id) FROM users";
		$result = mysqli_query($db, $query);
		$max = mysqli_fetch_array($result);
		$id = $max['MAX(id)'] + 1;

		// Добавляем запись нового пользователя в таблицу users
		$query = "INSERT INTO users(id, name, email, login, password) VALUES('$id', '$name', '$email', '$login', '$passw')";
		$result = mysqli_query($db, $query);
		// Выводим ошибку, если регистрация не прошла успешно
		if($result != FALSE)
			header("Location: login.html");
		else
		{
			$_SESSION['msg'] = "Регистрация не прошла успешно";
			header("Location: registration.html");
		}
	}
}
else
{
	// Если не подключились к базе данных, выводим ошибку
	$_SESSION['msg'] = "Не удалось подключиться к базе данных";
}
?>