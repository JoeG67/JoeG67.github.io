<?php
require('dbConfig.php');
include("adminAuth.php");

$sql = "SELECT * FROM book ";
$result = $db->query($sql);
$role_action = "";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Book List - Library Management System</title>
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
      <h1>Book List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="userPage.php">Home</a></li>
          <li class="breadcrumb-item">Books</li>
          <li class="breadcrumb-item active">Book List</li>
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
                <a class="badge border-primary border-1 text-primary" style="float:right;" href="addBook.php"><u>Add Book</u></a>
                <br>
                <table class="table datatable table-hover">
                  <thead>
                    <tr class="dark">
                      <th scope="col">Book ID</th>
                      <th scope="col">Book Title</th>
                      <th scope="col">Author</th>
                      <th scope="col">ISBN</th>
                      <th scope="col">Genre</th>
                      <th scope="col">Publisher</th>
                      <th scope="col">Status</th>
                      <th scope="col" style="text-align:center;">Action</th>
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
                          <td style="text-align:center;">
                            <a href="editBook.php?bookId=<?php echo $book_id?>"><i class="bx bxs-pencil"></i></a> |
                            <a href="deleteBook.php?bookId=<?php echo $book_id?>"><i class="ri-delete-bin-5-line"></i></a>
                          </td>
                        </tr>
                    <?php

                      }
                    } else {
                      echo "0 results";
                    }
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