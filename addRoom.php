<?php
require('dbConfig.php');
include("adminAuth.php");


$errorMsg = "";

if (isset($_POST['roomName']) ) {
    echo '<script>alert("Inside Room ")</script>';
    $roomName = $_POST['roomName'];
    $roomLocation = $_POST['roomName'];
    $rentalStatus = $_POST['rentalStatus'];
    
  $sql = "INSERT INTO room (room_name, room_location, rental_status) 
						  VALUES ('$roomName', '$roomLocation','$rentalStatus ')";
  if (mysqli_query($db, $sql)) {
	$errorMsg = "Succesfully added room";
	header("Location: roomList.php");
  } else {
	$errorMsg = "Unable to Add room";
  }
}
mysqli_close($db);
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Room - Library Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

 <!-- Favicons -->
 <link href="assets/img/favicon.png" rel="icon">
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
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body>
  <?php include('common/header.php'); ?>
  <?php include('common/adminSidebar.php'); ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Room</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Master Control</li>
          <li class="breadcrumb-item active">Add Room</li>
        </ol>
      </nav>

    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <?php if ($errorMsg != "") { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="bi bi-exclamation-octagon me-1"></i>
              <?php echo $errorMsg; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php } ?>
          <form class="row g-3 needs-validation" novalidate id="addRoom" name="addRoom" method="post" action="addRoom.php" enctype="multipart/form-data">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Room Details</h5>

                <!-- Vertical Form -->
               
                <div class="row mb-3">
                  <label for="roomName" class="col-sm-2 col-form-label">Room Name</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="roomName" name="roomName" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="roomLocation" class="col-sm-2 col-form-label">Room Location</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="roomLocation" name="roomLocation" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="rentalStatus" class="col-sm-2 col-form-label">Rental Status</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="rentalStatus" name="rentalStatus" required>
                  </div>
                </div>
                </div>
                </div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
          </form>
          <!-- End Room Form -->
          </div>

  </main><!-- End #main -->

  <?php include 'common/footer.php'; ?>