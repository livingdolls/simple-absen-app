<?php
    session_start();
    include("../config/db.php");
    
    // Chek Session User
    if (!isset($_SESSION['user'])) {
        header("location:Login.page.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absen</title>
</head>

<body>
    <div id="app">
        <nav>
            <ul>
                <?php if (in_array("karyawan", $_SESSION['role_akses'])) { ?>
                    <li><a href="Absen.page.php">Halaman Absen</a></li>
                <?php } ?>
                <?php if (in_array("staff", $_SESSION['role_akses'])) { ?>
                    <li><a href="Staff.page.php">Halaman staff</a></li>
                <?php } ?>
                <li><a href="_Logout.php">Logout</a></>
            </ul>
        </nav>