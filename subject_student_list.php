<?php
session_id("session2");
session_start();

/* Check Admin session */
if(!isset($_SESSION['studentSession'])){
    header("Location: student_login.php");
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
    
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
    
    <!-- JQuery Confrimation CSS -->
    <link href="vendor/jqeury-confirm/dist/jquery-confirm.min.css" type="text/css" rel="stylesheet">
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
                <li class="breadcrumb-item active">
                    <a href="student_page.php">Home</a>
                </li>
                <li class="breadcrumb-item">Session</li>
                <li class="breadcrumb-item active">Subject Student</li>
            </ol>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i>&nbsp;Session List
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Student Id</th>
                                    <th>Subject Name</th>
                                    <th>Subject Session</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                /* Connect database */
                                include_once 'db_connect.php';
                                
                                /* Run query */
                                $query = $MySQLi_CON->query("SELECT * FROM student_subject WHERE student_id = '". $_SESSION['username'] ."'");
								
								
                                
                                /* Number row */
                                $i = 1;
                            
                                if($query->num_rows > 0){
                                    while($subjectRow = $query->fetch_assoc()){
                                        echo ' <tr>
                                                <td>'. $i++ .'</td>
												<td>'.$subjectRow['student_id'].'</td>
                                                <td>'.$subjectRow['subject_name'].'</td>
                                                <td>'.$subjectRow['subject_session'].'</td>
                                                <td>
                                                <div class="btn-group">
                                                <a href="edit_student_subject.php?id='.$subjectRow['id'].'" class="btn btn-info" role="button" data-toggle="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-fw fa-pencil"></i> Edit</a>
                                                </div>
                                                <div class="btn-group">
                                                <a href="javascript:delete_id('.$subjectRow['id'].')" class="btn btn-danger" role="button" data-toggle="tooltip" data-placement="top" title="Remove Data"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                                                </div>
                                                </td>
                                                </tr>';
                                            }
                                        }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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

<!-- Page level plugin JavaScript-->
<script src="vendor/datatables/jquery.dataTables.js"></script>

<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->

<script src="js/sb-admin.min.js"></script>
<!-- Custom scripts for this page-->

<script src="js/sb-admin-datatables.min.js"></script>

<!-- JQuery Confirmation -->
<script src="vendor/jqeury-confirm/dist/jquery-confirm.min.js"></script>

<!-- Delete data confirmation -->
    <script type="text/javascript">
        function delete_id(id){
            $.confirm({
                theme: 'material',
                type: 'red',
                animation: 'scaleY',
                closeAnimation: 'scaleY',
                icon: 'fa fa-warning',
                title: 'Delete Data',
                backgroundDismiss: true,
                content: 'Confirm remove this data?',
                buttons: {
                    confirm: function () {
                        window.location.href='delete_student_subject.php?del='+id;
                    },
                    cancel: function () {
                    }
                }
            });
        }
    </script>
</html>

