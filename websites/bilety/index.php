<?php
session_start();
require_once( 'admin-functions.php' );

//Sprawdzenie czy zalogowano
if(isset($_SESSION['user']))
    header("Location: order/display.php");
else if($_SERVER['REQUEST_METHOD']=="POST")
{
    if(empty($_POST['username'])||empty($_POST['password']))
    {
        $error = "Wprowadź wszystkie dane";
        require("login.php");
    }
    else if(userExist($_POST['username']))
    {
        if(!login($_POST['username'],$_POST['password']))
        {
            $error = "Nieprawidłowe hasło";
            require("login.php");
        }
        else header("Location: order/display.php");
    }
    else
    {
        register($_POST['username'],$_POST['password']);
        header("Location: order/display.php");
    }
}
else
    require("login.php");
?>