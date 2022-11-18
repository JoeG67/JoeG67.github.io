<?php
require('dbConfig.php');
include("adminAuth.php");
$roomRentalId = $_GET['roomRentalId'];

$sql = "SELECT * FROM room_rental WHERE room_rental_id='" . $roomRentalId . "'";
$result = $db->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $roomRentalId = $row['room_rental_id'];
    $rentedBy = $row['rented_by'];
    $roomId = $row['room_id'];
    $rentalDate = $row['rental_date'];
    $startTime = $row['starting_time'];
    $endTime= $row['ending_time'];
    $status = $row['status'];
    $reason = $row['reason'];
  }
} else {
  echo "0 results";
}


$appDate = date("Y-m-d");

$errorMsg = "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>View Book Rental - Library Management System</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Icons -->
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
      <h1>View Book Rental</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Book</li>
          <li class="breadcrumb-item active">View Book Rental</li>
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
          <div class="card">
            <div class="card-body">
            <h5 class="card-title">Room Rental Details>
          <form class="row g-3 needs-validation" novalidate id="roomRentalApproval" name="roomRentalApproval" method="post" action="" enctype="multipart/form-data">
          <div class="row mb-3">
          
              <div class="row mb-3">
                  <label for="rentedBy" class="col-sm-2 col-form-label" >Rental ID</label>
                  <div class="col-sm-3">
                  <?php echo $roomRentalId?>
                  </div>
                </div>
                  <label for="applicationDate" class="col-sm-2 col-form-label">Application Date</label>
                  <div class="col-sm-3">
                    <?php echo date("d-m-Y", strtotime($appDate)); ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="rentalDate" class="col-sm-2 col-form-label" >Rental Date</label>
                  <div class="col-sm-3">
                  <?php echo date("d-m-Y", strtotime($rentalDate)); ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="rentedBy" class="col-sm-2 col-form-label" >Rented By</label>
                  <div class="col-sm-3">
                  <?php echo $rentedBy ?>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="roomId" class="col-sm-2 col-form-label">Room</label>
                  <div class="col-sm-3">
                  <?php echo $roomId ?>
                  </div>
                  </div>
                  <div class="row mb-3">
                  <label for="startTime" class="col-sm-2 col-form-label">Start Time</label>
                  <div class="col-sm-4">
                  <?php echo $startTime ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="endTime" class="col-sm-2 col-form-label">End Time</label>
                  <div class="col-sm-4">
                  <?php echo $endTime ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="reason" class="col-sm-2 col-form-label">Reason</label>
                  <div class="col-sm-4">
                  <?php echo $reason ?>
                  </div>
                </div> 
                  <div class="row mb-3">
                  <label for="status" class="col-sm-2 col-form-label">Status</label>
                  <div class="col-sm-4">
                  <?php echo $status ?>
                  </div>

              <!-- End Form -->
              <div class="text-center">
                <button type="button" id="button" class="btn btn-secondary" onclick="window.history.back()">Back</button>
              </div>
              </form>
  </main><!-- End #main -->

  <?php include 'common/footer.php'; ?>