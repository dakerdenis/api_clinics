<?php
$connection = mysqli_connect('localhost', 'root', 'plo234hshjnjsaf23', 'clinics');
if(isset($_POST['create_clinic'])){
    $clinic_name = $_POST['clinic_name'];
    $clinic_adress = $_POST['clinic_adress'];
    $clinic_phone = $_POST['clinic_phone'];

    $clinic_location1 = $_POST['clinic_location1'];
    $clinic_location2 = $_POST['clinic_location2'];


    $query = "INSERT INTO `clinics` (`name`, `adress`, `phone`, `location_1` ,`location_2`) "; 
    $query .= "VALUES ('{$clinic_name}', '{$clinic_adress}', '{$clinic_phone}', '{$clinic_location1}','{$clinic_location2}'); ";
    
    $create__clinic = mysqli_query($connection, $query); 

    if(!$create__clinic){
        die("QUERY FAILED ." . mysqli_error($connection));
    }


    header("Location: ../admin.php?page=data");
}

?>



<div class="add_container">
    <form class="add__element__form" action="./include/add_clinic_block.php" method="POST" enctype="multipart/form-data" >
        <div class="add__element__container">
            <div class="add__element__block">
                <div class="add__element__desc">
                   Clinic's name
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_name" placeholder="add clinic's name">
                </div>
            </div>
            <div class="add__element__block">
                <div class="add__element__desc">
                   Clinic's adress
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_adress" placeholder="add clinic's adress">
                </div>
            </div>
            <div class="add__element__block">
                <div class="add__element__desc">
                   Clinic's phone
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_phone" placeholder="add clinic's phone">
                </div>
            </div>

            <div class="add__element__block">
                <div class="add__element__desc">
                   Clinic's location X
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_location1" placeholder="add clinic's location X">
                </div>
            </div>
            <div class="add__element__block">
                <div class="add__element__desc">
                   Clinic's location Y
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_location2" placeholder="add clinic's location Y">
                </div>
            </div>
            <div class="add__element__button">
                <input type="submit" name="create_clinic" value="Add Clinic">
            </div>
        </div>
    </form>
</div>