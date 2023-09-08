<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title >Task Management</title>
    <!-- bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <!-- <body> -->
  <body style="background-color:powderblue;">
<!-- Modal -->
<div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title fs-5" id="exampleModalLabel">New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <!-- form  -->
      <div class="form-group">
    <label for="completename">Name</label> 
    <input type="text" class="form-control" id="completename" placeholder="Enter your name">
      </div>
      <div class="form-group">
    <label for="completemail">Email</label> 
    <input type="email" class="form-control" id="completemail" placeholder="Enter your email iD">
      </div>
      <div class="form-group">
    <label for="completemobile">Mobile</label> 
    <input type="text" class="form-control" id="completemobile" placeholder="Enter your mobile no">
      </div>
      <div class="form-group">
    <label for="completeplace">Place</label> 
    <input type="text" class="form-control" id="completeplace" placeholder="Enter your place">
      </div>
       
        <!-- Button trigger modal -->
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-dark" onclick="adduser()">Submit</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    
        </div>
    </div>
  </div>
</div>
<!-- update modal -->
<div class="modal fade" id="updateModal" tabindex="-1" roll="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title fs-5" id="exampleModalLabel">Update details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <!-- form  -->
      <div class="form-group">
    <label for="updatename">Name</label> 
    <input type="text" class="form-control" id="updatename" placeholder="Enter your name">
      </div>
      <div class="form-group">
    <label for="updatemail">Email</label> 
    <input type="email" class="form-control" id="updatemail" placeholder="Enter your email iD">
      </div>
      <div class="form-group">
    <label for="updatemobile">Mobile</label> 
    <input type="text" class="form-control" id="updatemobile" placeholder="Enter your mobile no">
      </div>
      <div class="form-group">
    <label for="updateplace">Place</label> 
    <input type="text" class="form-control" id="updateplace" placeholder="Enter your place">
      </div>
        
        <!-- Button trigger modal -->
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-dark" onclick="updateDetails()">Update</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
         <input type="hidden" id="hiddendata"> 
        </div>
    </div>
  </div>
</div>
    <div class="container my-3">
    <h1 class="text-center"><em>Task Management</em> </h1>
    <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal">
  Add New Users 
</button>
<!-- div -->
<div id="displayDataTable"></div>

     <!-- bootstrap javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- java script -->
   <script>

    $(document).ready(function(){
      displayData();
    });

    //display function
function displayData(){
  var displayData="true";
  $.ajax({
    url:"display.php",
    type:'post',
    data:{
      displaySend:displayData
    },
    success:function(data,status){
     $('#displayDataTable').html(data);

    }
  });
}


    function adduser(){
var nameAdd=$('#completename').val() ;
var emailAdd=$('#completemail').val() ;
var mobileAdd=$('#completemobile').val() ;
var placeAdd=$('#completeplace').val() ;
  // ajax

$.ajax({
  url:"insert.php",
  type:'post',
  data:{
    nameSend:nameAdd,
    emailSend:emailAdd,
    mobileSend:mobileAdd,
    placeSend:placeAdd
},
  success:function(data,status){
    //function to display data;
   $('#completeModal').modal('hide');
    displayData();
  }
});
    }
//delete record

function DeleteUser(deleteid){
  $.ajax({
    url:"delete.php",
    type:'post',
    data:{
      deletesend:deleteid
    },
    success:function(data,status){
      displayData();
    }
  });
}

// update record
 function GetDetails(updateid){
$('#hiddendata').val(updateid);

$.post("update.php",{updateid:updateid},function(data,status){
  var userid=JSON.parse(data);
$('#updatename').val(userid.name);
$('#updatemail').val(userid.email);
$('#updatemobile').val(userid.mobile);
$('#updateplace').val(userid.place);
});

 $('#updateModal').modal("show");
 }
// onclick updateDetails event function
function updateDetails(){
var updatename=$('#updatename').val() ;
var updatemail=$('#updatemail').val() ;
var updatemobile=$('#updatemobile').val() ;
var updateplace=$('#updateplace').val() ;
var hiddendata=$('#hiddendata').val();

$.post("update.php",{
  updatename:updatename,
  updatemail:updatemail,
  updatemobile:updatemobile,
  updateplace:updateplace,
  hiddendata:hiddendata
},
function(data,status){
 $('#updateModal').modal('hide');
displayData();
});
}
   </script> 
  </body>
</html>