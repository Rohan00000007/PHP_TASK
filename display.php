<?php

use function PHPSTORM_META\sql_injection_subst;

include 'connect.php';
if(isset($_POST['displaySend'])){
   $table='<table class="table">
   <thead class="table-danger">
     <tr>
       <th scope="col">Sl. No</th>
       <th scope="col">Name</th>
       <th scope="col">Email</th>
       <th scope="col">Mobile</th>
       <th scope="col">Place</th>
       <th scope="col">Operations</th>
     </tr>
   </thead>' ;

   $sql="Select * from `crud`";
   $result=mysqli_query($con,$sql);
   $number=1;
   while($row=mysqli_fetch_assoc($result)){
    $id=$row['id'];
    $name=$row['name'];
    $email=$row['email'];
    $mobile=$row['mobile'];
    $place=$row['place'];
    
    $table.='<tr>
    <th scope="row">'.$number.'</th>
    <td>'.$name.'</td>
    <td>'.$email.'</td>
    <td>'.$mobile.'</td>
    <td>'.$place.'</td>
    <td>
    <button class="btn btn-dark my-3"onclick="GetDetails('.$id.')">Update</button>
    <button class="btn btn-danger my-3" onclick="DeleteUser('.$id.')">Delete</button>
</td>
  </tr>
  <tr>';
  $number++;
   }
   $table.='</table>';
   echo $table;
}
?>