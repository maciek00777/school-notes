<style>
    th,td{
        width: 100px;
        text-align: center;
    }
</style>

<?php
$city1=$_GET['city1'];
$city2=$_GET['city2'];
$fly_date=$_GET['fly_date'];
$distance=round(getDistance($city1,$city2),2);
$price=
    calculatePrice
    (
    $city1,
    $city2,
    2,  //$priceKM,
    date_create($fly_date),
    new DateTime("now"),   //$orderDate
    array('modifier'=>10,'feesFreeDate'=>180,'interval'=>40) // $dateModifier
    )
?>

<h2>Twoja rezerwacja:</h2>
<table>
<tr>
    <th>Data</th>
    <th>Odlot</th>
    <th>Przylot</th>
    <th>Dystans</th>
    <th>Cena</th>
</tr>
<tr>
    <td><?php echo $fly_date ?></td>
    <td> <!-- zamiana id na nazwe -->
        <?php
        echo (( $db -> query("SELECT city_name FROM cities WHERE id_city =".$city1) )-> fetch_assoc() )['city_name']; 
        ?>
    </td>
    <td>
        <?php
        echo (( $db -> query("SELECT city_name FROM cities WHERE id_city =".$city2) )-> fetch_assoc() )['city_name']; 
        ?>
    </td>
    <td><?php echo $distance?>km</td>
    <td><?php echo $price?>zł</td>
</tr>
<tr>
	<form method="POST" action="new.php">
    <input name="city1" value=<?php echo $city1?> hidden/>
    <input name="city2" value=<?php echo $city2?> hidden/>
    <input name="price" value=<?php echo $price?> hidden/>
    <input name="fly_date" value=<?php echo $fly_date?> hidden/>
    <td colspan="4"><input type="submit" value="Potwierdź"/></td>
    </form>
</tr>
</table>
