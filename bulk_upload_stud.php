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
    && isset($_GET['year']) && !empty($_GET['year'])
    && isset($_GET['AY']) && !empty($_GET['AY'])
) {
    $dept = $_GET['dept'];
    $year = $_GET['year'];
    $AY = $_GET['AY'];
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

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
                                            href="edit_stud.php?dept=<?php echo $_GET['dept']; ?>&AY=<?php echo $_GET['AY']; ?>"
                                            id="topnav-dashboard" role="button" aria-haspopup="true"
                                            aria-expanded="false">
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
                            <a class="dropdown-item" href="edit_stud.php?dept=<?php echo $_GET['dept']; ?>"><i
                                    class="mdi mdi-logout text-muted font-size-16 align-middle me-1"></i> <span
                                    class="align-middle">Student Acitivity</span></a>
                        </div>
                    </div>
                </div>
            </div>

        </header>

        <div class="text-center" style="margin: 20px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Instructions
            </button>
        </div>
        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title" style="color: red;">How to Upload the data</h4>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <p id="first">File must be of .excel</p>
                        <p id="second">Only table head should be included in the first line.</p>
                        <p id="third">Format of .excel file should be same as given as below.</p>
                        <img src="assets/images/student_sample_img.png" alt="Sample Image"><br>
                        <p id="Fourth">Download Format File <a href="assets/samples/CSE_Format_Student.xlsx ">Click to
                                Download</a></p>
                        <style>
                            #myModal img {
                                max-width: 100%;
                                max-height: 400px;
                                margin: 0 auto;
                                display: block;
                            }
                        </style>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div><br><br>

        <?php
        if (isset($_POST["import"])) {
            $fileName = $_FILES["file"]["tmp_name"];

            if ($_FILES["file"]["size"] > 0) {
                require_once 'vendor/autoload.php'; 
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load($fileName);

                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray(null, true, true, true);

                // skip the header row
                array_shift($rows);

                foreach ($rows as $row) {

                    $sqlInsert = "INSERT INTO studinfo (academic_year,PRN,Name,Department,Class,Password) VALUES ('{$_GET['AY']}','$row[A]', '$row[B]', '{$_GET['dept']}', '{$_GET['year']}' ,'$row[C]')";

                    $result = mysqli_query($conn, $sqlInsert);
                }

                if (!empty($result)) {
                    echo "<script>alert('Excel Data Imported Successfully!');</script>";
                } else {
                    echo "<script>alert('Not Imported');</script>";

                }
            }
        }
        ?>




        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <form action="#" method="post" name="uploadFile" enctype="multipart/form-data">
                        <label for="file">Select a file:</label>
                        <input type="file" name="file" id="file" accept=".csv, .xlsx">
                        <button type="submit" name="import">Import</button>
                    </form>
                </div>
            </div>
        </div>


        <style>
            .container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100;
            }

            form {
                border: 1px solid #ccc;
                padding: 20px;
                border-radius: 10px;
            }
        </style>

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