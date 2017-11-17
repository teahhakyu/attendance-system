<?php
session_id("session2");
session_start();

/* Super Admin Logout function */
if(session_destroy())
    {
    unset($_SESSION['studentSession']);
    header("Location: student_login.php");
    }
?>