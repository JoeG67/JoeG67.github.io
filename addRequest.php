<?php
require('dbConfig.php');
include("adminAuth.php");


$sql = "SELECT *  FROM user WHERE  user_id='" . $_SESSION['user_id'] . "'";
$result = $db->query($sql);

$sql_user = "SELECT *  FROM user";
$result_user = $db->query($sql_user);


if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $user_id = $row['user_id'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    
  }
} else {
  echo "0 results";
}

$appDate = date("Y-m-d");
echo $appDate;
$errorMsg = "";

if (isset($_POST['requestedBy'])) {

  $requestDetails = $_POST['requestDetails'];
  echo $description;
  $requestedBy = $_POST['requestedBy'];
  echo $requestedBy;
  $requestStatus= "Pending Approval";
	echo $requestStatus;

  $sql2 = "INSERT INTO request (request_date, requested_by, request_details, request_status) 
VALUES ('$appDate','$requestedBy','$requestDetails','$requestStatus')";
  echo $sql2;
  if (mysqli_query($db, $sql2)) {

  $errorMsg = "Succesfully added request";
  header("Location: requestList.php");
  } else {
    $errorMsg = "Unable to add request";
  }

}
mysqli_close($db);
?>
<script>
function displayInfo() {
  var checkBox = document.getElementById("checkBox1");
  var name = document.getElementById("requestedBy");

  if (checkBox.checked == true){
    name.value = "";
  } else {
    name.value=" <?php echo $first_name?> <?php echo $last_name?>";

  }
}
</script>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> Add Request - Library Management System</title>
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
      <h1>Add Request</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="userPage.php">Home</a></li>
          <li class="breadcrumb-item">User</li>
          <li class="breadcrumb-item active">Add Request</li>
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
              <h5 class="card-title">Add Request</h5>
              <form class="row g-3 needs-validation" novalidate id="addRequest" name="addRequest" method="post" action="" enctype="multipart/form-data">
              <div class="row mb-3">
                  <div class="col-sm-10">
                    <input class="form-check-input" type="checkbox" name="checkBox1" id="checkBox1" onclick="displayInfo()"> 
                    <label class="form-check-label" for="checkBox1"> <strong>Request for Others</strong></label>       
                  </div>              
                </div>
                <div class="row mb-3">
                  <label for="requestDate" class="col-sm-2 col-form-label">Request Date</label>
                  <div class="col-sm-3">
                    <?php echo date("d-m-Y", strtotime($appDate)); ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="requestedBy" class="col-sm-2 col-form-label" >Requested By</label>
                  <div class="col-sm-3">
                  <input type="text" class="form-control" id="requestedBy" name="requestedBy" value=" <?php echo $first_name?> <?php echo $last_name?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="requestDetails" class="col-sm-2 col-form-label">Request Details</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" style="height: 150px" id="requestDetails" name="requestDetails" required></textarea>
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