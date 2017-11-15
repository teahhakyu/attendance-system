<?php
session_start();

/* Connect database */
include_once 'db_connect.php';

if(isset($_SESSION['adminSession'])!=""){
    header("Location: admin_page.php");
    exit;
}

if(isset($_POST['submit'])){
    $admin_id = $MySQLi_CON->real_escape_string(trim($_POST['admin_id']));
    $admin_password = $MySQLi_CON->real_escape_string(trim($_POST['admin_password']));
    
    $query = $MySQLi_CON->query("SELECT * FROM admin WHERE admin_id='$admin_id'");
    $adminRow = $query->fetch_array();
    
    if($admin_id == $adminRow['admin_id'] && $admin_password == $adminRow['admin_password']){
        $_SESSION['adminSession'] = $adminRow['id'];
        header("Location: admin_page.php");
        
    }
    else if($admin_id == $adminRow['admin_id'] && $admin_password != $adminRow['admin_password']){
        $msg = 'Entered wrong Password!';
    }
    else if($admin_id != $adminRow['admin_id'] ){
        $msg = 'Entered wrong Admin ID!';
    }
    else{
        $msg = 'Error! Please try again!';
    }
    $MySQLi_CON->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Login</title>
    
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="admin_login.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Admin ID</label>
                        <input class="form-control" id="exampleInputEmail1" name="admin_id" type="text" placeholder="Enter ID">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input class="form-control" id="exampleInputPassword1" name="admin_password" type="password" placeholder="Password">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button><br>
                    <div class="text-center text-danger">
                        <?php
                        if(isset($msg)){
                            echo $msg;
                        }?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</html>