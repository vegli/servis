
<?php

    include 'database.php';

    $sql = "SELECT * FROM automobili";
    $result = mysqli_query($mysqli, $sql);
    if(mysqli_num_rows($result) > 0){
        echo '</br><table>
        <tr>
            <th><a class="column_sort2" id="id" data-order="desc" href="#">ID</a></th>
            <th><a class="column_sort2" id="marka" data-order="desc" href="#">Marka</a></th>
            <th><a class="column_sort2" id="model" data-order="desc" href="#">Model</a></th>
            <th><a class="column_sort2" id="datum" data-order="desc" href="#">Datum</a></th>
            <th><a class="column_sort2" id="servis_id" data-order="desc" href="#">ID servisa</a></th>
        </tr>';
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['marka'] . "</td>";
            echo "<td>" . $row['model'] . "</td>";
            echo "<td>" . $row['datum'] . "</td>";
            echo "<td>" . $row['servis_id'] . "</td>";
            echo "</tr>";
        }
        echo '</table></br>';
    }else{
        echo("Nema rezultata");
    }
?>