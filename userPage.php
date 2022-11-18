<?php
require('dbConfig.php');
include("adminAuth.php");
$userId = $_SESSION['user_id'];

$sql = "SELECT * FROM book";
$result = $db->query($sql);
$role_action = "";

$sql_pc = "SELECT * FROM pc";
$result_pc = $db->query($sql_pc);

$sql_room = "SELECT * FROM room";
$result_room = $db->query($sql_room);


$sql2 = "SELECT * FROM user WHERE user_id= '" . $_SESSION['user_id'] . "'";
$result2 = $db->query($sql2);

if ($result2->num_rows > 0) {
  // output data of each row
  while ($row2 = $result2->fetch_assoc()) {
    $role = $row2['role'];
    if ($row2["role"] <> "USER") {
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

  <?php include('common/header.php'); ?>

  <?php include("common/userSidebar.php"); ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>User Page</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</a></li>
          <li class="breadcrumb-item">User</li>
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
                 <h4>Books</h4>
                  <thead>
                    <tr class="dark">
                    <th scope="col">Book ID</th>
                      <th scope="col">Book Title</th>
                      <th scope="col">Author</th>
                      <th scope="col">ISBN</th>
                      <th scope="col">Genre</th>
                      <th scope="col">Publisher</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if ($result->num_rows > 0) {
                      // output data of each row
                      while ($row = $result->fetch_assoc()) {
                        $book_id = $row['book_id'];
                        $book_title = $row['book_title'];
                        $author = $row['author'];
                        $ISBN = $row['ISBN'];
                        $genre = $row['genre'];
                        $publisher= $row['publisher'];
                        $status = $row['rental_status'];
                    ?>
                        <tr>
                        <td><?php echo $book_id ?></td>
                          <td><u><a href="viewBook.php?bookId=<?php echo $book_id ?>" style="color: blue"><?php echo $book_title ?></a></u> </td>
                          <td><?php echo $author ?></td>
                          <td><?php echo $ISBN ?></td>
                          <td><?php echo $genre ?></td>
                          <td><?php echo $publisher ?></td>
                          <td><?php echo $status ?></td>
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
                <h4>PCs</h4>
                  <thead>
                    <tr class="dark">
                    <th scope="col">PC ID</th>
                      <th scope="col">PC Name</th>
                       <th scope="col">Rental Status</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if ($result_pc->num_rows > 0) {
                      // output data of each row
                      while ($row = $result_pc->fetch_assoc()) {
                        $pcId = $row['pc_id'];
                        $pcName = $row['pc_name'];
                        $rentalStatus = $row['rental_status'];
                    ?>
                        <tr>
                        <td><?php echo $pcId ?>
                          <td><?php echo $pcName ?>
                          <td><?php echo $rentalStatus ?>
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
                <h4>Rooms</h4>
                <thead>
                    <tr class="dark">
                    <th scope="col">Room ID</th>
                      <th scope="col">Room Name</th>
                      <th scope="col">Room Location</th>
                      <th scope="col">Rental Status</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if ($result_room->num_rows > 0) {
                      // output data of each row
                      while ($row = $result_room->fetch_assoc()) {
                        $roomId = $row['room_id'];
                        $roomName = $row['room_name'];
                        $roomLocation = $row['room_location'];
                        $rentalStatus = $row['rental_status'];
                    ?>
                        <tr>
                        <td><?php echo $roomId ?>
                          <td><?php echo $roomName ?>
                          <td><?php echo $roomLocation ?>
                          <td><?php echo $rentalStatus ?>
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
          </div>
        </div>
        </div>
    </section>


  </main><!-- End #main -->

  <?php include 'common/footer.php'; ?>