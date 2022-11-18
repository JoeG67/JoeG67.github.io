<?php
require('dbConfig.php');
include("adminAuth.php");

$sql = "SELECT * FROM role";
$result = $db->query($sql);

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

  <title>Role List - Library Management System</title>
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

  <?php include('common/adminHeader.php'); ?>

  <?php include("common/adminSidebar.php"); ?>


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Role List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">Home</li>
          <li class="breadcrumb-item">Master Control</li>
          <li class="breadcrumb-item active">Role List</li>
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
                <a class="badge border-primary border-1 text-primary" style="float:right;" href="addRole.php"><u>Add Role</u></a>
                <br>
                <table class="table datatable table-hover">
                  <thead>
                    <tr>
                      <th scope="col" >Role ID</th>
                      <th scope="col" >Role Name</th>
                      <th scope="col" style="text-align:right;">Action</th>

                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    if ($result->num_rows > 0) {
                      // output data of each row
                      while ($row = $result->fetch_assoc()) {
                        $roleId = $row['role_id'];
                        $roleName = $row['role_name'];
                    ?>
                        <tr>
                          <td><?php echo $roleId ?>
                          <td><?php echo $roleName ?>

                          <td style="text-align:right;">
                            <a href="editRole.php?roleId=<?php echo $roleId?>"><i class="bx bxs-pencil"></i></a> |
                            <a href="deleteRole.php?roleId=<?php echo $roleId?>"><i class="ri-delete-bin-5-line"></i></a>
                          </td>
                          <?php } ?>
                        </tr>
                    <?php
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