<?php
include('config.php');

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
  <title>Select Department</title>
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
                <img src="assets/images/logo-sm.svg" alt="" height="26"> <span class="logo-txt">Central Admin</span>
              </span>
            </a>

            <a class="logo logo-light">
              <span class="logo-sm">
                <img src="assets/images/logo-sm.svg" alt="" height="26">
              </span>
              <span class="logo-lg">
                <img src="assets/images/logo-sm.svg" alt="" height="26"> <span class="logo-txt">Central Admin</span>
              </span>
            </a>
          </div>

          <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item" data-bs-toggle="collapse"
            id="horimenu-btn" data-bs-target="#topnav-menu-content">
            <i class="fa fa-fw fa-bars"></i>
          </button>

          <div class="topnav">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

              <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link dropdown-toggle arrow-none" href="dashboard.php" id="topnav-dashboard"
                      role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-home"></i>
                      <span data-key="t-dashboard">Dashboard</span>
                    </a>
                  </li>
                  <li>
                  <li class="nav-item">
                    <a class="nav-link dropdown-toggle arrow-none" href="Cdep_assign.php?AY=<?php echo $_GET['AY']; ?>"
                      id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                      <i class="bx bx-user"></i>
                      <span data-key="t-dashboard">Student Assignment</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link dropdown-toggle arrow-none"
                      href="Cfaculty_assign.php?AY=<?php echo $_GET['AY']; ?>" id="topnav-dashboard" role="button"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-book-open"></i>
                      <span data-key="t-dashboard">Faculty Assignment</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link dropdown-toggle arrow-none"
                      href="dep_admin_details.php?AY=<?php echo $_GET['AY']; ?>" id="topnav-dashboard" role="button"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-user-shield"></i>
                      <span data-key="t-dashboard">Departmental Admin Details</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link dropdown-toggle arrow-none"
                      href="Cstud_meetings.php?AY=<?php echo $_GET['AY']; ?>" id="topnav-dashboard" role="button"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-calendar"></i>
                      <span data-key="t-dashboard">Meeting History</span>
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
              id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
      <a href="year_select.php?dept=CSE&AY=<?php echo $_GET['AY']; ?>" target="_blank" class="card">
        <img src="assets/images/CSE-500x372.jpg" class="card-img-top">
        <h3 class="card-title text-center" style="color: Black">Computer Science and Engineering</h3><br>
      </a>

      <a href="year_select.php?dept=MECH&AY=<?php echo $_GET['AY']; ?>" target="_blank" class="card">
        <img src="assets/images/MECH.jpeg" class="card-img-top">
        <h1 class="card-title text-center" style="color: Black">Mechanical Engineering</h1>
      </a>

      <a href="year_select.php?dept=ELE&AY=<?php echo $_GET['AY']; ?>" target="_blank" class="card">
        <img src="assets/images/electrical-engineering-image.webp" class="card-img-top">
        <h1 class="card-title text-center" style="color: Black">Electrical Engineering</h1>
      </a>

      <a href="year_select.php?dept=CVL&AY=<?php echo $_GET['AY']; ?>" target="_blank" class="card">
        <img src="assets/images/CIVIL.jpg" class="card-img-top">
        <h1 class="card-title text-center" style="color: Black">Civil Engineering</h1>
      </a>

      <a href="year_select.php?dept=BIO&AY=<?php echo $_GET['AY']; ?>" target="_blank" class="card">
        <img src="assets/images/biotechnology-engineering-image.webp" class="card-img-top">
        <h1 class="card-title text-center" style="color: Black">Biotechnology</h1>
      </a>

      <a href="year_select.php?dept=ENV&AY=<?php echo $_GET['AY']; ?>" target="_blank" class="card">
        <img src="assets/images/Environmental-Engineering.jpg" class="card-img-top">
        <h1 class="card-title text-center" style="color: Black">Environmental Engineering</h1>
      </a>

      <a href="year_select.php?dept=ENTC&AY=<?php echo $_GET['AY']; ?>" target="_blank" class="card">
        <img src="assets/images/ENTC.png" class="card-img-top">
        <h1 class="card-title text-center" style="color: Black">Electronics and Telecommunication Engineering</h1>
      </a>

      <a href="year_select.php?dept=PROD&AY=<?php echo $_GET['AY']; ?>" target="_blank" class="card">
        <img src="assets/images/PRODUCTION.jpeg" class="card-img-top">
        <h1 class="card-title text-center" style="color: Black">Prodction Engineering</h1>
      </a>

      <a href="year_select.php?dept=DS&AY=<?php echo $_GET['AY']; ?>" target="_blank" class="card">
        <img src="assets/images/DS.jpg" class="card-img-top">
        <h1 class="card-title text-center" style="color: Black">Data Science Engineering</h1>
      </a>

      <a href="year_select.php?dept=AIML&AY=<?php echo $_GET['AY']; ?>" target="_blank" class="card">
        <img src="assets/images/AIML.jpeg" class="card-img-top">
        <h1 class="card-title text-center" style="color: Black">Artificial Intelligence and Machine Learning</h1>
      </a>

      <a href="year_select.php?dept=CVEN&AY=<?php echo $_GET['AY']; ?>" target="_blank" class="card">
        <img src="assets/images/CVEN.jpg" class="card-img-top">
        <h1 class="card-title text-center" style="color: Black">Civil and Environmental Engineering</h1>
      </a>

    </div>

    <style>
      .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        height: 190vh;
        background-color: #D3D3D3;
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
        height: 200px;
        margin-bottom: 20px;
        border-radius: 10px;
        /* Add rounded corners to the image */
      }

      .card {
        background-color: #f5f5f5;
        /* other properties */
      }

      .card:hover {
        background-color: #483D8B;
        /* other properties */
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