<?php
$title = "Nowa rezerwacja";
include('../templates/header.php');
include('../templates/menu.php');
include('../functions.php');
?>

<?php

if(isset($_GET['city1']))
{
    if($_GET['city1']==$_GET['city2'])
    {
        $error = "Wybierz 2 różne miasta";
        include('new/select.php');
    }
    else if(empty($_GET['fly_date']))
    {
        $error = "Nie podano daty wylotu";
        include('new/select.php');
    }
    else if(new DateTime($_GET['fly_date'])<new DateTime("now"))
    {
        $error = "Niestety nie możesz zarezerwować miejsca na lot, który się już odbył";
        include('new/select.php');
    }
    else
    {
        include('new/summary.php');
    }
}
else if(isset($_POST['city1']))
{
    reserve($_POST['city1'],$_POST['city2'],$_POST['price'],$_POST['fly_date'],$_SESSION['user']);
    header("Location: display.php");
}
else
    include('new/select.php');

?>

<?php
include('../templates/footer.php');
?>