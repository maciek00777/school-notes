<?php
//Pobranie danych logowania do bazy z pliku db.php
require_once("db.php");

//Utworzenie połączenia do bazy dancyh
$db = new mysqli($server, $user, $password, $db_name);

if( $db->connect_errno )
    die("Błąd połączenia z bazą danych");


function userExist($username)
{
    global $db;
    $query = "SELECT username FROM users WHERE username ='$username'";
    $result = $db->query($query);
    if ( $result->num_rows == 1 )
        return true;
    else
        return false;
}

function login($username, $pass)
{
    global $db;
    $query = "SELECT id_user, username,is_admin,u_password FROM users WHERE username ='$username' AND u_password = '$pass'";
    $result = $db->query($query);
    if ( $result->num_rows == 1 )
    {
        $row = $result -> fetch_assoc();
        $_SESSION['user'] = $row['username'];
        $_SESSION['is_admin'] = $row['is_admin'];
        return true;
    }
    else
        return false;
}
function register($username, $pass)
{
    global $db;
    $query = "INSERT INTO users (username, u_password)
    VALUES ('$username','$pass')";
    $db->query($query);
    $_SESSION['user'] = $username;
    $_SESSION['is_admin'] = false;
}



/* 
    Pobranie listy miast z bazy
*/
function selectCities() {
    global $db;

    $query = 'SELECT id_city, city_name FROM cities ORDER BY city_name ASC';
    $cities = [];

    $result = $db->query($query);
    if ( $result->num_rows > 0 )
    {
        while( $row = $result->fetch_assoc() )
        {
            $cities[] = array('id_city' => $row['id_city'], 'city_name' => $row['city_name']);
        }
        return $cities;
    }
}


/*
    Obliczanie ceny na podstawie daty i ceny
    DateModifier zawiera klucze
        - modifier - procentowa zmiana ceny
        - feesFreeDate - ile conajmnie dni przed lotem musi być zarezerwowany lot by nie było dopłaty
        - interval - co ile dni licząc od powyższej daty jest naliczana opłata
*/
function calculatePrice( $city1, $city2, $priceKM , $flyDate, $orderDate, $dateModifier)
{
    global $db;

    $query = "SELECT latitude, longitude FROM cities WHERE id_city = '$city1'";
    $result = $db -> query($query);
    $row = $result -> fetch_row();

    $x1 = $row['latitude'];
    $y1 = $row['longitude'];

    $query = "SELECT latitude, longitude FROM cities WHERE id_city = '$city2'";
    $result = $db -> query($query);
    $row = $result -> fetch_row();

    $x2 = $row['latitude'];
    $y2 = $row['longitude'];
    
    //wzór na dystans z współrzędnych
    $distance = ( ($x2 - $x1) ** 2 + ( cos( $x1 * pi() / 180 ) * ( $y2 - $y1 )) ** 2 ) ** 0.5 * 40075.704 / 360;

    //naliczanie mnożnika ceny za datę zamówienia
    $priceModifier = 1 + floor(($flyDate - $orderDate - $dateModifier['feesFreeDate'])/$dateModifier['interval']) * $dateModifier['modifier']/100;

    $price = round($distance * $priceKM * $priceModifier,2);
    return $price;
}


?>