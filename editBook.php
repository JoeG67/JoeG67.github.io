<?php
require('dbConfig.php');
include("adminAuth.php");
$bookId = $_GET['bookId'];


$sql = "SELECT * FROM book WHERE book_id ='" . $bookId . "'";
$result = $db->query($sql);

$sql2 = "SELECT * FROM user WHERE user_id= '" . $_SESSION['user_id'] . "'";
$result2 = $db->query($sql2);

$sql_auth = "SELECT *  FROM author";
$result_auth = $db->query($sql_auth);

$sql_pub = "SELECT *  FROM publisher";
$result_pub = $db->query($sql_pub);



$book_cover = "";
$errorMsg = "";
$target_dir = "img/cover/";

while ($row = mysqli_fetch_assoc($result)) {
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

  <title>Edit Book - Library Management System</title>
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
 
  <?php include('common/adminHeader.php'); ?>
  <?php include('common/adminSidebar.php'); ?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Book</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Book</li>
          <li class="breadcrumb-item active">Edit Book</li>
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
          <form class="row g-3 needs-validation" novalidate id="updateBook" name="updateBook" method="post" action="updateBook.php?bookId=<?php echo $bookId ?>" enctype="multipart/form-data">

          <div class="card">
              <div class="card-body">
                <h5 class="card-title">Book Details</h5>

                <!-- Vertical Form -->
                <div class="row mb-3">
                  <label for="bookTitle" class="col-sm-2 col-form-label">Book Title</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="bookTitle" name="bookTitle" value="<?php echo $bookTitle?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="author" class="col-sm-2 col-form-label">Author</label>
                  <div class="col-sm-2">
                  <select id="author" class="form-select" name="author">
                      <option selected></option>
                      <?php
                      if ($result_auth->num_rows > 0) {
                        // output data of each row
                        while ($row = $result_auth->fetch_assoc()) {
                          $authorId = $row['author_id'];
                          $s_author = $row['author_name'];
                          
                          ?>
                          <option <?php if ($s_author == $author) { ?> selected="selected" <?php } ?>><?php echo $s_author ?></option>
                     
                         
                     <?php }
                   } ?>
                 </select>
                    </div>
                </div>
                <div class="row mb-3">
                  <label for="publisher" class="col-sm-2 col-form-label">Publisher</label>
                  <div class="col-sm-2">
                  <select id="publisher" class="form-select" name="publisher">
                      <option selected></option>
                      <?php
                      if ($result_pub->num_rows > 0) {
                        // output data of each row
                        while ($row = $result_pub->fetch_assoc()) {
                          $publisherId = $row['publisher_id'];
                          $s_publisher = $row['publisher_name'];
                          
                          ?>
                          <option <?php if ($s_publisher == $publisher) { ?> selected="selected" <?php } ?>><?php echo $s_publisher ?></option>
                     
                         
                     <?php }
                   } ?>
                 </select>
                    </div>
                </div>
             
                <div class="row mb-3">
                  <label for="ISBN" class="col-sm-2 col-form-label">ISBN</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="ISBN" name="ISBN" placeholder="978-3-16-148410-0" pattern="[0-9]{3}-[0-9]{1}-[0-9]{2}-[0-9]{6}-[0-9]{1}" value="<?php echo $ISBN?>">
                  </div>
                </div>
                
                <!--div class="row mb-3">
                  <label for="bookCover" class="col-sm-2 col-form-label">Book Cover</label>
                  <div class="col-sm-5">
                    <label for="image">
                    <input type="file" class="form-control" id="bookCover" name="bookCover" value="<?php echo $book_cover ?>" />
                    </label>
                  </div>
                </div-->
               <div class="row mb-3">
                  <label for="releaseYear" class="col-sm-2 col-form-label">Release Year</label>
                  <div class="col-sm-2">
                    <input type="date" class="form-control" id="releaseYear" name="releaseYear" value="<?php echo $releaseYear?>">
                  </div>
                </div> 
                <div class="row mb-3">
                  <label for="genre" class="col-sm-2 col-form-label">Genre</label>
                  <div class="col-sm-3">
                    <input type="genre" class="form-control" id="genre" name="genre" value="<?php echo $genre?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="rentalStatus" class="col-sm-2 col-form-label">Rental Status</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="rentalStatus" name="rentalStatus" value="<?php echo $rentalStatus?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="synopsis" class="col-sm-2 col-form-label">Synopsis</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="synopsis" name="synopsis" value="<?php echo $synopsis?>">
                  </div>
                </div>
            </div>
          </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
      </form>

      <!-- End Book Form -->
      </div-->

  </main><!-- End #main -->

  <?php include 'common/footer.php'; ?>