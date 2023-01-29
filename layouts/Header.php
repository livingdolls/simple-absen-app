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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Absen</title>
</head>

<body>
    <div id="app">
        <nav class="p-2 bg-blue-500 flex space-x-2">
                <?php if (in_array("staff", $_SESSION['role_akses'])) { ?>
                    <div class="p-1 hover:bg-white hover:text-blue-500 font-semibold text-white border-2 border-white rounded-md">
                        <p><a href="Absen.page.php">Halaman Absen</a></p>
                    </div>
                <?php } ?>
                <?php if (in_array("admin", $_SESSION['role_akses'])) { ?>
                    <div class="p-1 hover:bg-white hover:text-blue-500 font-semibold text-white border-2 border-white rounded-md">
                    <p><a href="Staff.page.php">Halaman Admin</a></p>
                </div>
                <?php } ?>
                <div class="p-1 hover:bg-white hover:text-blue-500 font-semibold text-white border-2 border-white rounded-md">
                <p><a href="_Logout.php">Logout</a></p>
                </div>
        </nav>