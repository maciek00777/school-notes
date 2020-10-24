<?php
$title = "Nowa rezerwacja";
include('../templates/header.php');
include('../templates/menu.php');
include('../functions.php');
?>

<?php

if(isset($_GET['miasto1']))
{
    if($_GET['miasto1']==$_GET['miasto2'])
    {
        $error = "Wybierz 2 różne miasta";
        include('new/select.php');
    }
    else
    {
        if(isset($_POST['miasto1']))
        {
            //reserve();
        }
        else
        include('new/summary.php');
    }
}
else
    include('new/select.php');

?>

<?php
include('../templates/footer.php');
?>