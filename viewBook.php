<?php
require('dbConfig.php');
include("adminAuth.php");
$bookId = $_GET['bookId'];

$sql = "SELECT *  FROM book WHERE book_id='" . $bookId . "'";
$result = $db->query($sql);


if ($result->num_rows > 0) {
  // output data of each row
  while ($row = $result->fetch_assoc()) {
    $bookTitle = $row['book_title'];
    $author = $row['author'];
    $publisher = $row['publisher'];
    $ISBN = $row['ISBN'];
    $releaseYear = $row['release_year'];
    $genre = $row['genre'];
    $rentalStatus = $row['rental_status'];
    $bookCover = $row['book_cover'];
    $target_dir = $row['cover_path'];
    $synopsis = $row['synopsis'];
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

  <title>View Book - Library Management System</title>
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
      <h1>View Book</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Book</li>
          <li class="breadcrumb-item active">View Book</li>
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
            <div class="col-12">
                <br>
                <div>
                <?php echo "<img src=img/cover/$bookCover width=210 height=240>" ?>
              </div>  
              <br>
                <div class="panel panel-primary">
                  <div class="panel-content">
                    <table style="width: 100%" class="table table-bordered">
                      <thead>
                        <th>Book ID: </th>
                        <td><?php echo $bookId ?></td>
                        <th>Book Title: </th>
                        <td><?php echo $bookTitle ?></td>
                        </tr>
                        <tr>
                        <th>Author: </th>
                          <td><?php echo $author ?></td>
                          <th>Genre: </th>
                          <td><?php echo $genre ?></td>
                          </tr>
                        <tr>
                          <th>Release Year: </th>
                        <td><?php echo date("Y", strtotime($releaseYear)); ?></td>
                          <th>Synopsis: </th>
                          <td><?php echo $synopsis ?></td>
                        </tr>
                        <tr>
                          <th>Publisher: </th>
                          <td><?php echo $publisher ?></td>
                        <th>ISBN: </th>
                          <td><?php echo $ISBN ?></td>
                        </tr>
                        <tr>
                          
                          <th>Availability: </th>
                          <td><?php echo $rentalStatus ?></td>
                        </tr>
                        </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
                
        

              <!-- End Book Form -->
              <div class="text-center">
                <button type="button" id="button" class="btn btn-secondary" onclick="window.history.back()">Back</button>
              </div>

  </main><!-- End #main -->

  <?php include 'common/footer.php'; ?>