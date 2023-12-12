<?php
$servername = "localhost";
$username ="root";
$password ="";
$database = "user";
try{
    $conn = mysqli_connect($servername,$username,$password,$database);

}
catch(mysqli_sql_exception $e){
    die("Could not connect to the server because of this error->".mysqli_connect_error()) ;
}
?>