<?php
include("config/brand.php");
require("config/db.php");
?>

<?php

$title = $website_name." - Bank IFSC, MICR Codes, Contact Number, Address";
$keywords = "IFSC code, IFSC, IFSC Code Bank, Find IFSC Code, MICR Code, Bank Details, Indian Financial System Code, NEFT, RTGS, IMPS, National Electronic Funds Transfer, Immediate Payment Service, List of IFSC codes";
$desc = "Find IFSC, MICR Code, full address, contact details and other bank details of any bank across India. Search the whole banks details in just one click.";
$notIfsc = true;

if($_SERVER['REQUEST_METHOD'] == 'GET') {
  // Create Variable & get GET values
  $url = [];
  if(isset($_GET['url'])){
      $url = explode('/',$_GET['url']);
  }
  $isFound = false; //To know result
  $showDetails = false;
  
  if(isset($url[0]) && $url[0]=='ifsc'){
    $ifsc = $url[1];
    $sql = "SELECT * FROM data WHERE ifsc='$ifsc'";
    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    if($row){
        $isFound = $showDetails = true;
        $bank = $row['name'];
        $state = $row['adr4'];
        $city = $row['adr3'];
        $branch = $row['adr1'];
        $desc = $row['ifsc']." is IFSC code of the ".$row['name'].", ".$row['adr1']." Branch which is located in ".$row['adr5'];
        $title = $row['ifsc']." ".$row['adr1']." - IFSC Code details";
        $keywords = $row['ifsc'].", ".$row['name'].", ".$row['adr1'].", ".$row['adr3'].", ".$row['adr4']." IFSC Code, MICR Code, Bank Details";
        $notIfsc = false;
    }
    else{
        $isFound = $showDetails = false;
        $bank = 'All Bank';
    }
  }
  else{
    $bank = $state = $city = $branch = false;
    if(isset($url[0]))
        $bank = str_replace('_',' ', $url[0]);
    if(isset($url[1])){
        $state = str_replace('_', ' ', $url[1]);
    }
    if(isset($url[2])){
        $city = str_replace('_',' ', $url[2]);
    }
    if(isset($url[3])){
        $branch = str_replace('_', ' ', $url[3]);
    }
  }
 
  // Form Handler
  //variables for display lists
  $banklist = "<option>Select Bank</option>";
  $statelist = "<option>Select State</option>";
  $citylist = "<option>Select City</option>";
  $branchlist = "<option>Select Branch</option>";

  //For display Banklist if no attribute found
  if (!$bank) {
    $sql = "SELECT DISTINCT name FROM data ORDER BY name";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
      $banklist = $banklist."<option>".$row['name']."</option>";
    }
  }
  // For display State List
  elseif (!$state) {
    $banklist = "<option>".$bank."</option>";
    $sql = "SELECT DISTINCT adr4 FROM data WHERE name=\"$bank\" ORDER BY adr4";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
      $isFound = true;
      $statelist = $statelist."<option>".$row['adr4']."</option>";
    }
    $desc = $bank." IFSC Code, MICR Code, Other Banks details, Full List of IFSC codes of this bank in India";
    $title = $bank." - IFSC Code, MICR Code, Address, Contact Details";
    $keywords = $bank." IFSC Code, MICR Code, Bank Details, IFSC Code Bank, Find IFSC Code, MICR Code, Indian Financial System Code, NEFT, RTGS, IMPS, National Electronic Funds Transfer";
  }
  //For display City List
  elseif(!$city) {
    $banklist = "<option>".$bank."</option>";
    $statelist = "<option>".$state."</option>"; 
    $sql = "SELECT DISTINCT adr3 FROM data WHERE name='$bank' AND adr4='$state' ORDER BY adr3";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
      $isFound = true;
      $citylist = $citylist."<option>".$row['adr3']."</option>";
    }
    $desc = $bank." ".$state." IFSC Code, MICR Code, Other Banks details, List of all banks";
    $title = $bank." ".$state." - IFSC Code, MICR Code, Address, Contact Details";
    $keywords = $bank.", ".$state." IFSC Code, MICR Code, Bank Details, IFSC Code Bank, Find IFSC Code, MICR Code, Indian Financial System Code, NEFT, RTGS, IMPS";
  }
  //For display Branch list
  elseif(!$branch) {
    $banklist = "<option>".$bank."</option>";
    $statelist = "<option>".$state."</option>";
    $citylist = "<option>".$city."</option>";

    $sql = "SELECT DISTINCT adr1 FROM data WHERE name=\"$bank\" AND adr4=\"$state\" AND adr3=\"$city\" ORDER BY adr1";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
      $isFound = true;
      $branchlist = $branchlist."<option>".$row['adr1']."</option>";
    }
    $desc = $bank.", ".$city.", ".$state." IFSC Code, MICR Code, Other Banks details, List of all banks";
    $title = $bank." ".$city." - IFSC Code, MICR Code, Address, Contact Details";
    $keywords = $bank.", ".$city.", ".$state." IFSC Code, MICR Code, Bank Details, IFSC Code Bank, Find IFSC Code";
  }

  // Display Bank details at last
  else{
    $banklist = "<option>".$bank."</option>";
    $statelist = "<option>".$state."</option>";
    $citylist = "<option>".$city."</option>";
    $branchlist = "<option>".$branch."</option>";
    $sql = "SELECT * FROM data WHERE name=\"$bank\" AND adr4=\"$state\" AND adr3=\"$city\" AND adr1=\"$branch\"";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    if($row){
        $isFound = $showDetails = true;
        if($notIfsc){
            $desc = $bank.", ".$branch.", ".$city.", ".$state." IFSC Code, MICR Code, Other Banks details";
            $title = $bank." ".$branch." - IFSC Code, MICR Code, Address, Contact Details";
            $keywords = $bank.", ".$branch.", ".$city.", ".$state." IFSC Code, MICR Code, Bank Details, IFSC Code Bank, Find IFSC Code";
        }
    }
        else{
        echo "<script>alert('Wrong Input');</script>";
        $branchlist = "<option></option>";
    }
  }
  
  if($conn){
    mysqli_close($conn); 
  }
  
  if (!$bank)
    $bank = 'All Banks';
  else if(!$isFound ){
    $URL = $BASE_URL."errors/error_404.html";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    exit;
  }

 
}

