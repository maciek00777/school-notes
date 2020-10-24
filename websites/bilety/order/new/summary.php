<style>
    th,td{
        width: 100px;
        text-align: center;
    }
</style>

<h2>Twoja rezerwacja:</h2>
<form method="POST" action="new.php">
<table>
<tr>
    <th>Data</th>
    <th>Odlot</th>
    <th>Przylot</th>
    <th>Cena</th>
</tr>
<tr>
    <td name="date"><?php echo $_GET['fly_date'] ?></td>
    <td name="miasto1"> <!-- zamiana id na nazwe -->
        <?php
        echo (( $db -> query("SELECT city_name FROM cities WHERE id_city =".$_GET['miasto1']) )-> fetch_assoc() )['city_name']; 
        ?>
    </td>
    <td name="miasto2">
        <?php
        echo (( $db -> query("SELECT city_name FROM cities WHERE id_city =".$_GET['miasto2']) )-> fetch_assoc() )['city_name']; 
        ?>
    </td>
    <td name="prize">
        <?php
            echo calculatePrice(
                $_GET['miasto1'],
                $_GET['miasto2'],
                2,                  //$priceKM,
                $_GET['fly_date'],
                getdate(),          //$orderDate
                array('modifier'=>10,'feesFreeDate'=>180,'interval'=>40) // $dateModifier
                )
        ?>
        zł
    </td>
</tr>
<tr>
    <td colspan="4"><input type="submit" value="Potwierdź"/></td>
</tr>
</table>

</form>

