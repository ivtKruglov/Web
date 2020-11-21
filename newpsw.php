<?php
// Запуск сессии
session_start();
// Подключаемся к базе данных (параметры: имя сервера, имя пользователя, пароль и имя базы данных)
$db = mysqli_connect("localhost", "id15277221_student", "Fttx1100-778-239", "id15277221_webtest");
// Если подключились к базе данных, то
if ($db)
{
	if(empty($_POST['oldpsw']) || empty($_POST['newpsw']) || empty($_POST['newpsw2']))
	{
	    $_SESSION['msg'] = "Введите пароль во все поля";
	    header("Location: nameform.html");
	}
	if($_POST['newpsw'] != $_POST['newpsw2'])
	{
	    $_SESSION['msg'] = "Пароли не совпадают";
	    header("Location: pswform.html");
	}
	else
	{
	    $oldpsw = $_POST['oldpsw'];
		$newpsw = $_POST['newpsw'];
		$confrimpsw = $_POST['newpsw2'];
		$id = $_SESSION['id'];
		
	    $query = "SELECT password FROM users WHERE (id='$id')";
		$result = mysqli_query($db, $query);
		$data = mysqli_fetch_row($result);
		
		if (in_array($oldpsw, $data))
		{
		    $query = "UPDATE users SET password='$newpsw' WHERE (id='$id')";
		    $result = mysqli_query($db, $query);
		    if ($result)
		    {
		        header("Location: account.html");
		    }
		    else
		    {
		        $_SESSION['msg'] = "Ошибка";
		        header("Location: pswform.html");
		    }
		}
		else
		{
		    $_SESSION['msg'] = "Неверный пароль от аккаунта";
		    header("Location: pswform.html");
		}
	}
}
else
{
	// Если не подключились к базе данных, выводим ошибку
	$_SESSION['msg'] = "Не удалось соединиться с сервером";
	header("Location: pswform.html");
}
?>