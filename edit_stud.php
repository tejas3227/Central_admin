<?php
include('config.php');
error_reporting(0);
if (!isset($_SESSION['signin'])) {
    header('location:login.php');
}
$ID = $_SESSION['signin'];
$getData = mysqli_query($conn, "select * from `admin` where `admin_id`='$ID'");
$row = mysqli_fetch_assoc($getData);

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
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link dropdown-toggle arrow-none"
                                            href="year_select.php?dept=<?php echo $_GET['dept']; ?>&AY=<?php echo $_GET['AY']; ?>"
                                            id="topnav-dashboard" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-arrow-back"></i>
                                            <span data-key="t-dashboard">Go Back</span>
                                        </a>
                                    </li>

                                </ul>
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
                            <a class="dropdown-item" href="auth-signout-cover.html"><i
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



                    <!-- end row -->

                    <div class="row justify-content-center">
                        <div class="col-lg-12">

                            <div class="row">

                                <div class="col-xl-4">
                                    <div class="card pricing-box">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <h5 class="mb-1 font-size-20">Bulk Upload</h5>

                                                <p class="text-muted">Bluk Upload Data to Database</p>
                                            </div>
                                            <form method="get" action="bulk_upload_stud.php">
                                                <input type="hidden" name="dept"
                                                    value="<?php echo urlencode(explode('&', $_GET['dept'])[0]); ?>">
                                                <input type="hidden" name="AY" value="<?php echo $_GET['AY']; ?>">


                                                <select class="form-control" id="year" name="year"
                                                    onchange="this.form.submit();">
                                                    <option value="">Select Year</option>
                                                    <option value="First Year">First Year</option>
                                                    <option value="Second Year">Second Year</option>
                                                    <option value="Third Year">Third Year</option>
                                                    <option value="Fourth Year">Fourth Year</option>
                                                </select>
                                            </form>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-4">
                                    <div class="card pricing-box">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <h5 class="mb-1 font-size-20">Add Student</h5>

                                                <p class="text-muted">Add Student Data to Database</p>
                                            </div>
                                            <div class="mt-4">
                                                <a href="stud_add.php?dept=<?php echo $_GET['dept']; ?>&AY=<?php echo $_GET['AY']; ?>"
                                                    class="btn btn-primary w-100">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-xl-4">
                                    <div class="card pricing-box">
                                        <div class="card-body p-4">
                                            <div class="text-center">
                                                <h5 class="mb-1 font-size-20">Remove Students</h5>

                                                <p class="text-muted">Remove students from the database</p>
                                            </div>

                                            <div class="mt-4">
                                                <a href="remove_stud.php?dept=<?php echo $_GET['dept']; ?>&AY=<?php echo $_GET['AY']; ?>"
                                                    class="btn btn-primary w-100">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                    </div>
                    <!-- end row -->


                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            <style>
                select#academic_year {
                    background-color: #6A5ACD;
                    border: none;
                    border-radius: 5px;
                    padding: 10px;
                    width: 100%;
                    font-size: 16px;
                    color: white;
                }

                /* Change the color of the select dropdown's options */
                select#academic_year option {
                    background-color: #F5F5F5;
                    color: #333;
                }
            </style>

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