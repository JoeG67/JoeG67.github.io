<?php
require('dbConfig.php');
include("adminAuth.php");
$userId = $_SESSION['user_id'];

$sql = "SELECT * FROM book_rental";
$result = $db->query($sql);
$role_action = "";

$sql_pc = "SELECT * FROM pc_rental";
$result_pc = $db->query($sql_pc);

$sql_room = "SELECT * FROM room_rental";
$result_room = $db->query($sql_room);

$sql_request = "SELECT *  FROM request";
$result_request  = $db->query($sql_request);

$sql2 = "SELECT * FROM user WHERE user_id= '" . $_SESSION['user_id'] . "'";
$result2 = $db->query($sql2);

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

  <title>Home Page - Library Management System</title>
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

  <?php include('common/adminHeader.php'); ?>

  <?php include("common/adminSidebar.php"); ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Admin Page</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</a></li>
          <li class="breadcrumb-item">Admin</li>
          <li class="breadcrumb-item active">Rentals</li>
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
                 <h4>Book Rentals</h4>
                  <thead>
                    <tr class="dark">
                      <th scope="col">Book Rental ID</th>
                      <th scope="col">Book Title</th>
                      <th scope="col">Rented By</th>
                      <th scope="col">Application Date</th>
                      <th scope="col">Start Date</th>
                      <th scope="col">End Date</th>
                      <th scope="col">Status</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if ($result->num_rows > 0) {
                      // output data of each row
                      while ($row = $result->fetch_assoc()) {
                        $bookRentalId = $row['book_rental_id'];
                        $rentedBy = $row['rented_by'];
                        $bookId = $row['book_id'];
                        $applicationDate = $row['application_date'];
                        $startDate = $row['start_date'];
                        $endDate= $row['end_date'];
                        $status = $row['status'];
                    ?>
                        <tr>
                          <td><?php echo $bookRentalId ?></td>
                          <td><?php echo $bookId ?></td>
                          <td><?php echo $rentedBy ?></td>
                          <td><?php echo date("d-m-Y", strtotime($applicationDate)); ?></td>
                          <td><?php echo date("d-m-Y", strtotime($startDate)); ?></td>
                          <td><?php echo date("d-m-Y", strtotime($endDate)); ?></td>
                          <td><?php echo $status ?></td>
                          <td style="text-align:center;">
                          <a href="viewBookRental.php?bookRentalId=<?php echo $bookRentalId ?>"><i class="bi bi-eye-fill"></i></a>
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
        <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <div class="col-12">
                <table class="table datatable table-hover">
                <h4>PC Rentals</h4>
                  <thead>
                    <tr class="dark">
                      <th scope="col">PC Rental ID</th>
                      <th scope="col">PC Name</th>
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

                    if ($result_pc->num_rows > 0) {
                      // output data of each row
                      while ($row = $result_pc->fetch_assoc()) {
                        $pcRentalId = $row['pc_rental_id'];
                        $rentedBy = $row['rented_by'];
                        $pcId = $row['pc_id'];
                        $rentalDate = $row['rental_date'];
                        $startTime = $row['starting_time'];
                        $endTime= $row['ending_time'];
                        $status = $row['status'];
                    ?>
                        <tr>
                          <td><?php echo $pcRentalId ?></td>
                          <td><?php echo $pcId ?></td>
                          <td><?php echo $rentedBy ?></td>
                          <td><?php echo date("d-m-Y", strtotime($rentalDate)); ?></td>
                          <td><?php echo $startTime ?></td>
                          <td><?php echo $endTime ?></td>
                          <td><?php echo $status ?></td>
                          <td style="text-align:center;">
                          <a href="viewPCRental.php?pcRentalId=<?php echo $pcRentalId ?>"><i class="bi bi-eye-fill"></i></a>
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
        </div>

        <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
                <div class="col-12">
                <table class="table datatable table-hover">
                <h4>Room Rentals</h4>
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

                    if ($result_room->num_rows > 0) {
                      // output data of each row
                      while ($row = $result_room->fetch_assoc()) {
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

        <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <!-- Default Table -->
              <div class="col-12">
                <table class="table datatable table-hover">
                <h4>Requests</h4>
                  <thead>
                    <tr>
                    <th scope="col">Request No</th>
                      <th scope="col">Request Date</th>
                      <th scope="col">Requested By</th>
                      <th scope="col">Request Details</th>
                      <th scope="col">Request Status</th>
                      <th scope="col" style="text-align:center;">Action</th>

                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if ($result_request->num_rows > 0) {
                      // output data of each row
                      while ($row = $result_request->fetch_assoc()) {
                        $requestId = $row['request_id'];
                        $appDate = $row['request_date'];                   
                        $requestDetails = $row['request_details'];
                        $requestedBy = $row['requested_by'];
                        $requestStatus = $row['request_status']; 
                    ?>
                        <tr>
                        <td><?php echo $requestId?></td>
                          <td> <?php echo date("d-m-Y", strtotime($appDate)); ?></td>
                          <td><?php echo $requestedBy?></td>
                          <td><?php echo $requestDetails?></td>
                          <td><?php echo $requestStatus ?></td>
                          <td style="text-align:center;">
                            <a href="viewRequest.php?requestId=<?php echo $requestId ?>"><i class="bi bi-eye-fill"></i></a>
                          </td>
                        </tr>
                    <?php

                      }
                    } else {
                      echo "";
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