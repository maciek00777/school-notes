
<!-- GET - możliwość udostępnienia komuś zamówienia --> 
<form method="GET" action="new.php">

    <!-- Pobranie listy miast z bazy -->
    <?php if( $cities = selectCities() ) : ?>
    <h2>Złóż rezerwacje</h2>
    <table>
        <tr>
            <td> Odlot z: </td>
            <td>
            <select name="miasto1">
                <?php foreach ( $cities as $city ) : ?>
                    <option value="<?php echo $city['id_city']; ?>"><?php echo $city['city_name']; ?></option>
                <?php endforeach; ?>
            </select>
            </td>
        </tr>
        <tr>
            <td> Przylot do: </td>
            <td> <select name="miasto2">
                <?php foreach ( $cities as $city ) : ?>
                    <option value="<?php echo $city['id_city']; ?>"><?php echo $city['city_name']; ?></option>
                <?php endforeach; ?>
            </select> </td>
        </tr>
        <tr>
            <td> Data odlotu: </td>
            <td><input type="date" name="fly_date"/> </td>
            <!-- brakuje walidacji daty (czy wybrano przyszłą datę i czy wybrano jakąkolwiek), jednak czas ucieka nieubłaganie -->
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Znajdź połączenie"/></td>
        </tr>
    </table>
    <?php endif; ?>
    Uwaga, rezerwacje na mniej niż 6 miesięcy, będą wymagały dodatkowej opłaty, zależnej od terminu wylotu (im wcześniej tym większa)
</form>