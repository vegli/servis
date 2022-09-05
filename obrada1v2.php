
<?php

include 'database.php';
$output = '';
$order = $_POST["order"];
if($order == 'desc'){
    $order = 'asc';
} else{
    $order = 'desc';
}

$sql = "SELECT * FROM servisi ORDER BY ".$_POST["column_name"]." ".$_POST["order"];
$result = mysqli_query($mysqli, $sql);
$output .= '
</br><table>
    <tr>
        <th><a class="column_sort" id="id" data-order="'.$order.'" href="#">ID</a></th>
        <th><a class="column_sort" id="naziv" data-order="'.$order.'" href="#">Naziv</a></th>
        <th><a class="column_sort" id="lokacija" data-order="'.$order.'" href="#">Lokacija</a></th>
    </tr>
    ';
    while($row = mysqli_fetch_assoc($result)){
        $output .= '
        <tr>
        <td>' . $row['id'] . '</td>
        <td>' . $row['naziv'] . '</td>
        <td>' . $row['lokacija'] . '</td>
        </tr>
        ';
    }
    $output .= '</table></br>';
    echo $output;
?>