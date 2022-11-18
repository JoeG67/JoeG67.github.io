<?php
require('dbConfig.php');
include("adminAuth.php");


$sql = "SELECT *  FROM user WHERE user_id='" . $_SESSION['user_id'] . "'";
$result = $db->query($sql);

$sql_user = "SELECT *  FROM user";
$result_user = $db->query($sql_user);

$sql_book = "SELECT *  FROM book";
$result_book = $db->query($sql_book);

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

if (isset($_POST['bookId'])) {
  $bookTitle= $_POST['bookId'];
  $rentedBy= $_POST['rentedBy'];
  $startDate = $_POST['startDate'];
  $endDate = $_POST['endDate'];
  $status= "Pending Approval";

  $sql2 = "INSERT INTO book_rental (rented_by, book_id, application_date, start_date, end_date, status) 
VALUES ('$rentedBy','$bookTitle','$appDate','$startDate','$endDate','$status')";
  echo $sql2;
  if (mysqli_query($db, $sql2)) {

  $errorMsg = "Succesfully added book";
  header("Location: bookRentalList.php");
  } else {
    $errorMsg = "Unable to add book";
  }

}
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Rent Book - Library Management System</title>
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
      <h1>Rent Book</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="userPage.php">Home</a></li>
          <li class="breadcrumb-item">Book</li>
          <li class="breadcrumb-item active">Rent Book</li>
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
              <h5 class="card-title">Rent Book</h5>
              <form class="row g-3 needs-validation" novalidate id="rentBook" name="rentBook" method="post" action="" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="applicationDate" class="col-sm-2 col-form-label">Application Date</label>
                  <div class="col-sm-3">
                    <?php echo date("d-m-Y", strtotime($appDate)); ?>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="rentedBy" class="col-sm-2 col-form-label" >Rented By</label>
                  <div class="col-sm-3">
                  <input type="text" class="form-control" id="rentedBy" name="rentedBy" value=" <?php echo $user_id?>" required>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="bookId" class="col-sm-2 col-form-label">Book</label>
                  <div class="col-sm-3">
                  <select id="bookId" class="form-select" name="bookId" required>
                      <option selected></option>
                      <?php
                      if ($result_book->num_rows > 0) {
                        // output data of each row
                        while ($row = $result_book->fetch_assoc()) {
                          $bookId = $row['book_id'];
                          $bookTitle = $row['book_title'];
                      ?>
                          <option><?php echo $bookTitle ?></option>

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
                  <label for="startDate" class="col-sm-2 col-form-label">Start Date</label>
                  <div class="col-sm-4">
                    <input type="date" class="form-control" id="startDate" name="startDate" required min="<?= date('Y-m-d') ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="endDate" class="col-sm-2 col-form-label">End Date</label>
                  <div class="col-sm-4">
                    <input type="date" class="form-control" id="endDate" name="endDate" required min="<?= date('Y-m-d') ?>">
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