<?php
include('config.php');
error_reporting(0);
if (!isset($_SESSION['signin'])) {
    header('location:login.php');
}
$ID = $_SESSION['signin'];
$getData = mysqli_query($conn, "select * from `admin` where `admin_id`='$ID'");
$row = mysqli_fetch_assoc($getData);

if (isset($_GET['dept']) && !empty($_GET['dept'])) {
    // Store the selected academic year and department values in variables
    $dept = $_GET['dept'];

}
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Select Students or Teachers</title>
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
                </div>

                <div class="topnav">
                    <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link dropdown-toggle arrow-none"
                                        href="dep_select.php?AY=<?php echo $_GET['AY']; ?>" id="topnav-dashboard"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-arrow-back"></i>
                                        <span data-key="t-dashboard">Go back</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link dropdown-toggle arrow-none"
                                        href="Cdep_assign.php?AY=<?php echo $_GET['AY']; ?>" id="topnav-dashboard"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-user"></i>
                                        <span data-key="t-dashboard">Assigned Students</span>
                                    </a>
                                </li>
                                <li class="nav-item active">
                                    <a class="nav-link dropdown-toggle arrow-none"
                                        href="Cdep_Unassign.php?AY=<?php echo $_GET['AY']; ?>" id="topnav-dashboard"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-user"></i>
                                        <span data-key="t-dashboard">Unassigned Students</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
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
                            <a class="dropdown-item" href="login.php"><i
                                    class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span
                                    class="align-middle">Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>


        </header>
        <style>
            h5 {
                font-size: 1.2rem;
                margin-bottom: 10px;
                color: #2a3b47;
            }

            .form-control {
                background-color: #f5f5f5;
                border-color: #ddd;
                color: #555;
                font-size: 1rem;
                font-weight: 400;
                padding: 0.375rem 0.75rem;
                border-radius: 0.25rem;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            .form-control:focus {
                border-color: #6c757d;
                outline: 0;
                box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
            }

            .form-control option:first-child {
                color: #aaa;
            }

            .form-control option {
                color: #333;
            }

            select[name=dept] {
                text-align-last: center;
            }

            select[name=dept] option {
                text-align: center;
            }
        </style>
        <div class="text-center" style="width: 400px; background-color: white; padding: 20px; border-radius: 5px; margin: 30px auto 0;">
            <h5>To Check Unassignment Status:</h5>
            <form method="get">
                <input type="hidden" name="AY" value="<?php echo $_GET['AY']; ?>">
                <select class="form-control" name="dept" onchange="this.form.submit();">
                    <option value="">Select Department</option>
                    <option value="CSE">Computer Science Engineering</option>
                    <option value="MECH">Mechanical Engineering</option>
                    <option value="ELE">Electrical Engineering</option>
                    <option value="CVL">Civil Engineering</option>
                    <option value="BIO">Biotechnology Engineering</option>
                    <option value="ENV">Environmental Engineering</option>
                    <option value="ENTC">Electronics and Telecommunication Engineering</option>
                    <option value="PROD">Production Engineering</option>
                    <option value="DS">Data Science</option>
                    <option value="AIML">Artificial Intelligence Machine Learning</option>
                    <option value="CVEN">Civil and Environmental Engineering</option>
                </select>
            </form>
        </div>

        <div class="hori-overlay"></div>
        <?php
        if (isset($_GET['dept']) && !empty($_GET['dept'])) {
            // Store the selected academic year and department values in variables
            $dept = $_GET['dept'];
            ?>
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
                                        <h4 class="card-title">Assigned Students to Teachers
                                            <?php echo "$dept Department"; ?>
                                        </h4>
                                    </div><!-- end card header -->
                                    <style>
                                        .button-container {
                                            display: flex;
                                            justify-content: center;
                                        }
                                    </style>
                                    <div class="button-container">
                                        <a href="Cdep_unassign_Report.php?AY=<?php echo $_GET['AY']; ?>&dept=<?php echo urlencode($dept); ?>"
                                            class="btnPDF">Generate PDF</a>
                                    </div>

                                    <div class="card-content table-responsive">
                                        <table class="table table-bordered border-dark" id="table">

                                            <?php
                                            $result = mysqli_query($conn, "SELECT * FROM studinfo WHERE `Department` = '$dept' AND `PRN` NOT IN (SELECT `PRN` FROM assign)");

                                            ?>
                                            <?php
                                            $query1 = "SELECT COUNT(*) AS count FROM studinfo 
                                          WHERE Department = '$dept'
                                          AND NOT EXISTS (SELECT 1 FROM assign WHERE studinfo.PRN = assign.PRN)";
                                            $result1 = mysqli_query($conn, $query1);
                                            $row1 = mysqli_fetch_assoc($result1);
                                            $count = $row1['count'];
                                            echo "<thead class='text-primary'>";
                                            echo "<tr>";
                                            echo "<th colspan='6' style='text-align: center;'>Students Not Assigned : $count</th>";
                                            echo "</tr>";
                                            echo "</thead>";
                                            ?>
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

                                            <thead class="text-primary">
                                                <tr>
                                                    <th style='text-align: center;'>PRN</th>
                                                    <th style='text-align: center;'>Class</th>
                                                    <th style='text-align: center;'>Student Name</th>
                                                    <th style='text-align: center;'>Department</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $down = mysqli_query($conn, "SELECT * FROM studinfo WHERE `Department` = '$dept' AND `PRN` NOT IN (SELECT `PRN` FROM assign)");

                                                while ($row = mysqli_fetch_assoc($down)) {
                                                    echo "<tr>";
                                                    echo "<td style='text-align: center;'>" . $row['PRN'] . "</td>";
                                                    echo "<td style='text-align: center;'>" . $row['Class'] . "</td>";
                                                    echo "<td style='text-align: center;'>" . $row['Name'] . "</td>";
                                                    echo "<td style='text-align: center;'>" . $row['Department'] . "</td>";
                                                    echo "</tr>";
                                                }

                                                mysqli_close($conn);
                                                ?>
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
            </div>
            <?php
        }
        ?>


        <!-- JAVASCRIPT -->
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenujs/metismenujs.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <script src="assets/js/pages/pricing.init.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/app.js"></script>



</body>

</html>