<?php
	include("config/brand.php");
	$nameOK = 1;
	$emailOK = 1;
	$msgOK =1;
  $showAlert = false;
  $name = "";
  $email = "";
  $msg = "";
  $response = '<div class="alert alert-danger" role="alert">
  Sorry! We are facing some problem.</div>';
  
  // contact us not working now
  {
    $response = '<div class="alert alert-warning" role="alert">
    This Contact Page is disable for now, You can write us on info@codeifsc.in
  </div>';
    $showAlert = true;
  }

	if($_SERVER['REQUEST_METHOD']=="POST")
	{
	  $name = $_POST['name'];
	  $email = $_POST['email'];
	  $msg = $_POST['msg'];
	  
	  if($msg == '')
	    $msgOK = 0;
	  if($email == '')
	    $emailOK = 0;
	  if($name == '')
	    $nameOK = 0;
	  if($name && $email && $msg)
	  {
      $showAlert = true;
	    $name = $email = $msg = '';
    //   $response = '<div class="alert alert-success" role="alert">
    //   Thanks! Your query has been submitted.
    // </div>';
	  }
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <?php echo '<base href='.$BASE_URL.'>'; ?>
<!-- Chrome, Firefox OS and Opera --> <meta name="theme-color" content="#3f51b5"> 
<!-- Windows Phone --> <meta name="msapplication-navbutton-color" content="#3f51b5"> 
<!-- iOS Safari --> <meta name="apple-mobile-web-app-status-bar-style" content="#3f51b5">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
   <link rel="stylesheet" href="css/mdb.min.css">

<title><?php echo "Contact Us - ".$website_name; ?> </title>
    

  </head>
  <body class="bg-light">
    
    
<?php include 'include/nav.php'; ?>
<?php 
if($showAlert == true)
{
echo $response;
}
?>
<div class="container my-3" >
  
<div class="card p-1">
  <h1 class="h4 card-header bg-white">Contact Us</h1>
<form method="post" action="contact-us" class="card-body">
  <div class="form-group">
    <label for="name">Name*</label>
    <input type="text" id="name" name="name" placeholder="Enter Your Name" <?php echo " value='$name' "; 
   if($nameOK ==0){echo 'class="form-control is-invalid"';}else{echo 'class="form-control"';}
    ?>>
    <div class="invalid-feedback">
      Please enter your Name
    </div>
  </div>
  <div class="form-group">
    <label for="email">Email address*</label>
    <input type="email" id="email" name="email" placeholder="name@example.com"<?php echo " value='$email' ";
   if($emailOK==0){echo 'class="form-control is-invalid"';}else{echo 'class="form-control"';}
    ?>>
    <small id="emailHelp" class="form-text text-muted ">We'll never share your email with anyone else.</small>
    <div class="invalid-feedback">
      Please enter Email Address
    </div>
  </div>
  
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Massage*</label>
    <textarea id="msgText" name="msg" rows="4"  <?php 
     if($msgOK==0){echo 'class="form-control is-invalid">';}else{echo 'class="form-control">';echo$msg;}
     ?></textarea>
    <div class="invalid-feedback">
      Please enter a message in the textarea
    </div>
  </div>
  <button type="submit" class="btn btn-primary btn-block">Submit</button>
</form>
    
</div>
  
</div>



 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
    <script>
     e = document.getElementById('contact');
     e.className += " active";
   </script>
   
   
<?php include "./include/footer.php";?>

</body>
</html>