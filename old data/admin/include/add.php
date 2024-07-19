
<?php
switch ($_GET['type']) {
    case 'clinic':
        include './include/add_clinic_block.php';
        break;
    case 'aptek':
        include './include/add_clinic_block.php';
        break;
    case 'stomatologiya':
        include './include/add_aptek_block.php';
        break;
    case 'optiks':
        include './include/add_optiks_block.php';
        break;
    default:
        include './include/add_clinic_block.php';
        break;
}

?>

