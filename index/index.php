<?php
//CONNECTION WT DB
$servername = "localhost";
$username = "root";
$password = "";
$database = "Kaam-KaaJ";

$conn = mysqli_connect($servername, $username, $password,$database);
$insert = FALSE;
$update = FALSE;
$delete = FALSE;

if(!$conn){
  die("Sorry we failed to connect.". mysqli_connect_error()); 
}

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = TRUE;
  $sql = "DELETE FROM `notes` WHERE `notes`.`Sr.no.` = '$sno'";
$result = mysqli_query($conn, $sql);
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
if(isset($_POST['snoEdit'])){
    $srn1 = $_POST["snoEdit"];
    $Title = $_POST["TitleEdit"];
    $Descrp = $_POST["DescrpEdit"];

//UPDATE
$sql = "UPDATE `notes` SET `Title` = '$Title', `Descrp` = '$Descrp' WHERE `notes`.`Sr.no.` = '$srn1'";
$result = mysqli_query($conn, $sql);
if($result){
  $update = TRUE;
}
else{
  echo "The values not updated bcoz of this error: ". mysqli_error($conn);
}
}
else{
    $Title = $_POST["Title"];
  $Descrp = $_POST["Descrp"];

//INSERTING 
$sql = "INSERT INTO `notes` (`Sr.no.`, `Title`, `Descrp`, `Time`) VALUES (NULL, '$Title', '$Descrp', current_timestamp())";
$result = mysqli_query($conn, $sql);
if($result){
  $insert = TRUE;
}
else{
  echo "The values not inserted bcoz of this error: ". mysqli_error($conn);
}

}
  }
  
//SETTING COOKIES
setcookie("category","notes",time() + 864000, "/");

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
     <link rel="stylesheet" href="//cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    
     
    <title>KAAM-KAAJ : Work to be done</title>
    
  </head>
  <body>

  <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
Edit modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/CRUD/index.php" method="POST">
      <input type="hidden" name="snoEdit" id="snoEdit">
  <div class="mb-3">
    <label for="Title" class="form-label">Note Title</label>
    <input type="text" class="form-control" id="TitleEdit" name="TitleEdit" aria-describedby="emailHelp">
    
  </div>
  
  <div class="mb-3">
  <label for="Descrp" class="form-label">Description</label>
  <textarea class="form-control" id="DescrpEdit" name="DescrpEdit" rows="3"></textarea>
</div>
  
<button type="submit" class="btn btn-primary">Save changes</button>
<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</form>
      </div>
     
    </div>
  </div>
</div>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="/static/logo.png" height="50px" alt="Loading...">KaaM-KaaJ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>-->
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
    <script src="//cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    
    <script>
     $(document).ready( function () {
    $('#myTable').DataTable();
    } ); 
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<?php
if($insert){
  echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong>Done!!!!!</strong> Your note has been saved.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>

<?php
if($update){
  echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong>Done!!!!!</strong> Your note has been updated.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>

<?php
if($delete){
  echo '<div class="alert alert-primary alert-dismissible fade show" role="alert">
  <strong>Done!!!!!</strong> Your note has been deleted.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>
<div class="container my-5">
    <h4>Add a note</h4>
    <form action="/CRUD/index.php" method="POST">
  <div class="mb-3">
    <label for="Title" class="form-label">Note Title</label>
    <input type="text" class="form-control" id="Title" name="Title" aria-describedby="emailHelp">
    
  </div>
  
  <div class="mb-3">
  <label for="Descrp" class="form-label">Description</label>
  <textarea class="form-control" id="Descrp" name="Descrp" rows="3"></textarea>
</div>
  
  <button type="submit" class="btn btn-primary">Add note</button>
</form>
</div>

<div class="container my-4">
<table class="table" name="myTable" id="myTable">

<thead>
    <tr>
      <th scope="col">Sr.no.</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Operations</th>
    </tr>
  </thead>
<tbody>
<?php
$sql = "SELECT * FROM notes";
$result = mysqli_query($conn, $sql);
$srn = 0;
while($row = mysqli_fetch_assoc($result)){
  $srn = $srn + 1;
  echo "<tr>
  <th scope='row'>". $srn ."</th>
  <td>". $row['Title'] ."</td>
  <td>". $row['Descrp'] ."</td>
  <td> <button class='delete btn btn-sm btn-primary' id =d".$row['Sr.no.'].">Delete</button> <button class='edit btn btn-sm btn-primary' id =".$row['Sr.no.'].">Edit</button> </td>
  </tr>";
  
}

?>

</tbody>
</table>
<hr>
</div>

<script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach(element => {
      element.addEventListener("click",(e)=>{
       console.log("edit ",);
       tr = e.target.parentNode.parentNode;
       title = tr.getElementsByTagName("td")[0].innerText;
       desc = tr.getElementsByTagName("td")[1].innerText;
       console.log(title,desc);
       DescrpEdit.value = desc;
       TitleEdit.value = title;
       snoEdit.value = e.target.id;
       console.log(e.target.id);
       $('#exampleModal').modal('toggle');

      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach(element => {
      element.addEventListener("click",(e)=>{
       console.log("edit ",);
      sno = e.target.id.substr(1,);
       if(confirm("Are you sure you want to delete this note?")){
         console.log("yes");
         window.location = `/CRUD/index.php?delete=${sno}`;
       }
       else{
         console.log("no");
      }
      })
    })
    </script>
</body>
</html>