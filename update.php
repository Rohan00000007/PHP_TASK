<?php
include 'connect.php';

if(isset($_POST['updateid'])){
    $user_id=$_POST['updateid'];

    $sql="Select * from `crud` where id=$user_id";
    $result=mysqli_query($con,$sql);
    $response=array();
    while($row=mysqli_fetch_assoc($result)){
      $response=$row; 
    }
    echo json_encode($response);
}else{
    $response['status']=200;
    $response['message']="Invalid or data not found";
}
//update Query
if(isset($_POST['hiddendata'])){
    $uniqueid=$_POST['hiddendata'];
   $name=$_POST['updatename'];
    $email=$_POST['updatemail'];
    $mobile=$_POST['updatemobile'];
    $place=$_POST['updateplace'];
    $sql="update `crud` set name='$name',email='$email',mobile='$mobile',place='$place' where id=$uniqueid";

    $result=mysqli_query($con,$sql);
}
?>