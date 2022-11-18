<?php
require('dbConfig.php');
include("adminAuth.php");

$target_dir = "img/user/";
$errorMsg = "";
$sql2 = "SELECT * FROM user WHERE user_id= '" . $_SESSION['user_id'] . "'";
$result2 = $db->query($sql2);

$sql_role = "SELECT *  FROM role";
$result_role = $db->query($sql_role);



if (isset($_POST['userId']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_POST['role'])) {
  if ($_POST['password'] == $_POST['confirmPassword']) {
    echo '<script>alert("Inside User ")</script>';
    $userId = $_POST['userId'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $icNumber = $_POST['icNumber'];
    $email = $_POST['email'];
    $address= $_POST['address'];
    


   $file_user = $userId . "_" . $firstName . "_" . $lastName . ".png";
    $file_size = $_FILES['profileImage']['size'];
    $file_tmp  = $_FILES['profileImage']['tmp_name'];
    $file_type = $_FILES['profileImage']['type'];
    $file_name = explode('.', $_FILES['profileImage']['name']);
    $file_ext = strtolower(end($file_name));

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
      $errors[] = "Please choose a proper file extension";
    }

    if ($file_size > 2097152) {
      $errors[] = 'File size must be exactly 2 MB';
    }

    if (empty($errors) == true) {
      move_uploaded_file($file_tmp, $target_dir . $file_user);
      echo "Successfully Uploaded";
    } else {
      print_r($errors);
    }


      $sql = "INSERT INTO user (user_id, password, role,  first_name, last_name, ic_number, email, address, photo_name, photo_path) 
							  VALUES ('$userId','$password','$role','$firstName','$lastName', '$icNumber', '$email','$address','$file_user','$target_dir')";
      echo $sql;
      if (mysqli_query($db, $sql)) {
        $errorMsg = "Succesfully added User ID";
        header("Location: userList.php");
      } else {
        $errorMsg = "Unable to Add User";
      }
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

  <title>Add User - Library Management System</title>
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
      <h1>Add User</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
          <li class="breadcrumb-item">Master Control</li>
          <li class="breadcrumb-item active">Add User</li>
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
          <form class="row g-3 needs-validation" novalidate id="addUser" name="addUser" method="post" action="" enctype="multipart/form-data">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Login Details</h5>

                <!-- Vertical Form -->
                <div class="row mb-3">
                  <label for="userId" class="col-sm-2 col-form-label">User ID</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" id="userId" name="userId" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="password" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-2">
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="confirmPassword" class="col-sm-2 col-form-label">Confirm Password</label>
                  <div class="col-sm-2">
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="role" class="col-sm-2 col-form-label">Role</label>
                  <div class="col-sm-2">
                  <select id="role" class="form-select" name="role" required>
                      <option selected></option>
                      <?php
                      if ($result_role->num_rows > 0) {
                        // output data of each row
                        while ($row = $result_role->fetch_assoc()) {
                          $roleId = $row['role_id'];
                          $roleName = $row['role_name'];
                      ?>
                          <option><?php echo $roleName ?></option>

                      <?php
                        }
                      } else {
                        echo "0 results";
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="card">
              <div class="card-body">
                <h5 class="card-title">User Details</h5>

                <!-- User Form -->
                <div class="row mb-3">
                <div class="row mb-3">
                  <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="icNumber" class="col-sm-2 col-form-label">IC No</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" id="icNumber" name="icNumber" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="profileImage" class="col-sm-2 col-form-label">Profile Image</label>
                  <div class="col-sm-5">
                    <label for="image">
                      <input class="form-control" id="profileImage" name="profileImage" type="file" />
                    </label>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="email" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-2">
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                </div>
              
                  <div class="row mb-3">
                    <label for="address" class="col-sm-2 col-form-label"> Address </label>
                    <div class="col-md-4">
                      <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                  </div>
                  
        </div>
      </div>
      </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
      </div>
      </form>
      <!-- End User Form -->
      </div>

  </main><!-- End #main -->

  <?php include 'common/footer.php'; ?>