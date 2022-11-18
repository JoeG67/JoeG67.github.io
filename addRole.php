<?php
require('dbConfig.php');
include("adminAuth.php");


$sql2 = "SELECT * FROM user WHERE user_id= '" . $_SESSION['user_id'] . "'";
$result2 = $db->query($sql2);

$errorMsg = "";

if (isset($_POST['roleName']) ) {
    echo '<script>alert("Inside Role ")</script>';
    $roleName = $_POST['roleName'];
    

  $sql = "INSERT INTO role (role_name) 
						  VALUES ('$roleName')";
  if (mysqli_query($db, $sql)) {
    $errorMsg = "Succesfully added role";
    header("Location: roleList.php");
  } else {
    $errorMsg = "Unable to Add Role";
  }
}
mysqli_close($db);
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

  <title>Add Role - Library Management System</title>
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

<?php include ('common/adminHeader.php');?>
<?php include ('common/adminSidebar.php');?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Add Role</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Master Control</li>
          <li class="breadcrumb-item active">Add Role</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Add Role</h5>

              <!-- Horizontal Form -->
              <form class="row g-3 needs-validation" novalidate id="addRole" name="addRole" method="post" action="addRole.php" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="roleName" class="col-sm-2 col-form-label">Role Name</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="roleName" name="roleName" required>
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

        </div>
      </div>
    </section>

  </main><!-- End #main -->


  <?php include 'common/footer.php';?>