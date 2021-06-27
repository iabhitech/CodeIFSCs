<?php
include("config/brand.php");
$nameOK = 1;
$emailOK = 1;
$msgOK = 1;
$showAlert = false;
$name = "";
$email = "";
$msg = "";
$response = '<div class="alert alert-danger" role="alert">
  Sorry! We are facing some problem.</div>';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $token = rand(100, 10000);
  $_SESSION['token'] = $token;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $msg = $_POST['msg'];
  $userToken = $_POST['token'];
  if ($msg == '')
    $msgOK = 0;
  if ($email == '')
    $emailOK = 0;
  if ($name == '')
    $nameOK = 0;

  if (!isset($_SESSION['token']) || $userToken != $_SESSION['token']) {
    $response = '<div class="alert alert-warning" role="alert">
      Your Query is already submitted! Please wait we will respond you soon.</div>';
    $showAlert = true;
    $_POST = array();
    $token = 0;
  } else if ($name && $email && $msg) {
    session_destroy();
    $token = 0;
    $showAlert = true;

    require_once 'config/mail.php';
    $subject = "CodeIFSCs - Contact Us Page";
    $formcontent = " Name: $name \n Email: $email \n Message: $msg";

    $res = mail($to, $subject, $formcontent);
    $res = true;
    if ($res) {
      $name = $email = $msg = '';
      $response = '<div class="alert alert-success" role="alert">
            Thanks! Your query has been submitted.</div>';
    } else {
      $response = '<div class="alert alert-danger" role="alert">
            Sorry! An Error occurred while submitting you query.</div>';
    }
  } else {
    $token = $userToken;
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <?php include 'include/head-meta-tag.php'; ?>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <link rel="stylesheet" href="css/mdb.min.css">

  <title><?php echo "Contact Us - " . $website_name; ?> </title>


</head>

<body class="bg-light">


  <?php include 'include/nav.php'; ?>
  <?php
  if ($showAlert == true) {
    echo $response;
  }
  ?>
  <div class="container my-3">

    <div class="card p-1">
      <h1 class="h4 card-header bg-white">Contact Us</h1>
      <form method="post" action="contact-us" class="card-body">
        <input type="hidden" name="token" value='<?= $token ?>'>
        <div class="form-group">
          <label for="name">Name*</label>
          <input type="text" id="name" name="name" placeholder="Enter Your Name" <?php echo " value='$name' ";
                                                                                  if ($nameOK == 0) {
                                                                                    echo 'class="form-control is-invalid"';
                                                                                  } else {
                                                                                    echo 'class="form-control"';
                                                                                  }
                                                                                  ?>>
          <div class="invalid-feedback">
            Please enter your Name
          </div>
        </div>
        <div class="form-group">
          <label for="email">Email address*</label>
          <input type="email" id="email" name="email" placeholder="name@example.com" <?php echo " value='$email' ";
                                                                                      if ($emailOK == 0) {
                                                                                        echo 'class="form-control is-invalid"';
                                                                                      } else {
                                                                                        echo 'class="form-control"';
                                                                                      }
                                                                                      ?>>
          <small id="emailHelp" class="form-text text-muted ">We'll never share your email with anyone else.</small>
          <div class="invalid-feedback">
            Please enter Email Address
          </div>
        </div>

        <div class="form-group">
          <label for="exampleFormControlTextarea1">Massage*</label>
          <textarea id="msgText" name="msg" rows="4" <?php
                                                      if ($msgOK == 0) {
                                                        echo 'class="form-control is-invalid">';
                                                      } else {
                                                        echo 'class="form-control">';
                                                        echo $msg;
                                                      }
                                                      ?></textarea>
    <div class="invalid-feedback">
      Please enter a message in the textarea
    </div>
  </div>
  <button type="submit" class="btn btn-primary btn-block">Submit</button>
</form>
    
</div>
  
</div>

<?php include "./include/footer.php"; ?>




 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    <script>
     e = document.getElementById('contact');
     e.className += " active";
   </script>
   
   

</body>
</html>