<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona Logowania</title>
</head>
<!-- nie includuję tu header.php tylko ręcznie piszę head ze względu na działanie zabezpieczające przed niezalogowaniem w header.php-->

<body>
<form method="post">
Zaloguj się<br>
Username: <input type="text" name="username"><br>
Password: &nbsp<input type="password" name="password"><br>
<input type="submit">
</form>
<br> W przypadku nieistniejącego użytkownika, nowy użytkownik zostanie utworzony<br>
<?php
include('templates/footer.php');
?>