<?php
require('dbConfig.php');
include("adminAuth.php");
$bookRentalId = $_GET['bookRentalId'];

$sql = "SELECT * FROM book_rental WHERE book_rental_id='" . $bookRentalId . "'";
$result = $db->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $bookRentalId = $row['book_id'];
    $rentedBy = $row['rented_by'];
    $bookId = $row['book_id'];
    $appDate = $row['application_date'];
    $startDate = $row['start_date'];
    $endDate= $row['end_date'];
    $status = $row['status'];
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
              <h5 class="card-title">View Book Rental</h5>
              <form class="row g-3 needs-validation" novalidate id="viewBookRental" name="viewBookRental" method="post" action="bookRentalList.php" enctype="multipart/form-data">
              <div class="row mb-3">
                  <label for="applicationDate" class="col-sm-2 col-form-label">Application Date</label>
                  <div class="col-sm-3">
                    <?php echo date("d-m-Y", strtotime($appDate)); ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="rentedBy" class="col-sm-2 col-form-label" >Rented By</label>
                  <div class="col-sm-3">
                  <?php echo $rentedBy ?>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="bookId" class="col-sm-2 col-form-label">Book</label>
                  <div class="col-sm-3">
                  <?php echo $bookId ?>
                  </div>
                  </div>

                  <div class="row mb-3">
                  <label for="startDate" class="col-sm-2 col-form-label">Start Date</label>
                  <div class="col-sm-4">
                  <?php echo $startDate ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="endDate" class="col-sm-2 col-form-label">End Date</label>
                  <div class="col-sm-4">
                  <?php echo $endDate ?>
                  </div>
                </div>     
                </div>

              <!-- End Form -->
              <div class="text-center">
                <button type="button" id="button" class="btn btn-secondary" onclick="window.history.back()">Back</button>
              </div>
              </form>
  </main><!-- End #main -->

  <?php include 'common/footer.php'; ?>