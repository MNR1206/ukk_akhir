<?php
    include 'config.php';
    session_start();

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