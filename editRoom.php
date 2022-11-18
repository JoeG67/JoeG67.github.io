<?php
require('dbConfig.php');
include("adminAuth.php");
$roomId = $_GET['roomId'];

$sql = " SELECT * FROM room where room_id ='" . $roomId . "'";
$result = $db->query($sql);

$sql2 = "SELECT * FROM user WHERE user_id= '" . $_SESSION['user_id'] . "'";
$result2 = $db->query($sql2);

$file_name = "";
$errorMsg = "";

while ($row = mysqli_fetch_assoc($result)) {
  $roomId =  $row['room_id'];
  $roomName = $row['room_name'];
  $roomLocation = $row['room_location'];
  $rentalStatus = $row['rental_status'];
}

if ($result2->num_rows > 0) {
  // output data of each row
  while ($row2 = $result2->fetch_assoc()) {
    $role = $row2['role'];
    if ($row2["role"] <> "ADMIN") {
      header("Location: logout.php");
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Edit Room - Library Management System</title>
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
 
  <?php include('common/adminHeader.php'); ?>
  <?php include('common/adminSidebar.php'); ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Room</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Books</li>
          <li class="breadcrumb-item active">Edit Room</li>
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
          <form class="row g-3 needs-validation" novalidate id="updateRoom" name="updateRoom" method="post" action="updateRoom.php?roomId=<?php echo $roomId ?>" enctype="multipart/form-data">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Room Details</h5>

                <!--Form -->
                
                <div class="row mb-3">
                  <label for="name" class="col-sm-2 col-form-label">Room Name</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="roomName" name="roomName" value="<?php echo $roomName ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="name" class="col-sm-2 col-form-label">Room Location</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="roomLocation" name="roomLocation" value="<?php echo $roomLocation ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="name" class="col-sm-2 col-form-label">Rental Status</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="rentalStatus" name="rentalStatus" value="<?php echo $rentalStatus ?>">
                  </div>
                </div>
                </div>
                </div>
               

              <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
          </form>

          <!-- End Form -->
          </div-->

  </main><!-- End #main -->

  <?php include 'common/footer.php'; ?>