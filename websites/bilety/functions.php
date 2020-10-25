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
    $query = "SELECT username,is_admin,u_password FROM users WHERE username ='$username' AND u_password = '$pass'";
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

    $query = 'SELECT * FROM cities ORDER BY city_name ASC';
    $cities = [];

    $result = $db->query($query);
    if ( $result->num_rows > 0 )
    {
        while( $row = $result->fetch_assoc() )
        {
            $cities[] = array('id_city' => $row['id_city'], 'city_name' => $row['city_name'],'latitude'=>$row['latitude'],'longitude'=>$row['longitude']);
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
    $distance=getDistance($city1, $city2);

    //naliczanie mnożnika ceny za datę zamówienia
    $pricedays = $dateModifier['feesFreeDate']-date_diff($flyDate,$orderDate)->days;
    if($pricedays>0)
        $priceModifier = 1 + ceil($pricedays/$dateModifier['interval']) * $dateModifier['modifier']/100;
    else $priceModifier = 1;
    $price = round($distance * $priceKM * $priceModifier,2);
    return $price;
}

function getDistance($city1, $city2)
{
    global $db;

    $query = "SELECT latitude, longitude FROM cities WHERE id_city = '$city1'";
    $result = $db -> query($query);
    $row = $result -> fetch_assoc();

    $x1 = $row['latitude'];
    $y1 = $row['longitude'];

    $query = "SELECT latitude, longitude FROM cities WHERE id_city = '$city2'";
    $result = $db -> query($query);
    $row = $result -> fetch_assoc();

    $x2 = $row['latitude'];
    $y2 = $row['longitude'];
    
    //wzór na dystans z współrzędnych
    return ( ($x2 - $x1) ** 2 + ( cos( $x1 * pi() / 180 ) * ( $y2 - $y1 )) ** 2 ) ** 0.5 * 40075.704 / 360;

}


function reserve($city1,$city2,$price,$date,$username)
{
    global $db;
    $id_user = ( ( $db->query("SELECT id_user FROM users WHERE username='$username'") )->fetch_assoc() )['id_user'];
    $query =
    "INSERT INTO orders (id_city1,id_city2,price,date)
    VALUES ($city1,$city2,$price,'$date');";
    $db->query($query);
    $query ="INSERT INTO orderuser (id_order,id_user) VALUES ($db->insert_id,$id_user)";
    $db->query($query);
}

function selectOrders($username,$asAdmin=false) {
    global $db;

    //połącz wszelkie tabele na podstawie relacji
    $query = 
    'SELECT orders2.*, users.username FROM orderuser
    JOIN 
    	(
        SELECT orders.*,city1.city_name AS city1_name,city2.city_name AS city2_name FROM orders
            LEFT JOIN cities AS city1 ON city1.id_city=orders.id_city1
            LEFT JOIN cities AS city2 ON city2.id_city=orders.id_city2
    	) AS orders2
    	ON orderuser.id_order = orders2.id_order
    LEFT JOIN users ON users.id_user = orderuser.id_user';
    //nie mogę powiedzieć że było łatwo, bo nie było ;D

    if($asAdmin)
        $query = $query.' ORDER BY users.username ASC';
    else
        $query = $query." WHERE users.username='$username' ORDER BY date ASC";
    $orders = [];

    $result = $db->query($query);
    if ( $result->num_rows > 0 )
    {
        while( $row = $result->fetch_assoc() )
        {
            $orders[] = array('id_order'=>$row['id_order'],'fly_date' => $row['date'], 'city1' => $row['city1_name'],'city2'=>$row['city2_name'],'price'=>$row['price'],'username'=>$row['username']);
        }
        return $orders;
    }
}

function deleteOrder($id_order,$username,$asAdmin=false)
{
    global $db;
    //Jeśli nie użyto narzędzi administracyjnych, sprawdź czy użytkownik ma na swoim koncie dane zamówienie
    if(!$asAdmin)
    {
        $query = 
        "SELECT orders.id_order, users.username FROM orderuser
        JOIN orders ON orderuser.id_order = orders.id_order
        LEFT JOIN users ON users.id_user = orderuser.id_user
        WHERE users.username='$username' AND orders.id_order='$id_order'
        ";
        if( ($db->query($query)) -> num_rows == 0) return 1;
        //jeśli dany użytkownik nie ma na swoim koncie zamówienia danym nr, wyjdź z funkcji
    }

    $query = "DELETE FROM orders WHERE id_order=$id_order";
    $db -> query($query);
    return 0;
}
?>