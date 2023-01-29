<?php
    include("../layouts/Header.php");
    include("../config/db.php");

    // Chek role user di session
    if (!in_array("karyawan", $_SESSION['role_akses'])) {
        echo "Kamu tidak punya akses";
        exit();
    }

    $err = "";
    $notif = "";

    if(isset($_POST['absen'])){
        $id_user = $_POST['id_user'];
        $tipe_absen = $_POST['tipe_absen'];

        if ($id_user == '' or $tipe_absen == '') {
            $err .= "<li> user atau tipe absen tidak diketahui</li>";
        }

        if(empty($err)){
            $absen = $conn->query("insert into tb_absen(`_id_user`,`tipe_absen`) VALUE ($id_user,'$tipe_absen')");

            if($absen){
                $notif = "Sukses absen!";
            }else{
                die('invalid Query : ' . mysqli_error($conn));
            }

        }
    }
?>

    <h1>Halaman Absen</h1>
    <?php 
    if($notif){
        echo $notif;
    }

    if($err){
        echo $err;
    }
    ?>
    <form action="Absen.page.php" method="post">
        <input type="hidden" name="id_user" value="<?= $_SESSION['user']['_id']; ?>" />
        <select name="tipe_absen"> 
            <option value="masuk">Absen Masuk</option>
            <option value="pulang">Absen Pulang</option>
        </select>
        <input type="submit" name="absen" value="Absen" />
    </form>
