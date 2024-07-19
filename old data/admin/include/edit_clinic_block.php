<?php
    if(isset($_GET['id'])){
        $clinic_id = $_GET['id'];

        $connection = mysqli_connect('localhost', 'root', 'plo234hshjnjsaf23', 'clinics');
        $query = "SELECT * FROM `clinics`  WHERE `id` = $clinic_id;";
        $edited_item = mysqli_query($connection, $query);


        if (!$edited_item) {
            die("QUERY FAILED!!!" . mysqli_error($connection));
        }
        

        while ($row  = mysqli_fetch_assoc($edited_item)) {
            $item_id = $row['id'];
            $name = $row['name'];
            $adress = $row['adress'];
            $phone = $row['phone'];
            $location_1 = $row['location_1'];
            $location_2 = $row['location_2'];
        }

    }

?>

<div class="add_container">
    <form class="add__element__form" action="./include/edit_clinic.php" method="POST" enctype="multipart/form-data" >
       Change Clinic
    <div class="add__element__container">
            <div class="add__element__block">
                <div class="add__element__desc">
                   Change Clinic's name
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_name" placeholder="add clinic's name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="add__element__block">
                <div class="add__element__desc">
                Change Clinic's adress
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_adress" placeholder="add clinic's adress" value="<?php echo $adress; ?>">
                </div>
            </div>
            <div class="add__element__block">
                <div class="add__element__desc">
                Change Clinic's phone
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_phone" placeholder="add clinic's phone" value="<?php echo $phone; ?>">
                </div>
            </div>

            <div class="add__element__block">
                <div class="add__element__desc">
                Change Clinic's location X
                </div>
                <div class="add__element__input">
                    <input type="text" name="location_1" placeholder="add clinic's location X" value="<?php echo $location_1; ?>">
                </div>
            </div>
            <div class="add__element__block">
                <div class="add__element__desc">
                Change Clinic's location Y
                </div>
                <div class="add__element__input">
                    <input type="text" name="location_2" placeholder="add clinic's location Y" value="<?php echo $location_2; ?>">
                </div>
            </div>
            <input type="text" name="clinic_id" style="opacity: 0;" value="<?php echo $item_id; ?>">
            <div class="add__element__button">
                <input type="submit" name="edit_item" value="Update Clinic">
            </div>
        </div>
        <div class="succes__block">
            
            <?php 
                if(isset($_GET['success'])){
                    if($_GET['success'] == true){
                        echo "<p>Clinics changed !</p>";
                    }
                }
            ?>
        </div>
    </form>
    
</div>