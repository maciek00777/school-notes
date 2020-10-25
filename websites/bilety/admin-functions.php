<?php
require("functions.php");

function deleteCity($id_city)
{
    global $db;
    $query = "DELETE FROM cities WHERE id_city='$id_city'";
    $db -> query($query);
}

function newCity($city_name,$latitude,$longitude)
{
    global $db;
    $query = "INSERT INTO cities (city_name,latitude,longitude)
    VALUES ('$city_name','$latitude','$longitude')";
    $db->query($query);
}


























?>