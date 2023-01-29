<?php
    session_start();
    include("../config/db.php");
    
    if (isset($_SESSION['user'])) {
        header("location:Absen.page.php");
    }
    
    $username = "";
    $password = "";
    $err = "";

    if (isset($_POST['login'])) {
        $username   = $_POST['username'];
        $password   = $_POST['password'];
        if ($username == '' or $password == '') {
            $err .= "Silakan masukkan username dan password";
        }
        if (empty($err)) {
            $sql_user = $conn->query("select * from tb_user where username = '$username'");

            $username = mysqli_fetch_array($sql_user);
            if ($username['password'] != md5($password)) {
                $err .= "Akun tidak ditemukan";
            }
        }
        if (empty($err)) {
            $_id_user = $username['_id'];
            var_dump($_id_user);
            $role_sql = $conn->query("select * from tb_master_role where _id_user = '$_id_user'");

            while ($data = mysqli_fetch_array($role_sql)) {
                $role[] = $data['_id_role'];
            }
            if (empty($role)) {
                $err .= "Role Akses Kosong";
            }
        }
        if (empty($err)) {
            $_SESSION['user'] = $username;
            $_SESSION['role_akses'] = $role;
            header("location:Absen.page.php");
            echo "login sukses";
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="">
    <div class="w-screen h-screen flex flex-col justify-center">
        <div class="mx-auto w-[700px] border-2 border-blue-500 p-5">
            <h1 class="text-center mb-3 text-lg font-bold text-gray-700">Halaman Login</h1>
            <?php
            if ($err) {
                echo $err;
            }
            ?>
            <form action="" method="post">
                <div class="mb-2">
                    <input type="text" class="w-full p-2 text-gray-500 focus:outline-none border-2 border-blue-500 rounded-md" value="" name="username" class="input" placeholder="Isikan Username..." /><br /><br />
                </div>
    
                <div class="mb-2">
                    <input type="password" class="w-full p-2 text-gray-500 focus:outline-none border-2 border-blue-500 rounded-md" name="password" class="input" placeholder="Isikan Password" /><br /><br />
                </div>
                <input type="submit" name="login" class="p-2 cursor-pointer px-2.5 text-white bg-blue-500" value="Masuk Ke Sistem" />
            </form>
        </div>
    </div>
</body>

</html>