<?php
$title = "Twoje rezerwacje";
include('../templates/header.php');
include('../templates/menu.php');
include('../functions.php');
?>

<?php
if(isset($_GET['delete']))
    deleteOrder($_GET['delete'],$_SESSION['user']);
?>

<h2>Twoje rezerwacje : </h2>
<?php if( $orders = selectOrders($_SESSION['user']) ){ ?>
    <table>
        <tr>
            <th>Data</th>
            <th>Odlot</th>
            <th>Przylot</th>
            <th>Cena</th>
        </tr>
        <tr>


            <?php foreach ( $orders as $order ) : ?>
                <tr>
                    <td><?php echo $order['fly_date'] ?></td>
                    <td><?php echo $order['city1'] ?></td>
                    <td><?php echo $order['city2'] ?></td>
                    <td><?php echo $order['price'] ?></td><td>zł</td>
                    <td><a href="?delete=<?php echo $order['id_order']?>" style="color:red">Odwołaj</a><td>
                    <!-- wysyłane w get, ale walidowane poprzez zapytanie - użytkownik x nie może usunąć zamówienia y -->
                </tr>
            <?php endforeach; ?>
        </tr>
    </table>
    <?php }
    else $error = 'Na razie brak rezerwacji. <a href="new.php"> Złóż nową </a>';
    ?>


<?php
    include('../templates/footer.php');
?>