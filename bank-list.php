<?php include("config/brand.php");
include("config/db.php"); 

$city = $_GET['city'];
$branch = $_GET['branch'];
$sno = 0;
$isFound = 0;
 
 if($city && !$branch){
  $title = "Details of all Banks located in '$city'";
  $sql = "SELECT * FROM data WHERE adr3='$city'";
  $result = mysqli_query($conn, $sql);
  $isFound = mysqli_affected_rows($conn);
  $thead = '<thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Bank</th>
      <th scope="col">Branch</th>
      <th scope="col">State</th>
    </tr>
  </thead>';
  $tbody = '<tbody>';
   
   while($row = mysqli_fetch_assoc($result))
  	{
  	   //str_replace(" ","+",$bank);
  	   $bank = str_replace(' ','_',$row['name']);
  	   $state = str_replace(' ','_',$row['adr4']);
  	   $city = str_replace(' ','_',$row['adr3']);
  	   $branch = str_replace(' ','_',$row['adr1']);
  	   
  	   $link = "./$bank/$state/$city/$branch/#details";
  	   
       $tbody = $tbody."<tr>"."<td>".++$sno."</td>"."<td>"
       ."<a class='text-primary' href='$link'>".$row['name']."</a>"
       ."</td>"."<td>".$row['adr1']."</td>"."<td>".$row['adr4']."</td>"."</tr>";
  	}
  	$tbody = $tbody.'</tbody>';
  	
 }
 elseif($branch && !$city){
  $title = "Details of all Banks located in '$branch'";
  $sql = "SELECT * FROM data WHERE adr1='$branch'";
  $result = mysqli_query($conn, $sql);
  $isFound = mysqli_affected_rows($conn);
  $thead = '<thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Bank</th>
      <th scope="col">District</th>
      <th scope="col">State</th>
    </tr>
  </thead>';
  $tbody = '<tbody>';
   
   while($row = mysqli_fetch_assoc($result))
  	{
  	   
  	   $bank = str_replace(' ','_',$row['name']);
  	   $state = str_replace(' ','_',$row['adr4']);
  	   $city = str_replace(' ','_',$row['adr3']);
  	   $branch = str_replace(' ','_',$row['adr1']);
  	   
      //  $link = "./bank-details.php?bank=$bank&state=$state&city=$city&branch=$branch";
       $link = "./$bank/$state/$city/$branch/#details";
  	   
       $tbody = $tbody."<tr>"."<td>".++$sno."</td>"."<td>"
       ."<a class='text-primary' href='$link'>".$row['name']."</a>"
       ."</td>"."<td>".$row['adr3']."</td>"."<td>".$row['adr4']."</td>"."</tr>";
  	}
  	$tbody = $tbody.'</tbody>';
  	
 }

 if($isFound==0){
   // 404 error
   header('location: ./');
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
<!-- iOS Safari --> <meta name="apple-mobile-web-app-status-bar-style" content="#343a40">
    
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    
      <link rel="stylesheet" href="css/style.css"/>
  <!--Material bootstrap-->
  <link rel="stylesheet" href="css/mdb.min.css">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
   
<title><?php echo $website_name; ?> - Bank IFSC, MICR Codes, Contact NUmber, Address</title>
    

  </head>
  <body>

<?php include './include/nav.php'; ?>


<div class="container">
  
<h1 id="shareText" class="h4 mt-2"><?php echo $title; ?></h1>
<div class="row">
  <div class="col-md-8">
  <table id="mytable" class="small table">
      <?php echo $thead;
          echo $tbody;?>
  </table>
  </div>
</div>

</div>

  <button class="fixed-bottom m-3 ml-auto orange accent-3 btn-floating" onclick="share(this)">
    <svg class="text-white" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-share-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M12.024 3.797L4.499 7.56l-.448-.895 7.525-3.762.448.894zm-.448 9.3L4.051 9.335 4.5 8.44l7.525 3.763-.448.894z"/>
  <path fill-rule="evenodd" d="M13.5 5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm0 11a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm-11-5.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
</svg>
  </button>
  

 <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


   <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    

<script>
$(document).ready(function() {
   $('#mytable').DataTable({
      "scrollX": true
   });
} );
</script>

 <!-- Share Button -->
  <script>
  function share(e){
    shareTitle = "Find IFSC, MICR Code, Address of any Bank in India\n";
    shareUrl = window.location.href;
    try {
       t= document.getElementById('shareText').innerHTML;
       shareTitle += "Here is your "+t+"\n";
     } catch (e) {}
   
if (navigator.share) {
    navigator.share({
        url: shareUrl, title: shareTitle, text: shareTitle
    }).then(function() {
        ga('send', 'event', 'share', 'success');
    }, function(error) {
        ga('send', 'event', 'share', 'error', error);
    });
}
    
  }
  </script>
<?php include './include/footer.php'; ?>

  </body>
</html>