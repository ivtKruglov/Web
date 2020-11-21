<?php
// Запуск сессии
session_start();
// Подключаемся к базе данных (параметры: имя сервера, имя пользователя, пароль и имя базы данных)
$db = mysqli_connect("localhost", "id15277221_student", "Fttx1100-778-239", "id15277221_webtest");
// Если подключились к базе данных, то
if ($db)
{
	if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['login']) || empty($_POST['passw']) || $_POST['passw'] != $_POST['passw2'])
	{
		if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['login']) || empty($_POST['passw']))
		{
		    $_SESSION['msg'] = "Заполнены не все поля";
		    header("Location: registration.html");
		}
		if ($_POST['passw'] != $_POST['passw2'])
		{
		    $_SESSION['msg2'] = "Пароли не совпадают";
		    header("Location: registration.html");
		}
	}
	else
	{
		// Запоминаем данные input, отправленные с формы
		$name = $_POST['name'];
		$email = $_POST['email'];
		$login = $_POST['login'];
		$passw = $_POST['passw'];
		if (strlen($passw) < 6)
		{
		    $_SESSION['msg'] = "Пароль должен содержать более 6 символов";
		    header("Location: registration.html");
		}
		$query = "SELECT login,email FROM users";
		$result = mysqli_query($db, $query);
		$existing = mysqli_fetch_all($result);

		foreach($existing as $row)
		{
		    if (in_array($login, $row) || in_array($email, $row))
		    {
		        $_SESSION['msg'] = "Пользователь с такими данными уже существует";
		        header("Location: registration.html");
		    }
		    if($error)
		    {
		        break;
		    }
		}
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
		{
		    header("Location: index.html");
		}
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
	$_SESSION['msg'] = "Не удалось соединиться с сервером";
	header("Location: registration.html");
}
?>