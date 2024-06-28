<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

include 'config.php';

$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Matematika</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="icon" type="image/Telkom-icon" href="image.png">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Menu |</a>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">            
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Log out</a>
            </li>
        </ul>
        </div>
    </div>
</nav>
<div class="container mt-5">
    <h1 class="text-center">Data Nilai Matematika</h1>
    <table class="table table-bordered" >
        <thead class="table-dark" >
            <tr >
                <th>No</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$no}</td>
                    <td>{$row['nama']}</td>
                    <td>{$row['class']}</td>
                    <td>{$row['score']}</td>
                    
                </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
    <!-- <a href="logout.php" class="btn btn-outline-secondary btn-sm position-absolute top-40 start-50 translate-middle mt-3 "  style="width: 300px;height:30px;text-align:center">Logout</a> -->
</div>
</body>
</html>