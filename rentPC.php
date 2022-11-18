<?php
require('dbConfig.php');
include("adminAuth.php");


$sql = "SELECT *  FROM user WHERE user_id='" . $_SESSION['user_id'] . "'";
$result = $db->query($sql);

$sql_user = "SELECT *  FROM user";
$result_user = $db->query($sql_user);

$sql_pc = "SELECT *  FROM pc";
$result_pc = $db->query($sql_pc);

if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $user_id = $row['user_id'];

    
  }
} else {
  echo "0 results";
}

$appDate = date("Y-m-d");
echo $appDate;
$errorMsg = "";

if (isset($_POST['pcId'])) {
  $pcName= $_POST['pcId'];
  $rentedBy= $_POST['rentedBy'];
  $startTime = $_POST['startTime'];
  $rentalDate = $_POST['rentalDate'];
  $endTime = $_POST['endTime'];
  $reason = $_POST['reason'];
  $status= "Pending Approval";

  $sql2 = "INSERT INTO pc_rental (rented_by, pc_id, application_date, rental_date, starting_time, ending_time, reason, status) 
VALUES ('$rentedBy','$pcName','$appDate','$rentalDate','$startTime','$endTime','$reason','$status')";
  echo $sql2;
  if (mysqli_query($db, $sql2)) {

  $errorMsg = "Succesfully added pc";
  header("Location: pcRentalList.php");
  } else {
    $errorMsg = "Unable to add pc";
  }

}
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Rent PC - Library Management System</title>
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


</head>

<body>

  <?php include('common/header.php'); ?>
  <?php include('common/userSidebar.php'); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Rent PC</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="userPage.php">Home</a></li>
          <li class="breadcrumb-item">PC</li>
          <li class="breadcrumb-item active">Rent PC</li>
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
            </div>
          <?php } ?>
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Rent PC</h5>
              <form class="row g-3 needs-validation" novalidate id="rentPC" name="rentPC" method="post" action="" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="applicationDate" class="col-sm-2 col-form-label">Application Date</label>
                  <div class="col-sm-3">
                    <?php echo date("d-m-Y", strtotime($appDate)); ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="rentalDate" class="col-sm-2 col-form-label" >Rental Date</label>
                  <div class="col-sm-3">
                  <input type="date" class="form-control" id="rentalDate" name="rentalDate" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="rentedBy" class="col-sm-2 col-form-label" >Rented By</label>
                  <div class="col-sm-3">
                  <input type="text" class="form-control" id="rentedBy" name="rentedBy" value=" <?php echo $user_id?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="pcId" class="col-sm-2 col-form-label">PC</label>
                  <div class="col-sm-3">
                  <select id="pcId" class="form-select" name="pcId" required>
                      <option selected></option>
                      <?php
                      if ($result_pc->num_rows > 0) {
                        // output data of each row
                        while ($row = $result_pc->fetch_assoc()) {
                          $pcId = $row['pc_id'];
                          $pcName = $row['pc_name'];
                      ?>
                          <option><?php echo $pcName ?></option>

                      <?php
                        }
                      } else {
                        echo "0 results";
                      }
                      ?>
                    </select>
                  </div>
                  </div>
                  <div class="row mb-3">
                  <label for="startTime" class="col-sm-2 col-form-label">Start Time</label>
                  <div class="col-sm-4">
                    <input type="time" class="form-control" id="startTime" name="startTime" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="endTime" class="col-sm-2 col-form-label">End Time</label>
                  <div class="col-sm-4">
                    <input type="time" class="form-control" id="endTime" name="endTime" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="reason" class="col-sm-2 col-form-label">Reason</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 150px" id="reason" name="reason" required></textarea>
                  </div>
                </div>     
                </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End Horizontal Form -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  <?php include 'common/footer.php'; ?>