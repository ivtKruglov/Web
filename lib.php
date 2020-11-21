<?php
function outdata($res)
{
    $books = mysqli_fetch_all($res);
	foreach($books as $row)
	{
		$image = base64_encode($row[1]);
	    echo "<div class=book>";
	    echo "<img src='data:image/png;base64,".$image."'width='120' height='170'/>";
	    echo "<a href=book.html?id='$row[2]'>".$row[0]."</a>";
	    echo "</div>";
	}
}

// Подключаемся к базе данных (параметры: имя сервера, имя пользователя, пароль и имя базы данных)
$db = mysqli_connect("localhost", "id15277221_student", "Fttx1100-778-239", "id15277221_webtest");
// Если подключились к базе данных, то
if ($db)
{
    echo "<div class=cts>";
    echo "<h2>Категории</h2>";
    echo "<a href=lib.html?category=new>Новинки</a>";
    echo "<a href=lib.html?category=foreign>Зарубежное</a>";
    echo "<a href=lib.html?category=classic>Классика</a>";
    echo "<a href=lib.html?category=Ужасы>Ужасы</a>";
    echo "<a href=lib.html?category=Роман>Романы</a>";
    echo "</div>";
	echo "<div class=lib>";
	echo "<form name=search method=get>";
	echo "<input type=text name=search id=search>";
	echo "<input type=submit name=button id=button value=Поиск>";
	echo "</form>";
	echo "<div class=books>";
	if (!isset($_GET['search'])&&!isset($_GET['category']))
	{
	    $query = "SELECT title, bookcover, id FROM books";
	}
	else if(isset($_GET['search']))
	{
	    $title = $_GET['search'];
	    $query = "SELECT title, bookcover, id FROM books WHERE title='$title'";
	    unset($_GET['search']);
	}
	else
	{
	    if ($_GET['category'] == 'new')
	    {
	        $query = "SELECT title, bookcover, id FROM books WHERE year=2020";
	    }
	    else if ($_GET['category'] == 'foreign')
	    {
	        $rus = "Россия";
	        $query = "SELECT title, bookcover, id FROM books WHERE country<>'Россия'";
	    }
	    else if ($_GET['category'] == 'classic')
	    {
	        $query = "SELECT title, bookcover, id FROM books WHERE classic=1";
	    }
	    else
	    {
	        $genre = $_GET['category'];
	        $query = "SELECT title, bookcover, id FROM books WHERE genre='$genre'";
	    }
	    unset($_GET['category']);
	}
	$result = mysqli_query($db, $query);
	if ($result != FALSE)
	{
	    outdata($result);
	}
	else
	{
	    $error = mysqli_errno($db);
	    echo "<h2>Ошибка:".$error."</h2>";
	}
	echo "</div>";
	echo "</div>";
}
?>