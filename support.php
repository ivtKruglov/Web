<?php
session_start();

$to = "vadya.kruglov@yandex.ru";
$msg = $_POST['message'];
if (empty($_SESSION['username']))
{
    $email = $_POST['email'];
}
else
{
    $email = $_SESSION['usermail'];
}

if (!empty($msg) && !empty($email))
{
    if (mail($to, "Заявка с сайта о проблеме", $msg, "From: ".$email." \r\n"))
    {
        $_SESSION['msg'] = "Ваше сообщение успешно отправлено.</h2>";
        header("Location: support.html");
    }
    else
    {
        $_SESSION['msg'] = "Не удалось отправить сообщение. Проверьте правильность введенных данных.";
        header("Location: support.html");
    }
}
else
{
    $_SESSION['msg'] = "Не удалось отправить сообщение. Проверьте правильность введенных данных.";
    header("Location: support.html");
}
?>