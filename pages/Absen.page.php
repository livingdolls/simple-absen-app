<?php
    include("../layouts/Header.php");
    include("../config/db.php");

    // Chek role user di session
    if (!in_array("staff", $_SESSION['role_akses'])) {
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

<h1 class="text-center text-2xl text-gray-500 mt-2">Halaman Absen</h1>
<div class="w-full h-screen flex flex-col mt-20">
    <div class="mx-auto">
        <p class="text-gray-700 text-bold text-center text-2xl">Hello <?= $_SESSION['user']['username']; ?></P>
        <?php 
        if($notif){
            echo $notif;
        }
    
        if($err){
            echo $err;
        }
        ?>
        <form action="Absen.page.php" method="post" class="flex flex-col space-y-5">
            <input type="hidden" name="id_user" value="<?= $_SESSION['user']['_id']; ?>" />
            <select name="tipe_absen" class="p-5 w-[300px] outline-none"> 
                <option value="masuk">Absen Masuk</option>
                <option value="pulang">Absen Pulang</option>
            </select>
            <input type="submit" name="absen" value="Absen" class="p-3 bg-blue-500 rounded-md text-white font-bold" />
        </form>

    </div>

</div>
