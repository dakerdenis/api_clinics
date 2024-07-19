<?php
    if(isset($_GET['id'])){
        $aptek = $_GET['id'];

        $connection = mysqli_connect('localhost', 'root', 'plo234hshjnjsaf23', 'clinics');
        $query = "SELECT * FROM `apteks`  WHERE `id` = $aptek;";
        $edited_item = mysqli_query($connection, $query);


        if (!$edited_item) {
            die("QUERY FAILED!!!" . mysqli_error($connection));
        }


        while ($row  = mysqli_fetch_assoc($edited_item)) {
            $item_id = $row['id'];
            $name = $row['name'];
            $adress = $row['adress'];
            $phone = $row['phone'];
            $location = $row['location'];
        }

    }

?>

<div class="add_container">
    <form class="add__element__form" action="./include/edit_aptek.php" method="POST" enctype="multipart/form-data" >
       Change Aptek
    <div class="add__element__container">
            <div class="add__element__block">
                <div class="add__element__desc">
                   Change Aptek's name
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_name" placeholder="edit aptek's  name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="add__element__block">
                <div class="add__element__desc">
                Change Aptek's adress
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_adress" placeholder="edit aptek's  adress" value="<?php echo $adress; ?>">
                </div>
            </div>
            <div class="add__element__block">
                <div class="add__element__desc">
                Change Aptek's phone
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_phone" placeholder="edit aptek's  phone" value="<?php echo $phone; ?>">
                </div>
            </div>

            <div class="add__element__block">
                <div class="add__element__desc">
                Change Aptek's location X
                </div>
                <div class="add__element__input">
                    <input type="text" name="clinic_location" placeholder="edit aptek's location" value="<?php echo $location; ?>">
                </div>
            </div>
            <input type="text" name="clinic_id" style="opacity: 0;" value="<?php echo $item_id; ?>">
            <div class="add__element__button">
                <input type="submit" name="edit_item" value="Update Aptek">
            </div>
        </div>
        <div class="succes__block">
            
            <?php 
                if(isset($_GET['success'])){
                    if($_GET['success'] == true){
                        echo "<p>Aptek changed !</p>";
                    }
                }
            ?>
        </div>
    </form>
    
</div>