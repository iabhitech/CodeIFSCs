<?php 
$title = "$row[name] ($row[adr1]) IFSC Code, MICR, Contact Number, Address";
$link1 ="./".str_replace(' ','_',$bank);
$link2 ="./bank-list.php?branch=".str_replace(' ','+',$branch);
$link3 ="./bank-list.php?city=".str_replace(' ','+',$city);
?>
<a name="details"></a>
<div class=" my-4 mb-4" >
<hr/>
  
  <h2 id="shareText" class="h4"><?php echo $title; ?></h2>

  <div class="card bg-white p-2">
<table class="table table-borderless table-hover">
  <tbody>
    <tr>
      <th> Bank Name </th>
      <td><?php echo "<a class='text-primary h6' href='$link1'>".$row['name']."</a>"; ?></td>
    </tr>
  
    <tr>
      <th> Branch </th>
      <td><?php echo "<a class='text-primary h6' href='$link2'>".$row['adr1']."</a>"; ?></td>
    </tr>
     <tr>
      <th> IFSC Code </th>
      <td class="h5"><?php echo $row['ifsc']; ?> <!--<input class="cpy btn btn-primary btn-sm btn-block" type="button" value="Copy" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Copied" />-->
      
     
<input type="button" class="cpy btn btn-primary btn-sm btn-block" value="Copy Code" tabindex="0" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Click to Copy"/>
      
      </td>
    </tr>
   <tr>
     <tr>
      <th> MICR Code </th>
      <td class="h5"><?php 
        if($row['micr'] !=''){
        echo $row['micr'];
     echo ' <input type="button" class="cpy btn btn-primary btn-sm btn-block" value="Copy Code" data-container="body" tabindex="0" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Click to Copy"/>';
        }
        else{
          echo "NA";
        }
      ?>
      </td>
    
    </tr>
      <th>Address </th>
      <td><?php echo $row['adr5']; ?></td>
    </tr>
   <tr>
      <th> State </th>
      <td><?php echo $row['adr4']; ?></td>
    </tr>
   <tr>
      <th> District </th>
      <td><?php echo "<a class='text-primary h6' href='$link3'>".$row['adr3']."</a>"; ?></td>
    </tr>
   <tr>
      <th> Contact </th>
      <td><?php echo $row['contact']; ?></td>
    </tr>
  </tbody>
</table>
 </div>
</div>

<script>     
     // Scroll page
     if(window.location.href.search('#details') < 0)
      window.location = window.location+'#details';
 </script>
 
   