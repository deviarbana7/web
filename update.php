<?php
// Include config file
require_once "lidhje.php";
 
// Define variables and initialize with empty values
$emri = $mbiemri = $email = "";
$emri_err = $mbiemri_err = $email_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["ID"]) && !empty($_POST["ID"])){
    // Get hidden input value
    $id = $_POST["ID"];
    
    // Validate name
    $input_emri = trim($_POST["Emri"]);
    if(empty($input_emri)){
        $emri_err = "Vendos emrin.";
    } elseif(!filter_var($input_emri, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $emri_err = "Vendos nje emer tjeter.";
    } else{
        $emri = $input_emri;
    }
    
    // Validate address address
    $input_mbiemri = trim($_POST["Mbiemri"]);
    if(empty($input_mbiemri)){
        $mbiemri_err = "Shkruaj mbiemrin.";     
    } else{
        $mbiemri = $input_mbiemri;
    }
    
    // Validate salary
    $input_email = trim($_POST["Email"]);
    if(empty($input_email)){
        $email_err = "Shkruaj nje email";     
    } else{
        $email = $input_email;
    }
    
    // Check input errors before inserting in database
    if(empty($emri_err) && empty($mbiemri_err) && empty($email_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET Emri=?, Mbiemri=?, Email=? WHERE ID=?";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_salary, $param_id);
            
            // Set parameters
            $param_name = $emri;
            $param_address = $mbiemri;
            $param_salary = $email;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($con);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
        // Get URL parameter
        $id =  trim($_GET["ID"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM users WHERE ID = ?";
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $emri = $row["Emri"];
                    $mbiemri = $row["Mbiemri"];
                    $email = $row["Email"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($con);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Emri</label>
                            <input type="text" name="Emri" class="form-control <?php echo (!empty($emri_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $emri; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Mbiemri</label>
                            <input type="text" name="Mbiemri" class="form-control <?php echo (!empty($mbiemri_err)) ? 'is-invalid' : ''; ?>" value= "<?php echo $mbiemri; ?>"
                            <span class="invalid-feedback"><?php echo $mbiemri_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        <input type="hidden" name="ID" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>