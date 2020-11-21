<?php
session_start();
$db = mysqli_connect("localhost", "id15277221_student", "Fttx1100-778-239", "id15277221_webtest");
if ($db)
{
    $datetime = date("d.m.y H:i");
    $name = $_SESSION['username'];
    $text = $_POST['text'];
    $bookid = $_SESSION['bookid'];
    unset($_SESSION['bookid']);
    $query = "INSERT INTO comments(datetime, name, text, book_id) VALUES ('$datetime', '$name', '$text', '$bookid')";
    if ($text == "")
    {
        $_SESSION['error'] = "Вы не можете отправить пустой комментарий";
    }
    else
    {
        $result = mysqli_query($db, $query);
        if (!$result)
        {
            $_SESSION['error'] = "Ошибка ".mysqli_errno($db);
        }
    }
    header("Location: ".$_SERVER["HTTP_REFERER"]);
}
else
{
    $_SESSION['error'] = "Не удалось соединиться с сервером";
    header("Location: ".$_SERVER["HTTP_REFERER"]);
}
?>