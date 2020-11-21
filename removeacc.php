<?php
session_start();
$db = mysqli_connect("localhost", "id15277221_student", "Fttx1100-778-239", "id15277221_webtest");
if ($db)
{
    $id = $_SESSION['id'];
    $query = 'DELETE FROM users WHERE id='.$id;
    $result = mysqli_query($db, $query);
    $query = 'DELETE FROM purchases WHERE id_user='.$id;
    $result = mysqli_query($db, $query);
    unset($_SESSION['username']);
    unset($_SESSION['id']);
    header("Location: index.html");
}
?>