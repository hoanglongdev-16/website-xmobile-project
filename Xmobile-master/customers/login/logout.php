<?php
    session_start();
    unset($_SESSION['customer_id']);
    unset($_SESSION['customer_email']);
    header("Location: ../index.php");
?>