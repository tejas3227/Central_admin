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

        <div class="card-container">
            <a href="edit_stud.php?dept=<?php echo $_GET['dept']; ?>&AY=<?php echo $_GET['AY']; ?>" class="card">
                <img src="assets/images/edit_student_img.png" class="card-img-top">
                <h1 class="card-title text-center">Edit Students</h1>
            </a>


            <div class="card">
                <img src="assets/images/view_student_img.jpg" class="card-img-top">
                <label class="academic-year-label">
                    <h1 class="card-title text-center">View Students</h1>
                </label>
                <form method="get" action="view_stud.php">
                    <input type="hidden" name="dept" value="<?php echo urlencode(explode('&', $_GET['dept'])[0]); ?>">
                    <input type="hidden" name="AY" value="<?php echo $_GET['AY']; ?>">
                    <select class="form-control" id="academic_year" name="academic_year" onchange="this.form.submit();">
                        <option value="">Select Academic Year</option>
                        <option value="First Year">First Year</option>
                        <option value="Second Year">Second Year</option>
                        <option value="Third Year">Third Year</option>
                        <option value="Fourth Year">Fourth Year</option>
                    </select>
                </form>

            </div>

            <a href="edit_teacher.php?dept=<?php echo $_GET['dept']; ?>&AY=<?php echo $_GET['AY']; ?>" class="card">
                <img src="assets/images/edit_teacher_img.jpg" class="card-img-top">
                <h1 class="card-title text-center">Edit Teachers</h1>
            </a>

            <a href="view_teacher.php?dept=<?php echo $_GET['dept']; ?>&AY=<?php echo $_GET['AY']; ?>" class="card">
                <img src="assets/images/view_teacher_img.jpg" class="card-img-top">
                <h1 class="card-title text-center">View Teachers</h1>
            </a>
        </div>


        <style>
            .card-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f0f0f0;
                /* Add background color to the container */
            }

            .card {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background-color: #fff;
                color: #333;
                padding: 20px;
                text-decoration: none;
                width: 300px;
                height: 350px;
                border-radius: 10px;
                margin: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                /* Add a subtle box-shadow to the cards */
                transition: all 0.2s ease-in-out;
            }

            .card:hover {
                transform: translateY(-5px);
                /* Change the hover effect to a subtle lift */
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                /* Add a stronger box-shadow on hover */
            }

            .card-img-top {
                max-width: 100%;
                height: auto;
                margin-bottom: 20px;
                border-radius: 10px;
                /* Add rounded corners to the image */
            }

            .card-title {
                margin-top: 0;
                /* Remove margin from the title */
                font-size: 24px;
                font-weight: bold;
                text-align: center;
                text-transform: uppercase;
                margin-bottom: 20px;
            }
        </style>

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