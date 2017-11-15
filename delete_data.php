<?php
/* Connect database */
include_once 'db_connect.php';

/* Get the delete button based on ID */
if(isset($_GET['del'])){
    $id = $_GET['del'];
    
    /* Delete data based on ID selected */
    $query ="DELETE FROM subject WHERE id='$id'";
    
    if($MySQLi_CON->query($query)){
        header("Location: subject_lecturer_list.php");
    }
    else{
        //Error
    }
    $MySQLi_CON->close();
}
?>