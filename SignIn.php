<?php
require 'extra/_serverConnection.php';
$showError = false;
if($_SERVER["REQUEST_METHOD"]=='POST')
{
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `user` where `userName` = '$userName'" ;
    try
    {
        $result = mysqli_query($conn,$sql);
        $num = mysqli_num_rows($result);
        if($num==1)
        {
            while($row = mysqli_fetch_assoc($result))
            {
                
                if(password_verify($password,$row['password']))
                {
                    session_start();
                    $_SESSION['loggedIn']=true;
                    $_SESSION['username']=$userName;
                    header("location:newCrud.php");
                }
                else
                {
                   
                    $showError = "Invaild value";
                }
            }
           

        }
        else
        {
            $showError = "Invaild value";
        }

    }
    catch(mysqli_sql_exception $e)
    {
        echo"data did not found";
        
    }
   
   
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNotes</title>
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
     if( $showError)
     {
                  
         echo'  <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Holy guacamole! </strong>'.$showError.'
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
     }
    ?>
    
    <!-- alert  -->
    <!-- for form  -->
    <div class="container my-5" >
      
        <form style="display:flex;flex-direction:column;align-items:center;" action="/php/harry/loginSystem/SignIn.php" method = "post"> 
        <h3>Enter your info for sign In</h3>

            <div class="mb-3 col-md-6">
                <label for="userName" class="form-label">User Name</label>
                <input type="text" class="form-control" id="userName" name="userName" >
               
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label ">Password</label>
                <input type="password" class="form-control" id ="password" name = "password">
            </div>
            <button type="submit" class="btn btn-primary col-md-6">Sign In</button>
        </form>
    </div>
    <!-- for form  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
</body>

</html>