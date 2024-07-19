<?php 

$connection = mysqli_connect('localhost', 'root', '', 'clinics');
$query = "DELETE FROM `stomatologiya` ";
$delete_elements = mysqli_query($connection, $query);

if (!$delete_elements) {
    die("QUERY FAILED asdasdas." . mysqli_error($connection));
}