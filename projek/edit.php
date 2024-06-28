<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

require 'config.php';

$id = $_GET['id'];
$query = "SELECT * FROM students WHERE id='$id'";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);
if (!$student) {
    die("Data siswa tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Menu |</a>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
                <?php if ($_SESSION['role'] == 'admin'): ?>
                        <li><a href="#" class="nav-link active" aria-current="page">Monitoring</a></li>
                <?php elseif ($_SESSION['role'] == 'user'): ?>
                    <li><a href="#" class="nav-link active" aria-current="page">Tambah Data</a></li>
                    <?php endif; ?>
            <li class="nav-item">
            <a class="nav-link" href="table.php">Siswa</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="logout.php">Log out</a>
            </li>
        </ul>
        </div>
    </div>
</nav>
    <div class="container">
        <div class="main-content">
        <h1 class="text-center">Edit Data</h1>
            <p><?php if (isset($message)) echo $message; ?></p>
                <form action="edit_proses.php" method="post">
                <input type="hidden" name="id" value="<?php echo $student['id'];?>">
                    <div class="row align-item-start">
                        <div class="col">
                        <label for="name" class="form-label">Nama :</label>
                        <input type="text" class="form-control" id="name" value="<?php echo htmlspecialchars($student['nama']); ?>" name="nama" required>
                        </div>
                        <div class="col">
                        <label for="class" class="form-label">Kelas :</label>
                        <input type="text" class="form-control" id="class" value="<?php echo htmlspecialchars($student['class']); ?>" name="class" required>
                        </div>
                        <div class="col">
                        <label for="score" class="form-label">Nilai :</label>
                        <input type="number" class="form-control" id="score" value="<?php echo htmlspecialchars($student['score']); ?>" name="score" required>
                        </div>
                        <button type="submit" name="simpan" class="btn btn-outline-secondary btn-sm me-1" style="width: 200px;height:30px;margin-top:35px;">Update Siswa</button>
                    </div>
                </form>
        </div>
    </div>
</body>
</html>