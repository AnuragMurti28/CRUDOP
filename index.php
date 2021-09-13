<!-- INSERT INTO `notes` (`sno`, `title`, `description`, `tstamp`) VALUES (NULL, 'Buy books', 'RD Sharma\r\nEMFT\r\nDelete after task done', current_timestamp()); -->

<!-- --------------------PHP Code ---------------------------------- -->
<?php
$insert = False;
$update = False;
$delete = False;
// Connection to Database
$servername =  "localhost";
$username = "root";
$password = "";
$database = "notes";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Sorry we fail to connect: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ititle = $_POST['new_title'];
    $idescription = $_POST['new_description'];

    // SQL query to be executed
    $sql = "INSERT INTO `notes` (`title`, `description`) VALUES ('$ititle', '$idescription')";
    $result = mysqli_query($conn, $sql);

    // connection success and error message
    if ($result) {
        // echo "The record has been inserted successfully<br>";
        $insert = true;
    } else {
        echo " unable to insert due to error: " . mysqli_error($conn);
    }
}
?>
<!-- --------------------PHP Code ---------------------------------- -->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- Jquery  -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- Jquery  -->
    
    <!-- Links from datatable.com -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

    <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <!-- Links from datatable.com -->

    <title>iNotes - notes taking easy</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">iNotes</a>
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
                        <a class="nav-link" href="#">Contact us</a>
                    </li>

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- =====================Alert===================== -->
    <?php
    if ($insert) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Success</strong> Your note has been inserted successfully.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    ?>
    <!-- =====================Alert===================== -->
    <div class="container my-4">
        <h2>Add a Note</h2>
        <form action="/crudop/index.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" class="form-control" id="title" name="new_title" aria-describedby="emailHelp">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>

            <div class="mb-3">
                <label for="desc" class="form-label">Note Description</label>
                <textarea class="form-control" id="description" name="new_description" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add note</button>
        </form>
    </div>
    <div class="container">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `notes`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <th scope='row'> " . $row['sno'] . " </th>
                    <td> " . $row['title'] . " </td>
                    <td> " . $row['description'] . " </td>
                    <td> Actions </td>
                    </tr>";
                }
                ?>


            </tbody>
        </table>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
</body>

</html>