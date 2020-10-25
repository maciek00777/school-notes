<?php
$title = "Statystyki firmy";
include('../templates/header.php');
include('../templates/menu.php');

if($_SESSION['is_admin'])require( '../admin-functions.php' );
else header("Location: ../order/display.php");
//wyrzuć jeśli nieautoryzowany dostęp
?>

<?php
if(isset($_GET['delete']))
{
    deleteOrder($_GET['delete'],$_SESSION['user'],true);
}
?>


<?php if( $orders = selectOrders($_SESSION['user'],true)): //true oznacza że zapytanie pochodzi z panelu admninistratora - ma pokazać wszystkie oferty ?>
    <p><h4>Podsumowanie :</h4> 
    <br> Rezerwacji : <?php echo sizeof($orders)?>
    <br> Przychód: 
        <?php 
        $sum=0;
        foreach ( $orders as $order ){
            $sum+=$order['price'];
        }
        echo $sum;
        ?>
    </p>
    <br><br>
    <h4>Rezerwacje:</h4>
    <table>
        <tr>
            <th>Użytkownik</th>
            <th>Data</th>
            <th>Odlot</th>
            <th>Przylot</th>
            <th>Cena</th>
        </tr>
        <tr>


            <?php foreach ( $orders as $order ) : ?>
                <tr>
                    <td><?php echo $order['username'] ?></td>
                    <td><?php echo $order['fly_date'] ?></td>
                    <td><?php echo $order['city1'] ?></td>
                    <td><?php echo $order['city2'] ?></td>
                    <td><?php echo $order['price'] ?></td>
                    <td><a href="?delete=<?php echo $order['id_order']?>" style="color:red">Usuń</a><td>
                </tr>
            <?php endforeach; ?>
        </tr>
    </table>
    <?php endif; ?>


<?php
    include('../templates/footer.php');
?>