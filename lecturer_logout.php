<?php
session_id("session3");
session_start();

/* Super lecturer Logout function */
if(session_destroy())
    {
    unset($_SESSION['lecturerSession']);
    header("Location: lecturer_login.php");
    }
?>