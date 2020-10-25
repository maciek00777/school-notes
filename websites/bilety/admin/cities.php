<?php
$title = "Edycja dostępnych miast";
include('../templates/header.php');
include('../templates/menu.php');

if($_SESSION['is_admin'])require( '../admin-functions.php' );
else header("Location: ../order/display.php");
//wyrzuć jeśli nieautoryzowany dostęp
?>


<?php
if(isset($_GET['delete']))
    deleteCity($_GET['delete']);
else if($_SERVER['REQUEST_METHOD']=="POST")
    if(empty($_POST['city_name']) || empty($_POST['latitude']) || empty($_POST['longitude']))
        $error = "Wprowadź wszystkie dane";
    else newCity($_POST['city_name'],$_POST['latitude'],$_POST['longitude']);
?>


<h2>Dostępne lotniska</h2>
<?php if( $cities = selectCities() ) : ?>
    <table>
        <tr>
            <th>Miasto</th>
            <th>Szerokość geogr</th>
            <th>Długość geogr</th>
            <th>Działanie<td>
        </tr>

        <?php foreach ( $cities as $city ) : ?>
            <tr>
                <th><?php echo $city['city_name'] ?></th>
                <td><?php echo $city['latitude'] ?></td>
                <td><?php echo $city['longitude'] ?></td>
                <td><a href="?delete=<?php echo $city['id_city']?>" style="color:red">Usuń</a><td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <form method="POST">
                <td><input type="text" name="city_name"/></td>
                <td><input type="text" name="latitude"/></td>
                <td><input type="text" name="longitude"/></td>
                <td><input type="submit" value="Dodaj"><td>
            </form>          
        </tr>
    </table>
<?php endif; ?>

<?php
    include('../templates/footer.php');
?>