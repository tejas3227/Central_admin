<?php
include('config.php');
error_reporting(0);

if (!isset($_SESSION['signin'])) {
    header('location:login.php');
}
$ID = $_SESSION['signin'];
$getData = mysqli_query($conn, "select * from `admin` where `admin_id`='$ID'");
$row = mysqli_fetch_assoc($getData);

if (
    isset($_GET['dept']) && !empty($_GET['dept'])
    && isset($_GET['AY']) && !empty($_GET['AY'])
) {
    // Store the selected academic year and department values in variables
    $dept = $_GET['dept'];
    $AY = $_GET['AY'];
    $sql = "SELECT * FROM teachinfo WHERE `Department` = '$dept'";
    $result = mysqli_query($conn, $sql);
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
    <link rel="stylesheet" href="view_stud.css">
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <style>
        .table-responsive {
            max-height: 530px;
            /* adjust the height as needed */
            overflow-y: auto;
        }

        #table thead th {
            position: sticky;
            top: 0;
            z-index: 1;
            background-color: #fff;
        }
    </style>
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
                            <a class="dropdown-item" href="logout.php"><i
                                    class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span
                                    class="align-middle">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>

        </header>



        <div class="hori-overlay"></div>

        <div class="card-header justify-content-center d-flex align-items-center">
            <form method="GET" class="text-center">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search TID" name="searchInput"
                        value="<?php echo htmlspecialchars($_GET['searchInput'] ?? '', ENT_QUOTES); ?>">
                    <input type="hidden" name="dept" value="<?php echo $_GET['dept']; ?>">
                    <input type="hidden" name="AY" value="<?php echo $_GET['AY']; ?>">
                    <?php
                    $searchInput = $_GET['searchInput'] ?? '';
                    $dept = $_GET['dept'];
                    $AY = $_GET['AY'];

                    if (!empty($searchInput)) {
                        $sql = "SELECT * FROM teachinfo WHERE TID = '$searchInput'";
                    } else {
                        $sql = "SELECT * FROM teachinfo WHERE `Department` = '$dept'";
                    }

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // display the table with the retrieved data
                    } else {
                        echo "No results found.";
                        header('location:view_teacher.php');
                    }
                    ?>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header justify-content-between d-flex align-items-center">
                                    <h4 class="card-title">Teachers</h4>
                                </div><!-- end card header -->
                                <div class="card-content table-responsive">
                                    <table class="table table-bordered border-Dark" id="table">
                                        <thead class="text-primary">
                                            <tr>
                                                <th>TID</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Mobile No</th>
                                                <th>Alternate Mobile No</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($show = $result->fetch_assoc()) {
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $show['tid']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $show['tName']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $show['Department']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $show['Mobile_Number']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $show['Alt_Mobile_Number']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $show['Email']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $show['Address']; ?>
                                                    </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                            <a href="teacher_excel.php?dept=<?php echo $_GET['dept']; ?>">Download Excel
                                                file</a>


                                        </tbody>
                                    </table>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

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