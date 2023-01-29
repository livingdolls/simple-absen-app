<?php
    include("../layouts/Header.php");
    if (!in_array("staff", $_SESSION['role_akses'])) {
        echo "Kamu tidak punya akses";
        exit();
    }
?>
<h1>Halaman Staff</h1>
Selamat datang di halaman Staff