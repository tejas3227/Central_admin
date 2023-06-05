<?php
include('config.php');
error_reporting(0);

if (!isset($_SESSION['signin'])) {
    header('location:login.php');
}
$ID = $_SESSION['signin'];
$getData = mysqli_query($conn, "select * from `admin` where `admin_id`='$ID'");
$row = mysqli_fetch_assoc($getData);
// Check if the academic_year parameter is set and not empty
if (
    isset($_GET['dept']) && !empty($_GET['dept'])
    && isset($_GET['academic_year']) && !empty($_GET['academic_year'])
) {
    // Store the selected academic year and department values in variables
    $dept = $_GET['dept'];
    $academic_year = $_GET['academic_year'];

    echo "$dept";
    echo "$academic_year";
    // Generate a query to retrieve the records based on the selected academic year and department
    $query = "SELECT * FROM studinfo WHERE `Department` = '$dept' AND `Class` = '$academic_year'";
    $result1 = mysqli_query($conn, $query);
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
                                <img src="assets/images/logo-sm.svg" alt="" height="26"> <span class="logo-txt">Student
                                    Mentoring</span>
                            </span>
                        </a>

                        <a class="logo logo-light">
                            <span class="logo-sm">
                                <img src="assets/images/logo-sm.svg" alt="" height="26">
                            </span>
                            <span class="logo-lg">
                                <img src="assets/images/logo-sm.svg" alt="" height="26"> <span class="logo-txt">Student
                                    Mentoring</span>
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
                                            href="view_stud.php?dept=<?php echo $_GET['dept']; ?>&academic_year=<?php echo $_GET['academic_year']; ?>"
                                            id="topnav-dashboard" role="button" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-user"></i>
                                            <span data-key="t-dashboard">View Student</span>
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


        <div class="card-header justify-content-between d-flex align-items-center">
            <form method="GET"
                action="searched.php?dept=<?php echo $_GET['dept']; ?>&academic_year=<?php echo $_GET['academic_year']; ?>">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search PRN" name="searchInput"
                        value="<?php echo htmlspecialchars($_GET['searchInput'] ?? '', ENT_QUOTES); ?>">
                    <?php
                    $searchInput = $_GET['searchInput'] ?? '';
                    $dept = $_GET['dept'];
                    $academic_year = $_GET['academic_year'];

                    if (!empty($searchInput)) {
                        $sql = "SELECT * FROM studinfo WHERE PRN = '$searchInput'";
                    } else {
                        $sql = "SELECT * FROM studinfo WHERE `Department` = '$dept' AND `Class` = '$academic_year'";
                    }

                    $result1 = $conn->query($sql);

                    if ($result1->num_rows > 0) {
                        // display the table with the retrieved data
                    } else {
                        echo "No results found.";
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
                                    <h4 class="card-title">All Students</h4>
                                </div><!-- end card header -->
                                <div class="card-content table-responsive">
                                    <table class="table table-bordered border-Dark" id="table">
                                        <thead class="text-primary">
                                            <tr>
                                                <th>PRN</th>
                                                <th>Name</th>
                                                <th>Department</th>
                                                <th>Class</th>
                                                <th>Division</th>
                                                <th>Roll No</th>
                                                <th>Mobile No</th>
                                                <th>Alternate Mobile No</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($show = $result1->fetch_assoc()) {
                                                ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $show['PRN']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $show['Name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $show['Department']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $show['Class']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $show['Division']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $show['Roll_Number']; ?>
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

                                            <a
                                                href="excel_stud.php?dept=<?php echo $dept ?>&academic_year=<?php echo $academic_year ?>">Download
                                                Excel File</a>


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

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center p-3">

                <h5 class="m-0 me-2">Theme Customizer</h5>

                <a href="javascript:void(0);" class="right-bar-toggle-close ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>

            <!-- Settings -->
            <hr class="m-0" />

            <div class="p-4">
                <h6 class="mb-3">Layout</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout" id="layout-vertical" value="vertical">
                    <label class="form-check-label" for="layout-vertical">Vertical</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout" id="layout-horizontal"
                        value="horizontal">
                    <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                </div>

                <h6 class="mt-4 mb-3">Layout Mode</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-light"
                        value="light">
                    <label class="form-check-label" for="layout-mode-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-dark" value="dark">
                    <label class="form-check-label" for="layout-mode-dark">Dark</label>
                </div>

                <h6 class="mt-4 mb-3">Layout Width</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-width" id="layout-width-fluid"
                        value="fluid" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                    <label class="form-check-label" for="layout-width-fluid">Fluid</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-width" id="layout-width-boxed"
                        value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                    <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                </div>

                <h6 class="mt-4 mb-3">Topbar Color</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-light"
                        value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                    <label class="form-check-label" for="topbar-color-light">Light</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-dark" value="dark"
                        onchange="document.body.setAttribute('data-topbar', 'dark')">
                    <label class="form-check-label" for="topbar-color-dark">Dark</label>
                </div>

                <div id="sidebar-setting">
                    <h6 class="mt-4 mb-3 sidebar-setting">Sidebar Size</h6>

                    <div class="form-check sidebar-setting mt-1">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-default"
                            value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting mt-1">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-compact"
                            value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting mt-1">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-small"
                            value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 sidebar-setting">Sidebar Color</h6>

                    <div class="form-check sidebar-setting mt-1">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-light"
                            value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting mt-1">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-dark"
                            value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting mt-1">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-brand"
                            value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>
                </div>

                <h6 class="mt-4 mb-3">Direction</h6>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-ltr"
                        value="ltr">
                    <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-rtl"
                        value="rtl">
                    <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                </div>

            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/pricing.init.js"></script>

    <script src="assets/js/app.js"></script>


</body>

</html>