<?php
$servername = "localhost";
$username = "root";
$password = "admin@123---";
$db = "****";
$conn = mysqli_connect($servername, $username, $password, $db);

if(isset($_POST["Import"])){
  
  $filename=$_FILES["file"]["tmp_name"];      
  if($_FILES["file"]["size"] > 0)
  {
      $file = fopen($filename, "r");
      while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
      {
          
          $sql = "INSERT into occupations_tbl (oc_name) values ('".$getData[0]."')";
          $result = mysqli_query($conn, $sql);
          if(!isset($result))
          {
                    echo "<script type=\"text/javascript\">
                            alert(\"Invalid File:Please Upload CSV File.\");
                            window.location = \"csv_import.php\"
                          </script>";       
          }
          else 
          {
                    echo "<script type=\"text/javascript\">
                        alert(\"CSV File has been successfully Imported.\");
                        window.location = \"csv_import.php\"
                    </script>";
          }
      }
  fclose($file); 
 }
}    
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" crossorigin="anonymous">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
   </head>
   <body>
      <div id="wrap">
         <div class="container">
            <div class="row">
               <form class="form-horizontal" action="csv_import.php" method="post" name="upload_excel" enctype="multipart/form-data">
                  <fieldset>
                     <!-- Form Name -->
                     <legend>Form Name</legend>
                     <!-- File Button -->
                     <div class="form-group">
                        <label class="col-md-4 control-label" for="filebutton">Select File</label>
                        <div class="col-md-4">
                           <input type="file" name="file" id="file" class="input-large">
                        </div>
                     </div>
                     <!-- Button -->
                     <div class="form-group">
                        <label class="col-md-4 control-label" for="singlebutton">Import data</label>
                        <div class="col-md-4">
                           <button type="submit" id="submit" name="Import" class="btn btn-primary button-loading" data-loading-text="Loading...">Import</button>
                        </div>
                     </div>
                  </fieldset>
               </form>
            </div>
            <?php
               //get_all_records();
               ?>
         </div>
      </div>
   </body>
</html>

