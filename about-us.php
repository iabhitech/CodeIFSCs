<?php
	include("config/brand.php");
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
    <link rel="stylesheet" href="css/style.css" />

<title><?php echo "About - ".$website_name; ?> </title>
    

  </head>
  <body class="bg-light">
    
    
<?php include './include/nav.php'; ?>

<div class="container bg-white p-3" >
  
  <h1 class="h4">About Us</h1>
  <p>Thanks for Visit our Site.<br>We provide all details of all Banks located in India. We provide IFSC code, MICR Code, Address, Contact Number etc. If you want any help please goto our Contact Us Page.</p>
    
</div>



 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
   <script>
     e = document.getElementById('about');
     e.className += " active";
   </script>
   
   
<?php include "./include/footer.php";?>
</body>
</html>