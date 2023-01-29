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
            $err .= "<li>Silakan masukkan username dan password</li>";
        }
        if (empty($err)) {
            $sql_user = $conn->query("select * from tb_user where username = '$username'");

            $username = mysqli_fetch_array($sql_user);
            if ($username['password'] != md5($password)) {
                $err .= "<li>Akun tidak ditemukan</li>";
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
                $err .= "<li>Role Akses Kosong</li>";
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
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="app">
        <h1>Halaman Login</h1>
        <?php
        if ($err) {
            echo "<ul>$err</ul>";
        }
        ?>
        <form action="" method="post">
            <input type="text" value="<?php echo $username ?>" name="username" class="input" placeholder="Isikan Username..." /><br /><br />
            <input type="password" name="password" class="input" placeholder="Isikan Password" /><br /><br />
            <input type="submit" name="login" value="Masuk Ke Sistem" />
        </form>
    </div>
</body>

</html>