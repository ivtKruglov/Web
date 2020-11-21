<?php
function outdata($res)
{
    $count = 0;
    $books = mysqli_fetch_all($res);
	foreach($books as $row)
	{
	    if ($count < 16)
	    {
	        $image = base64_encode($row[1]);
	        echo "<div class=book>";
	        echo "<img src='data:image/png;base64,".$image."'width='120' height='170'/>";
	        echo "<a href=book.html?id='$row[2]'>".$row[0]."<a>";
	        echo "</div>";
	        $count += 1;
	    }
	    else
	    {
	        break;
	    }
	}
}

// Подключаемся к базе данных (параметры: имя сервера, имя пользователя, пароль и имя базы данных)
$db = mysqli_connect("localhost", "id15277221_student", "Fttx1100-778-239", "id15277221_webtest");
// Если подключились к базе данных, то
if ($db)
{
    echo "<div class=slideshow-container id=slideshow-container>";
	echo "<div id=slides>";
    $query = "SELECT title, bookcover, id FROM books WHERE
    ((title='Портрет Дориана Грея') AND ('author=Оскар Уайльд')) OR
    ((title='Мастер и Маргарита') AND (author='М. А. Булгаков')) OR
    ((title='Мартин Иден') AND (author='Джек Лондон')) OR
    ((title='Институт') AND (author='Стивен Кинг')) OR
    ((title='Воображаемый друг') AND (author='Стивен Чбоски')) OR
    ((title='Квест Академия') AND (author='Марина Ефиминюк')) OR
    ((title='История о магии') AND (author='Крис Колфер')) OR
    ((title='Голод') AND (author='Кнут Гамсун')) OR
    ((title='Станция на пути туда, где лучше') AND (author='Бенджамин Вуд')) OR
    ((title='Республика Дракон') AND (author='Ребекка Ф. Куанг')) OR
    ((title='Отцы и дети') AND (author='И. С. Тургенев')) OR
    ((title='Летний ресторанчик на берегу') AND (author='Дженни Колган')) OR
    ((title='The One. Единственный') AND (author='Джон Маррс'))";
	$result = mysqli_query($db, $query);
	if ($result != FALSE)
	{
	    outdata($result);
	}
	echo "</div>";
	echo "</div>";
	
    echo "<h2>Новинки</h2>";
    echo "<div class=cties>";
    $query = "SELECT title, bookcover, id FROM books WHERE books.year=2020";
	$result = mysqli_query($db, $query);
	if ($result != FALSE)
	{
	    outdata($result);
	}
	echo "</div>";
	
    echo "<h2>Классика</h2>";
    echo "<div class=cties>";
	// Определяем индекс нового пользователя
	$query = "SELECT title, bookcover, id FROM books WHERE books.classic=1";
	$result = mysqli_query($db, $query);
	if ($result != FALSE)
	{
	    outdata($result);
	}
	echo "</div>";
	
	echo "<h2>Зарубежное</h2>";
	echo "<div class=cties>";
	$query = "SELECT title, bookcover, id FROM books WHERE books.country <> 'Россия'";
	$result = mysqli_query($db, $query);
	if ($result != FALSE)
	{
	    outdata($result);
	}
	echo "</div>";
}
?>