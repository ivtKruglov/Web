function openconfirm()
{
    let confwin = confirm("Вы уверены, что хотите удалить аккаунт?");
    if (confwin)
        document.location.href = "removeacc.php";
    else
        document.location.href = "account.html";
}