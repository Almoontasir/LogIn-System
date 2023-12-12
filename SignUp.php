<?php
require 'extra/_serverConnection.php';
$insert =false;
$match = false;
if($_SERVER["REQUEST_METHOD"]=='POST')
{
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $copassword = $_POST['copassword'];
    $sql = "SELECT * FROM `user` where `userName` = '$userName'";
    try
    {
        $result = mysqli_query($conn,$sql);
    }
    catch(mysqli_sql_exception $e)
    {
        echo"data did not found";
        
    }
    $num = mysqli_num_rows($result);
    if($num>0)
    {
        $match ="User Name already exist";
    }
    else if($password==$copassword)
    {
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO `user` (`userName`, `password`) VALUES ('$userName', '$hash')";
        try{
            mysqli_query($conn,$sql);
            $insert = "Account succesfully created";

        }
        catch(mysqli_sql_exception $e)
        {
            echo "conuld not insert data due to this error->".mysqli_error();
        }
    }
    else
    {
        $match = "Password did not match";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNodes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <!-- for nav bar  -->
    <?php
      require 'extra/_navbar.php';
      ?>
    <!-- for nav bar  -->
    <!-- alert  -->
    <?php
     if( $insert)
     {
                  
         echo'  <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Holy guacamole! </strong>'.$insert.'
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
     }
    ?>
    <?php
     if( $match)
     {
                   echo'  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Sorry!</strong>'.$match.'
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
     }
    ?>
    <!-- alert  -->
    <!-- for form  -->
    <div class="container my-5" >
      
        <form style="display:flex;flex-direction:column;align-items:center;" action="/php/harry/loginSystem/SignUp.php" method = "post"> 
        <h3>Enter your info</h3>

            <div class="mb-3 col-md-6">
                <label for="userName" class="form-label" >User Name</label>
                <input type="text" class="form-control" id="userName" name="userName" maxlength = "11">
               
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label ">Password</label>
                <input type="password" class="form-control" id ="password" name = "password" maxlength = "30">
            </div>
            <div class="mb-3 col-md-6">
                <label for="copassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="copassword" name = "copassword" aria-describedby="copasswordHelp"maxlength = "30">
                <div id="copasswordHelp" class="form-text">Password must match</div>
            </div>
            <button type="submit" class="btn btn-primary col-md-6">Sign Up</button>
        </form>
    </div>
    <!-- for form  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>