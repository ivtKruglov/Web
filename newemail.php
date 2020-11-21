<?php
// Запуск сессии
session_start();
// Подключаемся к базе данных (параметры: имя сервера, имя пользователя, пароль и имя базы данных)
$db = mysqli_connect("localhost", "id15277221_student", "Fttx1100-778-239", "id15277221_webtest");
// Если подключились к базе данных, то
if ($db)
{
	if(empty($_POST['newemail']) || empty($_POST['oldemail']))
	{
		if(empty($_POST['newemail']) || empty($_POST['oldemail']))
		{
		    $_SESSION['msg'] = "Введите адрес почты";
		    header("Location: nameform.html");
		}
	}
	else
	{
	    $oldemail = $_POST['oldemail'];
		$newemail = $_POST['newemail'];
		$passw = $_POST['passw'];
		$id = $_SESSION['id'];
		
	    $query = "SELECT email,password FROM users WHERE (id='$id')";
		$result = mysqli_query($db, $query);
		$data = mysqli_fetch_row($result);
		
		if (in_array($oldemail, $data) && in_array($passw, $data))
		{
		    $query = "UPDATE users SET email='$newemail' WHERE (id='$id')";
		    $result = mysqli_query($db, $query);
		    if ($result)
		    {
		        header("Location: account.html");
		    }
		    else
		    {
		        $_SESSION['msg'] = "Ошибка";
		        header("Location: nameform.html");
		    }
		}
		else
		{
		    $_SESSION['msg'] = "Неверный адрес почты или пароль";
		    header("Location: nameform.html");
		}
	}
}
else
{
	// Если не подключились к базе данных, выводим ошибку
	$_SESSION['msg'] = "Не удалось соединиться с сервером";
	header("Location: nameform.html");
}
?>