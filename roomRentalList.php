<?php
require('dbConfig.php');
include("adminAuth.php");

$sql = "SELECT * FROM room_rental";
$result = $db->query($sql);
$role_action = "";





?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Room Rental List - Library Management System</title>
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
 <link href="assets\css\style.css" rel="stylesheet">

</head>


<body>

  <?php include('common/header.php'); ?>

  <?php include("common/adminSidebar.php"); ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Room Rental List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="userPage.php">Home</a></li>
          <li class="breadcrumb-item">Rooms</li>
          <li class="breadcrumb-item active">Room Rental List</li>
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
                <table class="table datatable table-hover">
                  <thead>
                    <tr class="dark">
                      <th scope="col">Room Rental ID</th>
                      <th scope="col">Room Name</th>
                      <th scope="col">Rented By</th>
                      <th scope="col">Rental Date</th>
                      <th scope="col">Start Time</th>
                      <th scope="col">End Time</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

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
                    ?>
                        <tr>
                          <td><?php echo $roomRentalId ?></td>
                          <td><?php echo $roomId ?></td>
                          <td><?php echo $rentedBy ?></td>
                          <td><?php echo date("d-m-Y", strtotime($rentalDate)); ?></td>
                          <td><?php echo $startTime ?></td>
                          <td><?php echo $endTime ?></td>
                          <td><?php echo $status ?></td>
                          <td style="text-align:center;">
                          <a href="viewRoomRental.php?roomRentalId=<?php echo $roomRentalId ?>"><i class="bi bi-eye-fill"></i></a>
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