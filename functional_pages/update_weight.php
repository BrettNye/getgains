<?php
    require_once('../user/userDAO.php');
    session_start();

    $weight_in_oz = ($_POST['pounds']*16) + $_POST['ounces'];

    $userDAO = new userDAO;
    //Updates user Weight AND Creates User Weight Log Entry
    $userDAO->UpdateUserWeight($_SESSION['user_id'], $weight_in_oz);
    header('Location: ../user_stats.php');
?>