?>


<!doctype html>
<html lang="en">

<head>

  <?php include_once 'include/head-meta-tag.php';?>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <!--Material bootstrap-->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="stylesheet" href="css/style.css" />

  <meta name="keywords" content="<?=$keywords?>" />
  <meta itemprop="description" content="<?=$desc?>" />
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

  <title><?=$title ?></title>


</head>

<body class="bg-light">

  <?php include_once './include/nav.php'; ?>

  <div class="container bg-white p-3">
    <div class="row">
      <div class="col-md-8 ">
        <h1 class="h3 card-header mb-3 indigo darken text-white">
          Find IFSC, MICR Code, Address of any Bank in India</h1>

        <div class="card mb-3">
          <div class="card-header indigo darken-2 text-white">
            <h2 class="h4"><?php if (!$city) {
          echo $bank .' - '.' '.$state." IFSC Code, MICR Code and Address";
        } else {
          echo $bank .' - '.' '.$city." IFSC Code, MICR Code and Address";
        } ?></h2>
          </div>

          <div class="card-body indigo text-white">
            <form>
              <div class="form-group">
                <label class="my-1 mr-2" for="selBank">Bank</label>
                <select class="custom-select my-1 mr-sm-2 indigo lighten-1 text-white" id="selBank" name="bank"
                  onchange="updateState(this.value)">
                  <?php echo $banklist ?>
                </select>
              </div>

              <div class="form-group">
                <label class="my-1 mr-2 " for="selState">State</label>
                <select class="custom-select my-1 mr-sm-2 indigo lighten-1 text-white" id="selState" name="state"
                  onchange="updateCity(this.value)">

                  <?php echo $statelist ?>


                </select>
              </div>


              <div class="form-group">
                <label class="my-1 mr-2" for="selCity">City</label>
                <select class="custom-select my-1 mr-sm-2 indigo lighten-1 text-white" id="selCity" name="city"
                  onchange="updateBranch(this.value)">
                  <?php echo $citylist ?>
                </select>
              </div>

              <div class="form-group">
                <label class="my-1 mr-2" for="selBranch">Branch</label>
                <select class="custom-select my-1 mr-sm-2 indigo lighten-1 text-white" id="selBranch" name="branch"
                  onchange="updateSubmit(this.value)">

                  <?php echo $branchlist ?>

                </select>
              </div>


              <a id="btn-submit" class="btn orange accent-3 btn-block">Submit</a>

            </form>
          </div>

        </div>

        <div class="card mb-3 text-white">

          <details open>
            <summary class="card-header indigo darken-2">How to Use</summary>

            <div class="card-body indigo">
              <ol>
                <li>
                  First Select your State where the Bank is located.
                </li>
                <li>
                  Wait until the Bank List will be loading.
                </li>
                <li>
                  When bank list appeared in Bank option then select the Bank Name from the list.
                </li>
                <li>
                  Then fill City and Branch in same fashion.
                </li>
                <li>
                  At last click on Submit Button, All details regarding to that bank will appear on
                  next page.
                </li>
              </ol>
            </div>
          </details>
        </div>
      </div>
      <!--HowtoUse End-->
      <div class="col-md-4 ">
        <div id="ifsc" class="card mb-3">
          <div class="card-header indigo darken-2 text-white">
            <h2 class="h4"> Search By IFSC Code</h2>
          </div>
          <div class="card-body indigo text-white">
            <form>

              <div class="form-group">
                <input type="text" class="form-control " id="ifsc-input" name="ifsc" placeholder="Enter IFSC Code"
                  oninput="searchValidation(this)" />
                <small class="form-text text-hint">*The Fifth digit of IFSC code is always
                  ZERO.</small>
                <div class="invalid-feedback">
                  Please Input Correct IFSC Code<br>
                  1) IFSC Code contain 11-digits.<br>
                  2) The Fifth digit of IFSC code is always ZERO.
                </div>
              </div>
              <a type="button" class="btn btn-outline-white btn-block disabled" id="btn-search">Search</a>
            </form>
          </div>
        </div>

        <div class="card mb-3 text-white">

          <details open>
            <summary class="card-header indigo darken-2">How to Use </summary>

            <div class="card-body indigo">
              <ol>
                <li>
                  Click on Text Box.
                </li>
                <li>
                  Enter IFSC Code for which you need the details.
                </li>
                <li>
                  If your IFSC Code matches with our records then Search Button will open to click.
                </li>
                <li>
                  Click on Search Button.
                </li>
                <li>
                  All details regarding to that IFSC Code will appear on next page.
                </li>
              </ol>
            </div>
          </details>
        </div>
      </div>
      <!--HowtoUse End-->
    </div>
    <div class="row">
      <div class="col-md-8 ">
        <!-- Card For Bank Details -->
        <?php 
            if($showDetails)
                include_once('include/bank-details.php');
        ?>


        <!-- Card Ends -->
        <hr />
        <div>
          <h4>What is IFSC Code?</h4>
          <p>
            Indian Financial System Code (IFSC) is an alphanumeric 11-digit code which is help to perform
            any
            electronic fund transfer from one bank account to another account in India. This is a unique
            code of
            any
            Bank in India so every Bank can be recognised uniquely by this code.<br>
            This code is used by Bank in three payment settlement system:
          </p>
          <ol>
            <li>Real Time Gross Settlement(RTGS)</li>
            <li>National Electronic Fund Transfer(NEFT)</li>
            <li>Immediate Payment Service(IMPS)</li>
          </ol>

          <hr />

          <h4>What is Format of IFSC Code?</h4>
          <p>
            IFSC is 11-digit alphanumeric code, each character is important for some identification of any
            Bank
            in
            India.<br />
            The first 4-digits are always an alphabet and represent the Bank Name (we can say it Bank
            Code).<br />
            The fifth digit is now reserved for any future used, so today it is always 0 (zero).<br />
            The last six-digits (may be digit or alphabet) represent the branch of a Bank.
          </p>
          <table class="mx-auto bg-white" style="width:300px; text-align: center" border="1">
            <tr class="">
              <th>1</th>
              <th>2</th>
              <th>3</th>
              <th>4</th>
              <th>5</th>
              <th>6</th>
              <th>7</th>
              <th>8</th>
              <th>9</th>
              <th>10</th>
              <th>11</th>
            </tr>
            <tr>
              <td colspan="4">Bank Code</td>
              <td>0</td>
              <td colspan="6">Branch Code</td>
            </tr>
          </table>



        </div>
      </div>
      <div class="col-md-4">
        <hr />
        <h4>Popular IFSC Codes</h4>
        <ul class="list-unstyled">
          <li>
            <a href="/STATE_BANK_OF_INDIA">State Bank of India IFSC Code</a>
          </li>
          <li>
            <a href="/HDFC_BANK">HDFC Bank IFSC Code</a>
          </li>
          <li>
            <a href="/BANK_OF_INDIA">Bank of India IFSC Code</a>
          </li>
          <li>
            <a href="/BANK_OF_BARODA">Bank of Baroda IFSC Code</a>
          </li>
        </ul>

      </div>
    </div>
  </div>




  <!-- container End-->
  <!-- Share Button -->
  <button class="fixed-bottom m-3 ml-auto orange accent-3 btn-floating" onclick="share(this)">
    <svg class="text-white" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-share-fill" fill="currentColor"
      xmlns="http://www.w3.org/2000/svg">
      <path fill-rule="evenodd"
        d="M12.024 3.797L4.499 7.56l-.448-.895 7.525-3.762.448.894zm-.448 9.3L4.051 9.335 4.5 8.44l7.525 3.763-.448.894z" />
      <path fill-rule="evenodd"
        d="M13.5 5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm0 11a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5zm-11-5.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
    </svg>
  </button>

  <?php include_once "include/footer.php"; ?>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
  </script>
  <script src="js/app.js"></script>

  <!-- Script For change navBar active state -->
  <script>
  e = document.getElementById('home');
  e.className += " active";
  </script>


</body>

</html>