<?php
if(isset($_POST['edit_item'])){
    $connection = mysqli_connect('localhost', 'root', 'plo234hshjnjsaf23', 'clinics');
    $clinic_id = $_POST['clinic_id'];
    $clinic_name = $_POST['clinic_name'];
    $clinic_adress = $_POST['clinic_adress'];
    $clinic_phone = $_POST['clinic_phone'];
    $location_1 = $_POST['location_1'];
    $location_2 = $_POST['location_2'];



       $query = "UPDATE `clinics` SET ";
       $query .= "`name`='{$clinic_name}', ";
   
       $query .= "`adress`='{$clinic_adress}', ";
       $query .= "`phone`='{$clinic_phone}', ";

       $query .= "`location_1`='{$location_1}', ";
       $query .= "`location_2`='{$location_2}' ";

   
       $query .= "WHERE `id` = $clinic_id ";

       echo $query;

       $edit_item = mysqli_query($connection, $query);

       if(!$edit_item){
           die("QUERY FAILED ." . mysqli_error($connection) );
       }
       sleep(2);
       header("Location: ../admin.php?page=edit&type=clinic&id=$clinic_id&success=true");
}
?>