<?php
// Include config file
require_once "lidhje.php";
 
// Define variables and initialize with empty values
$emri = $mbiemri = $email = "";
$emri_err = $mbiemri_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_emri = trim($_POST["Emri"]);
    if(empty($input_emri)){
        $emri_err = "Shkruaj emrin.";
    } elseif(!filter_var($input_emri, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Shkruaj nje emer tjeter.";
    } else{
        $name = $input_emri;
    }
    
    // Validate address
    $input_mbiemri = trim($_POST["Mbiemri"]);
    if(empty($input_mbiemri)){
        $mbiemri_err = "Shkruaj mbiemrin.";     
    } else{
        $mbiemri = $input_mbiemri;
    }
    
    // Validate salary
    $input_email = trim($_POST["Email"]);
    if(empty($input_email)){
        $email_err = "Shkruaj emailin.";     
    } else{
        $email = $input_email;
    }
    
    // Check input errors before inserting in database
    if(empty($emri_err) && empty($mbiemri_err) && empty($email_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO users (Emri, Mbiemri, Email) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);
            
            // Set parameters
            $param_name = $emri;
            $param_address = $mbiemri;
            $param_salary = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Emri</label>
                            <input type="text" name="Emri" class="form-control <?php echo (!empty($emri_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $emri; ?>">
                            <span class="invalid-feedback"><?php echo $emri_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Mbiemri</label>
                            <input type="text" name="Mbiemri" class="form-control <?php echo (!empty($mbiemri_err)) ? 'is-invalid' : ''; ?>"><?php echo $mbiemri; ?>
                            <span class="invalid-feedback"><?php echo $mbiemri_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="Email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="users.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>