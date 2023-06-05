<?php
include('config.php');
error_reporting(0);

if (!isset($_SESSION['signin'])) {
    header('location:login.php');
}
$ID = $_SESSION['signin'];
$getData = mysqli_query($conn, "select * from `admin` where `admin_id`='$ID'");
$row = mysqli_fetch_assoc($getData);

if (isset($_GET['AY']) && !empty($_GET['AY'])) {
    // Store the selected academic year and department values in variables
    $AY = $_GET['AY'];
}

if (isset($_POST['submit'])) {
    $dep_admin_id = $_REQUEST['dep_admin_id'];
    $name = $_REQUEST['name'];
    $password = $_REQUEST['password'];

    $query = mysqli_query($conn, "INSERT INTO `dep_admin` (dep_admin_id,name,password)
      VALUES ('$dep_admin_id','$name','$password')");

if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Departmental Admin Added Successfully....');
    window.location.href = 'dep_admin_details.php?AY=" . $_GET['AY'] . "';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}
}

?>


<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Jassa" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>


<body data-layout="horizontal" data-topbar="dark">

    <!-- <body data-layout="horizontal"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a class="logo logo-dark">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.svg" alt="" height="26">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-sm.svg" alt="" height="26"> <span class="logo-txt">Central
                                    Admin</span>
                            </span>
                        </a>

                        <a class="logo logo-light">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.svg" alt="" height="26">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-sm.svg" alt="" height="26"> <span class="logo-txt">Central
                                    Admin</span>
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item"
                        data-bs-toggle="collapse" id="horimenu-btn" data-bs-target="#topnav-menu-content">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <div class="topnav">
                        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                            <div class="collapse navbar-collapse" id="topnav-menu-content">
                                
                            </div>
                        </nav>
                    </div>

                </div>

                <div class="d-flex">

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item user text-start d-flex align-items-center"
                            id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="rounded-circle header-profile-user"
                                src="assets/images/users/<?php echo $row['img']; ?>" alt="Header Avatar">
                            <span class="ms-2 d-none d-xl-inline-block user-item-desc">
                                <span class="user-name">
                                    <?php echo $row['name']; ?><i class="mdi mdi-chevron-down"></i>
                                </span>
                            </span>
                           </button>
                        <div class="dropdown-menu dropdown-menu-end pt-0">
                            <a class="dropdown-item" href="logout.php"><i
                                    class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span
                                    class="align-middle">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>

        </header>



        <div class="hori-overlay"></div>



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <div class="col-9">
                        <div class="card">
                            <div class="card-header justify-content-between d-flex align-items-center">
                                <h4 class="card-title">Add Departmental Admin</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <form action="#" method="post">
                                    
                                    <div class="row mb-4">
                                        <label for="dep_admin_id" class="col-sm-3 col-form-label">Departmental ID</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="dep_admin_id" class="form-control" id="dep_admin_id"
                                                placeholder="Enter Departmental Admin ID">
                                        </div>
                                    </div><!-- end row -->

                                    <div class="row mb-4">
                                        <label for="name" class="col-sm-3 col-form-label">Department Name</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Enter Department Name">
                                        </div>
                                    </div><!-- end row -->

                                    <div class="row mb-4">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="password" class="form-control" id="password"
                                                placeholder="Enter Password" value="<?php echo "kitcoek" ?>" readonly>
                                        </div>
                                    </div><!-- end row -->



                                    <div class="row justify-content-end">
                                        <div class="col-sm-9">

                                            <div>
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary w-md">Submit</button>
                                            </div>
                                        </div><!-- end col -->
                                    </div><!-- end row -->
                                </form><!-- end form -->
                            </div>
                        </div><!-- end card -->
                    </div>





                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> &copy; Student Mentoring.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/pricing.init.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>