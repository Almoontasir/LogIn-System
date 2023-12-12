<!-- php  -->
<?php
session_start();

if(!isset($_SESSION['loggedIn']))
{
    header("location: SignIn.php");
    // exit();
}
?>
<?php
$user = $_SESSION['username'];
$insert = false;
$delete = false;
$update = false;
$servername = "localhost";
$username ="root";
$password ="";
$database = "newNotes";
try{
    $conn = mysqli_connect($servername,$username,$password,$database);

}
catch(mysqli_sql_exception $e){
    die("Could not connect to the server because of this error->".mysqli_connect_error()) ;
}

if($_SERVER["REQUEST_METHOD"]=='POST')
{
     if(isset($_POST['modaledit'])){
        $sl = $_POST['modaledit'];
        $title= $_POST['titleEdit'];
        $desc = $_POST['descEdit'];
        $sql = "UPDATE `newnotes` SET `title` = '$title', `description` = '$desc' WHERE `newnotes`.`slno` = '$sl'";
        try{
            mysqli_query($conn,$sql);
            $update = true;
        }
        catch(mysqli_sql_exception $e){
            die("Could not update data due to this error->".mysqli_error($conn));
        }

    }
     else if(isset($_POST['modaldelete'])){
        $sol = $_POST['modaldelete'];

          $sql = "DELETE FROM `newnotes` WHERE `newnotes`.`slno` = '$sol'";
        try{
            mysqli_query($conn,$sql);
            $delete = true;
        }
        catch(mysqli_sql_exception $e){
            die("Could not delete data due to this error->".mysqli_error($conn));
        }
    }


    else{

        $title= $_POST['title'];
        $desc = $_POST['desc'];
       
        $sql = "INSERT INTO `newnotes` (`title`, `description`, `userName`) VALUES ('$title', '$desc','$user')";
        
        try{
            mysqli_query($conn,$sql);
            $insert = true;
        }
        catch(mysqli_sql_exception $e){
            die("Could not insert data due to this error->".mysqli_error($conn));
        }
    }
}
?>
<!-- php  -->

<!-- html  -->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo "welcome " .$_SESSION['username']?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.3.js"
        integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</head>

<body>
    <!-- modal  -->
    <!-- Button trigger modal -->

    <!-- ModalEdit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby=editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Update data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/php/harry/loginSystem/newCrud.php" method="post">
                <input id ="modaledit" type="hidden" name='modaledit'>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="titleEdit" class="form-label">Title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">

                            <label for="descEdit" class="form-label">Description</label>
                            <textarea class="form-control" id="descEdit" name="descEdit" rows="3"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer d-block float-left">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modalEdit  -->
    <!-- ModalDelete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby=deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deleteModalLabel">Update data</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/php/harry/loginSystem/newCrud.php" method="post">
                <input id ="modaldelete" type="hidden" name='modaldelete'>
                <div class="container"style="color:red;display:block;">

                    <h4>Do you realy want to delete it?</h4>
                </div>
                    <div class="modal-footer d-block float-left">
                        <button type="button submit" class="btn btn-primary">Yes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- modalDelete  -->
    <!-- nav bar  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/php/harry/loginSystem/newCrud.php">inote</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="/php/harry/loginSystem/newCrud.php">Home</a>
                    </li>
                    
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="/php/harry/loginSystem/SignUp.php">Sign Up</a>
                    </li> -->

                    <li class="nav-item">
                        <a class="nav-link" href="/php/harry/loginSystem/SignOut.php">Sign Out</a>
                    </li>
        
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- nav bar  -->
    <!-- alret  -->
    <?php
    if( $insert)
    {
                  echo'  <div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong>Holy guacamole!</strong>Data inserted succesfully.
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    }
    ?>
    <?php
    if( $delete)
    {
                  echo'  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                   <strong>Holy guacamole!</strong>Data deleted succesfully.
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    }
    ?>
    <?php
    if( $update)
    {
                  echo'  <div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong>Holy guacamole!</strong>Data update succesfully.
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    }
    ?>
    <!-- alret  -->
    <!-- for form  -->
    <div class="container my-5">
        <h3 class="mb-4">Enter your notes</h3>
        <form action="/php/harry/loginSystem/newCrud.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">

                <label for="desc" class="form-label">Description</label>
                <textarea class="form-control" id="desc" name="desc"  rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
    </div>
    <!-- for form  -->
    <!-- table  -->
    <div class="container mb-5">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th scope="col">Slno</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
            $sql = "SELECT * FROM `newnotes` where `userName`='$user'";
            $result = mysqli_query($conn,$sql);
            $s=0;
            while($row = mysqli_fetch_assoc($result))
            {
                  $s++;
                  echo" <tr>
                  <th scope='row'>".$s."</th>
                  <td>".$row['title']."</td>
                  <td>".$row['description']."</td>
                  <td><button  class='btn btn-primary edit'id =".$row['slno'].">Edit</button> <button class='btn btn-primary delete' id =d".$row['slno'].">Delete</button></td>
                  </tr>";
                
            
                    // echo $row['slno'];
                    // echo "<br>";

            
            }
            ?>

            </tbody>
        </table>
    </div>
    <!-- table  -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script>
        edits = document.getElementsByClassName("edit");
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                // console.log("edit",);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                // console.log(title,description);
                titleEdit.value = title;
                descEdit.value = description;
                $('#editModal').modal('toggle');
                // console.log(e.target.id);
                modaledit.value = e.target.id;



            })
        })
        // deletes = document.getElementsByClassName("delete");
        // Array.from(deletes).forEach((element) => {
        //     element.addEventListener("click", (e) => {
        //         // console.log("edit",);
        //         sl =e.target.id.substr(1);
        //         if(confirm("Press a button!"))
        //         {
                    
        //             window.location=`/php/harry/newCrud.php?delete=${sl}`;
        //         }
               
              



        //     })
        // })


          deletes = document.getElementsByClassName("delete");
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                // console.log("edit",);
                modaldelete.value =e.target.id.substr(1);
                $('#deleteModal').modal('toggle');
                
               
              



            })
        })

    </script>
</body>

</html>