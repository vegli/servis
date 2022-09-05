
<?php

include 'database.php';
$output = '';
$order = $_POST["order"];
if($order == 'desc'){
    $order = 'asc';
} else{
    $order = 'desc';
}

$sql = "SELECT * FROM automobili ORDER BY ".$_POST["column_name"]." ".$_POST["order"];
$result2 = mysqli_query($mysqli, $sql);
$output .= '
</br><table>
    <tr>
        <th><a class="column_sort2" id="id" data-order="'.$order.'" href="#">ID</a></th>
        <th><a class="column_sort2" id="marka" data-order="'.$order.'" href="#">Naziv</a></th>
        <th><a class="column_sort2" id="model" data-order="'.$order.'" href="#">Lokacija</a></th>
        <th><a class="column_sort2" id="datum" data-order="'.$order.'" href="#">Datum</a></th>
        <th><a class="column_sort2" id="servis_id" data-order="'.$order.'" href="#">ID servisa</a></th>
    </tr>
    ';
    while($row = mysqli_fetch_assoc($result2)){
        $output .= '
        <tr>
        <td>' . $row['id'] . '</td>
        <td>' . $row['marka'] . '</td>
        <td>' . $row['model'] . '</td>
        <td>' . $row['datum'] . '</td>
        <td>' . $row['servis_id'] . '</td>
        </tr>
        ';
    }
    $output .= '</table></br>';
    echo $output;
?>