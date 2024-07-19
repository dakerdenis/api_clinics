<?php
$connection = mysqli_connect('localhost', 'root', 'plo234hshjnjsaf23', 'clinics');


if(isset($_GET['id'])){
    $item_id = $_GET['id'];
    $query_delete = "DELETE FROM `aptek` WHERE id = {$item_id}";

    $delete_category = mysqli_query($connection, $query_delete);
    header("Location: ../admin.php?page=data");
}

?>