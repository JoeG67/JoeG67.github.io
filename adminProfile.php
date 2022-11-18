<?php
require('dbConfig.php');
include("adminAuth.php");
$sql = "SELECT * FROM user where user_id='" . $_SESSION['user_id'] . "'";
$result = $db->query($sql);
$role_action = "";
$errorMsg = "";

if (isset($_POST['password2'])) {

  $password2 = $_POST['password2'];
  $confirmPassword2 = $_POST['confirmPassword2'];

  if ($password2  == $confirmPassword2) {

    $sql = "update user set password = '" . $password2 . "' where user_id='" . $_SESSION['user_id'] . "'";
    $result = mysqli_query($db, $sql);

    if ($result) {
      header("location:adminProfile.php");
    } else {
      echo ' Please Check Your Query ';
    }
  } else {
    $errorMsg = "Password does not match!";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> User Profile - Library Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/icon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

  <?php include('common/header.php'); ?>
  <?php include('common/adminSidebar.php'); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>User Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Account</li>
          <li class="breadcrumb-item active">My Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <?php if ($errorMsg != "") { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i>
        <?php echo $errorMsg; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php } ?>
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <?php

              if ($result->num_rows >= 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                  $user_id = $row['user_id'];
                  
                  $first_name = $row['first_name'];
                  $last_name = $row['last_name'];
                  $file_user = $row['photo_name'];
                  $email = $row['email'];              
                  $role = $row['role'];
                  $address = $row['address'];   
                  $password = $row['password'];
              ?>
                  <img src="img\user\<?php echo $file_user ?>" alt="Profile" class="rounded-circle">
                  <h2><?php echo $first_name ?> <?php echo $last_name ?></h2>
         
              <?php

                }
              } else {
                echo "0 results";
              }
              //$db->close(); 
              ?>
            </div>
          </div>
        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Profile Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Change Password</button>
                </li>


              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">User ID</div>
                    <div class="col-lg-9 col-md-8"><?php echo $user_id ?> </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Name</div>
                    <div class="col-lg-9 col-md-8"> <?php echo $first_name ?> <?php echo $last_name ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"> <?php echo $address ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo $email ?></div>
                  </div>

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->

                  <form class="row g-3 needs-validation" novalidate id="updatePassword" name="updatePassword" method="post" action="" enctype="multipart/form-data">

                    <div class="row mb-3">
                      <label for="password" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-2">
                        <input type="password" class="form-control" id="password2" name="password2" value="<?php echo $password ?>">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                      <div class="col-sm-2">
                        <input type="password" class="form-control" id="confirmPassword2" name="confirmPassword2" value="<?php echo $password ?>">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->
                </div>
              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include 'common/footer.php'; ?>