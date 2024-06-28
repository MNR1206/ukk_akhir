<?php
session_start();
if (!isset($_SESSION['loggedin']) || ($_SESSION['role'] != 'admin' && $_SESSION['role'] != 'user')) {
    header('Location: index.php');
    exit;
}

require 'config.php';

// Tambahkan data siswa jika form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student']) && $_SESSION['role'] == 'admin') {
    $name = $_POST['name'];
    $class = $_POST['class'];
    $score = $_POST['score'];

    $query = "INSERT INTO students (nama, class, score) VALUES ('$name', '$class', '$score')";
    if (mysqli_query($conn, $query)) {
        $message = "Data siswa berhasil dimasukkan.";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

// Update data siswa jika form edit di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_student']) && $_SESSION['role'] == 'admin') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $score = $_POST['score'];

    $query = "UPDATE students SET name='$name', class='$class', score='$score' WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        $message = "Data siswa berhasil diperbarui.";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

// Hapus data siswa jika tombol delete ditekan
if (isset($_GET['delete']) && $_SESSION['role'] == 'admin') {
    $id = $_GET['delete'];
    $query = "DELETE FROM students WHERE id='$id'";
    if (mysqli_query($conn, $query)) {
        $message = "Data siswa berhasil dihapus.";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}

$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="icon" type="image/Telkom-icon" href="image.png">
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
            <h1 class="text-center">Monitoring</h1>
            <p><?php if (isset($message)) echo $message; ?></p>
                <form action="" method="post">
                <?php
                    include 'config.php';
                    

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $name = $_POST['name'];
                        $class = $_POST['class'];
                        $score = $_POST['score'];

                        $sql = "INSERT INTO students (nama, class, score) VALUES ('$name', '$class', '$score')";
                        if ($conn->query($sql) === TRUE) {
                            echo "New record created successfully";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                ?>
                    <div class="row align-item-start">
                        <div class="col">
                        <label for="name" class="form-label">Nama :</label>
                        <input type="text" class="form-control" id="name" placeholder="Nama..." name="name" required>
                        </div>
                        <div class="col">
                        <label for="class" class="form-label">Kelas :</label>
                        <input type="text" class="form-control" id="class" placeholder="Kelas..." name="class" required>
                        </div>
                        <div class="col">
                        <label for="score" class="form-label">Nilai :</label>
                        <input type="number" class="form-control" id="score" placeholder="Nilai..." name="score" required>
                        </div>
                        <button type="submit" name="add_student" class="btn btn-outline-secondary btn-sm me-1" style="width: 200px;height:30px;margin-top:35px;">Tambah Siswa</button>
                    </div>
                    
                </form>
            <table class="table table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Nilai</th>
                        <th>Status</th>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama']); ?></td>
                            <td><?php echo htmlspecialchars($row['class']); ?></td>
                            <td><?php echo htmlspecialchars($row['score']); ?></td>
                            <td><?php echo $row['score'] >= 76 ? 'Lulus' : 'Ulang Sidang'; ?></td>
                            <?php if ($_SESSION['role'] == 'admin'): ?>
                                <td>
                                    <a href="edit.php?id=<?php echo $row['id']; ?>" style="text-decoration:none;color:crimson">Edit |</a>
                                    <a href="monitoring.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="text-decoration:none;color:crimson">Delete</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<style>
</style>
</html>