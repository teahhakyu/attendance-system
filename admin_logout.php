<?php
session_start();

/* Super Admin Logout function */
if(session_destroy())
    {
    unset($_SESSION['adminSession']);
    header("Location: admin_login.php");
    }
?>