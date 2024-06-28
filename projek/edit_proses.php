<?php
include("config.php");

// Isset mengecek apakah tombol daftar sudah diklik
if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $name = $_POST['nama'];
    $kelas = $_POST['class'];
    $score = $_POST['score'];

    // Query untuk memperbarui data ke tabel siswa
    $sql = "UPDATE students SET nama='$name', class='$kelas', score='$score' WHERE id=$id";
    $query = mysqli_query($conn, $sql);

    // Mengecek apakah query berhasil
    if ($query) {
        header('Location: monitoring.php?status=sukses');
    } else {
        // Mengambil error dari MySQLi
        $error = mysqli_error($conn);
        echo "Query error: $error";
        // header('Location: table.php?status=gagal'); // Commented out for debugging
    }
} else {
    die("Gagal terhubung dengan situs...");
}
?>
s