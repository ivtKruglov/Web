<?php
session_start();
$db = mysqli_connect("localhost", "id15277221_student", "Fttx1100-778-239", "id15277221_webtest");
if ($db)
{
    if (isset($_GET['buy_id']))
    {
        $user_id = $_SESSION['id'];
        $book_id = htmlspecialchars($_GET['buy_id']);
        $book_id = str_replace("'", "", $book_id);
        unset($_GET['buy_id']);
        $query = "INSERT INTO purchases (id_book, id_user) VALUES ('$book_id', '$user_id')";
        mysqli_query($db, $query);
        header("Location: book.html?id='$book_id'");
    }
}
?>