<?php
include('config.php');
error_reporting(0);
if (!isset($_SESSION['signin'])) {
  header('location:login.php');
}

if (isset($_POST['submit'])) {
  $newpass = $_POST['newpass'];
  $confpass = $_POST['confpass'];

  if (isset($_GET['dep_admin_id']) && !empty($_GET['dep_admin_id'])) {
    // Store the selected dep_admin_id in a variable
    $ID = $_GET['dep_admin_id'];
  }

  $getData = mysqli_query($conn, "SELECT * FROM `dep_admin` WHERE `dep_admin_id`='$ID'");
  $row = mysqli_fetch_assoc($getData);

  if ($newpass != $confpass) {
    $error = "New Passwords do not match!";
  } else {
    $updateData = mysqli_query($conn, "UPDATE `dep_admin` SET `password`='$newpass' WHERE `dep_admin_id`='$ID'");
    if ($updateData) {
      echo "<script>alert('Password has been updated successfully.'); window.location='dep_admin_details.php?AY=" . $_GET['AY'] . "';</script>";

    } else {
      $error = "Error occurred while changing password.";
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Change Password</title>
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <form method="post">
    <div class="card">
      <div class="card-header">
        <h3>Change Password</h3>
      </div>
      <div class="card-content">
        <?php if (isset($error)) { ?>
          <div class="error">
            <?php echo $error; ?>
          </div>
        <?php } ?>
        <?php if (isset($success)) { ?>
          <div class="success">
            <?php echo $success; ?>
          </div>
        <?php } ?>
        <label for="newpass">New Password:</label><br>
        <input type="password" name="newpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
          title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
          required><br><br>

        <label for="confpass">Confirm Password:</label><br>
        <input type="password" name="confpass" required><br><br>

        <button type="submit" name="submit" class="button">Change Password</button>


      </div>
    </div>

    <style>
      .card {
        width: 400px;
        height: 650px;
        margin: 30px 30px 30px 30px;
        background-color: white;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      }

      .card-header {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
      }

      .card-content {
        display: flex;
        flex-direction: column;
      }

      label {
        font-weight: bold;
      }

      input[type="password"] {
        border: none;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 0px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
      }

      .button {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px;
        cursor: pointer;
        margin-top: 20px;
      }

      .error {
        color: red;
        margin-bottom: 10px;
      }

      .success {
        color: green;
        margin-bottom: 10px;
      }
    </style>
  </form>
</body>

</html>