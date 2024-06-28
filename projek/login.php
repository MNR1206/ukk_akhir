<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktik Kerja Lapangan</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="icon" type="image/Telkom-icon" href="image.png">
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="image.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
            SMK Telkom Jakarta
            </a>
        </div>
    </nav>
        <h2 class="text-center pb-5">Tugas Akhir Praktik Kerja Lapangan</h2>
    </header> 
    <div class="container" style="width: 600px;height:250px;background-color:aliceblue;border-radius:20px">
        
        <div class="login" style="width: 600px;height:250px;background-color:aliceblue;padding:40px;border-radius:20px">
            <form action="" method="post">
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name=username>
            </div>

            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name=password>
            </div>
            <?php
                session_start();
                require 'config.php';

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) == 1) {
                        $user = mysqli_fetch_assoc($result);
                        $_SESSION['loggedin'] = true;
                        $_SESSION['role'] = $user['role'];

                        if ($user['role'] == 'admin') {
                            header('Location: monitoring.php');
                        } else {
                            header('Location: table.php');
                        }
                    } else {
                        echo '<p class="position-absolute top-50 start-50 translate-middle" style="text-align:center;padding:10px"></p>Username atau password salah.';
                    }
                }
            ?>
                <button type="submit" class="btn btn-outline-secondary btn-sm position-absolute top-40 start-50 translate-middle mt-5 "  style="width: 200px;">Log In</button>
            </form>
        </div>
    </div>
</body>
</html>