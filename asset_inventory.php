<?php
  // Start PHP session
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Asset Inventory</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <style>
         h2{
         padding: 10px;
         margin-top: 25px;
         }
         .container {
         background-color: #e8e8e8;
         width:70%;
         margin-top: 75px;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <h2 class="text-center">Asset Inventory</h2>
         <form class="form-horizontal" name="myForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type='hidden' id='dat'/>
            <div class="form-group">
               <label class="control-label col-sm-4"
                  for="signed_out_to">Signed Out To: </label>
               <div class="col-sm-4">
                  <input class="form-control" type="text"
                     id="signed_out_to" name="signed_out_to" required>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-4"
                  for="location">Location: </label>
               <div class="col-sm-4">
                  <input class="form-control" type="location"
                     id="location" name="location">
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-4"
                  for="phone">Phone: </label>
               <div class="col-sm-4">
                  <input class="form-control" type="text"
                     id="phone" name="phone" required>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-4"
                  for="devide_id">Device ID: </label>
               <div class="col-sm-4">
                  <input class="form-control" type="text"
                     id="devide_id" name="device_id" required>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-4"
                  for="category">Category: </label>
               <div class="col-sm-4">
                  <input class="form-control" type="text"
                     id="category" name="category" required>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-4"
                  for="description">Description: </label>
               <div class="col-sm-4">
                  <textarea id="description" id="description" name="description" rows="5" class="form-control"></textarea>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-sm-4"
                  for="purchased_on">Purchased: </label>
               <div class="col-sm-4">
                  <input class="form-control" type="date"
                     id="purchased_on" name="purchased_on" required>
               </div>
            </div>
            <div class="form-group">
               <label class="control-label col-md-4"></label>
               <div class="col-md-4">
                  <input type="submit" value="Submit" name='submit' class="btn btn-sm btn-warning"/>
               </div>
            </div>
         </form>
      </div>
      <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
          // Condition to check wheather the device Id already existed or not 
          if (isset($_SESSION['arr'])) {         
            foreach ($_SESSION['arr'] as $value) {
              $array[] = json_decode($value, true);
            }
                 
            $device_ids = array();
            foreach ($array as $key => $value) {
              $devide_ids[] = $value['device_id'];
            }
         
            if (array_search($_POST['device_id'], $devide_ids) !== false) {
                echo "<script>alert('The device ID ". $_POST['device_id']." already exists, Do you want to overwrite it ? ')</script>";
            }  
          } 
         
          // Set session array and post form data as JSON 
          $_SESSION['arr'][] = json_encode(array(
               "signed_out_to" => $_POST['signed_out_to'],
               "location" => $_POST['location'],
               "phone" => $_POST['phone'],
               "device_id" => $_POST['device_id'],
               "category" => $_POST['category'],
               "description" => $_POST['description'],
               "purchased_on" => $_POST['purchased_on']
            ));
        }
           
        // Display last five entries
        if (count($_SESSION) > 0) {
           $final_array = array_slice($_SESSION['arr'], -5, 5);
           echo "<pre>";
           var_dump($final_array); 
        }   
      ?>
   </body>
</html>
