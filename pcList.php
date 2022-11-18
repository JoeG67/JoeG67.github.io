<?php
require('dbConfig.php');
include("adminAuth.php");

$sql = "SELECT * FROM pc";
$result = $db->query($sql);

$role_action = "";

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PC List - Library Management System</title>
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

  <?php include("common/adminSidebar.php"); ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>PC List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Book</li>
          <li class="breadcrumb-item active">PC List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <!-- Default Table -->
              <div class="col-12">
              <br>
                <a class="badge border-primary border-1 text-primary" style="float:right;" href="addPC.php"><u>Add PC</u></a>
                <br>
                <table class="table datatable table-hover">
                  <thead>
                    <tr>
                    <th scope="col">PC ID</th>
                      <th scope="col">PC Name</th>
                       <th scope="col">Rental Status</th>
                      <th scope="col" style="text-align:right;">Action</th>

                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if ($result->num_rows > 0) {
                      // output data of each row
                      while ($row = $result->fetch_assoc()) {
                        $pcId = $row['pc_id'];
                        $pcName = $row['pc_name'];
                        $rentalStatus = $row['rental_status'];
                    
                    ?>
                        <tr>
                          <td><?php echo $pcId ?>
                          <td><?php echo $pcName ?>
                          <td><?php echo $rentalStatus ?>
                         
                          <td style="text-align:right;">
                            <a href="editPC.php?pcId=<?php echo $pcId?>"><i class="bx bxs-pencil"></i></a> |
                            <a href="deletePC.php?pcId=<?php echo $pcId?>"><i class="ri-delete-bin-5-line"></i></a>
                          </td>

                        </tr>
                    <?php

                      }
                    } else {
                      echo "0 results";
                    }
                    //$db->close(); 
                    ?>
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </div>
    </section>


  </main><!-- End #main -->

  <?php include 'common/footer.php'; ?>