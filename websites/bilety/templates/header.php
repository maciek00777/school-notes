<?php
session_start();
if($_GET['logout']==1 || !isset($_SESSION['user']))
{
    session_unset();
    header("Location: http://".$_SERVER['SERVER_ADDR']); 
}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
</head>
<body>
    
