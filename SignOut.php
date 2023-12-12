<?php
require "extra/_navbar.php";
?>
<!-- session log out  -->
<?php
session_start();
echo var_dump(isset($_SESSION['loggedIn']));


    session_unset();
    session_destroy();
    // echo "You have been log out succfully";
    header("location:SignIn.php");

?>