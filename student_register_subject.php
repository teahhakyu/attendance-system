<?php
session_id("session2");
session_start();

/* Connect database */
include_once 'db_connect.php';

/* Check Admin session */
if(!isset($_SESSION['studentSession']) && $_SESSION['session_type'] != 'student'){
    header("Location: student_login.php");
}

/* Add data function */
if(isset($_POST['submit'])){
    $subject_name = $MySQLi_CON->real_escape_string(trim($_POST['subject']));
    //$subject_lecturer = $MySQLi_CON->real_escape_string(trim($_POST['lecturer']));
    $subject_session = $MySQLi_CON->real_escape_string(trim($_POST['session']));
	$student_id = $_SESSION['username'];
    
    $query = $MySQLi_CON->query("SELECT * FROM student_subject where subject_name = '$subject_name' and subject_session = '$subject_session' and student_id = '$student_id'");
    $itemRow = $query->fetch_array();
    
  
    
    if($itemRow['subject_name'] == $subject_name && $itemRow['subject_session'] == $subject_session && $itemRow['student_id'] == $student_id){
         $msg = '<div class="text-danger">
                    This subject already have lecturer assigned in this session!
                </div>';
    }
    else{
        $query = $MySQLi_CON->query("INSERT INTO student_subject(student_id, subject_name, subject_session) "
				. "VALUES('$student_id','$subject_name','$subject_session')");       
        if($query){
            $msg = '<div class="text-success">
                        Data added successfully!
                    </div>';
        }
        else{
            $msg = '<div class="text-danger">
                        Error! Please Try Again!
                    </div>';
        }
		
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
    <title>Student Page</title>
    
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="student_page.php">INTI INTERNATIONAL COLLEGE PENANG</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Home">
                    <a class="nav-link" href="student_page.php">
                        <i class="fa fa-fw fa-home"></i>
                        <span class="nav-link-text">Home</span>
                    </a>
                </li>
                
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#subject" data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-university"></i>
                        <span class="nav-link-text">Subject</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="subject">
                        <li>
                            <a href="student_register_subject.php">Add Subject</a>
                        </li>
                        <li>
                            <a href="subject_student_list.php">Subject Student</a>
                        </li>
                    </ul>
                </li>
                
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0 mr-lg-2">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="student_page.php">Home</a>
                </li>
                <li class="breadcrumb-item">Subject</li>
                <li class="breadcrumb-item active">Add Subject</li>
            </ol>
            <div class="row">
                <div class="col-12">
                    <h2 style="text-align:left;"><b>Add New Subject</b></h2><br>
                    <ul>
                        <li><p style="text-align:left;">Use the form below add new subject.</p></li>
                        <li><p style="text-align:left;">Required fields indicated with &ast;.</p></li>
                    </ul>
                    <form class="form-horizontal" action="student_register_subject.php" method="post">
                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <?php
                                if(isset($msg)){
                                    echo $msg;
                                }?>
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <label for="session">Session&nbsp;&ast;</label>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                                <select class="form-control" name="session" onChange="showData(this.value)">
                                    <option value="#">Choose the Session</option>
                                    <?php
                                    
                                    /* Connect database */
                                    include 'db_connect.php';
                                    
                                    /* Run query */
                                    $query = $MySQLi_CON->query("SELECT DISTINCT subject_session As subject_session FROM subject");
									
                                    $i = 0;
                                    if($query->num_rows > 0){
                                        while($sessionRow = $query->fetch_assoc()){
                                            echo '<option value="'.$sessionRow['subject_session'].'" name="'.$sessionRow['subject_session'].'">'.$sessionRow['subject_session'].'</option>';
											//echo '<option value="'.$sessionRow['session'].'" name="'.$sessionRow['session'].'">'.$sessionRow['session'].'</option>';
                                        }
                                    }
                                    ?>
                                </select><br>
                            </div>
							
                            <label for="year">Subject&nbsp;&ast;</label>
                            <div class="col-lg-4 col-md-4 col-sm-8 col-xs-12">
                                <select class="form-control" name="subject" id="state-list">
                                    <option value="0" >Choose the Subject</option>
                                    
                                </select><br>

                            </div>
							
                            <div class="form-group">
                                <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-6 col-xs-offset-3">
                                    <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form><!-- ./form-horizontal -->
                </div>
            </div>
        </div><!-- /.container-fluid-->
        
        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <small>Copyright © INTI INTERNATIONAL COLLEGE PENANG</small>
                </div>
            </div>
        </footer>
        
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="student_logout.php">Logout</a>
                    </div>
                </div>
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

<!-- Custom scripts for all pages-->
<script src="js/sb-admin.min.js"></script>

<script type="text/javascript">
    function showData(subject)
    {
        $.ajax({
			type: "POST",
            url: 'subjectList.php?subject=' + subject,
			data: 'id='+subject,
            success: function(data) {
                $("#state-list").html(data);
            }
			
			
        });
		// xmlhttp = new XMLHttpRequest();
		
		// xmlhttp.onreadystatechange = function() {
            // if (this.readyState == 4 && this.status == 200) {
                // document.getElementById("bla").innerHTML = this.responseText;
				
            // }
        // };
        // xmlhttp.open("GET","student_register_subject.php?subject="+ subject,true);
        // xmlhttp.send();
    }
</script>
</html>

