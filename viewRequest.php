<?php
require('dbConfig.php');
include("adminAuth.php");
$requestId = $_GET['requestId'];

$sql = "SELECT *  FROM request WHERE request_id='" . $requestId . "'";
$result = $db->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $requestId = $row['request_id'];
    $appDate = $row['request_date'];                   
    $requestDetails = $row['request_details'];
    $requestedBy = $row['requested_by'];
    $requestStatus = $row['request_status']; 
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

  <title>View Request - Library Management System</title>
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
      <h1>View Request</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Request</li>
          <li class="breadcrumb-item active">View Request</li>
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
              <h5 class="card-title">View Request</h5>
              <form class="row g-3 needs-validation" novalidate id="viewRequest" name="viewRequest" method="post" action="requestList.php" enctype="multipart/form-data">
              <div class="row mb-3">
              <label for="requestId" class="col-sm-2 col-form-label">Request No</label>
              <div class="col-sm-5">
              R<?php echo $requestId ?>
              </div>
            </div>
            <div class="row mb-3">
              <label for="requestDate" class="col-sm-2 col-form-label">Request Date</label>
              <div class="col-sm-5">
              <?php echo date("d-m-Y", strtotime($appDate)); ?>
              </div>
            </div>
                <div class="row mb-3">
                  <label for="requestedBy" class="col-sm-2 col-form-label" >Requested By</label>
                  <div class="col-sm-3">
                  <?php echo $requestedBy ?>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="requestDetails" class="col-sm-2 col-form-label">Request Details</label>
                  <div class="col-sm-10">
                  <?php echo $requestDetails ?>
                  </div>
                </div>

              <!-- End Form -->
              <div class="text-center">
                <button type="button" id="button" class="btn btn-secondary" onclick="window.history.back()">Back</button>
              </div>
              </form>
  </main><!-- End #main -->

  <?php include 'common/footer.php'; ?>