
<?php

    include 'database.php';

    $sql = "SELECT * FROM servisi";
    $result = mysqli_query($mysqli, $sql);
    if(mysqli_num_rows($result) > 0){
        echo '</br><table>
        <tr>
            <th><a class="column_sort" id="id" data-order="desc" href="#">ID</a></th>
            <th><a class="column_sort" id="naziv" data-order="desc" href="#">Naziv</a></th>
            <th><a class="column_sort" id="lokacija" data-order="desc" href="#">Lokacija</a></th>
        </tr>';
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['naziv'] . "</td>";
            echo "<td>" . $row['lokacija'] . "</td>";
            echo "</tr>";
        }
        echo '</table></br>';
    }else{
        echo("Nema rezultata");
    }
?>