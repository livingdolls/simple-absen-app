<?php
    include("../layouts/Header.php");
    include("../config/db.php");

    // Cek session akses role
    if (!in_array("staff", $_SESSION['role_akses'])) {
        echo "Kamu tidak punya akses";
        exit();
    }

    $sql = $conn->query("SELECT * FROM `tb_absen` JOIN tb_user ON tb_absen._id_user = tb_absen._id_user");

    if(!$sql){
        echo mysqli_error($conn);
    }
?>
<h1>Halaman Staff</h1>

<table>
  <tr>
    <th>No</th>
    <th>Nama</th>
    <th>Absen</th>
    <th>Tanggal & Jam</th>
  </tr>
  <?php  $no = 1;
    while($data = mysqli_fetch_array($sql)) {         
        echo "<tr>";
        echo "<td>".$no++."</td>";
        echo "<td>".$data['username']."</td>";
        echo "<td>".$data['tipe_absen']."</td>";    
        echo "<td>".$data['date_time']."</td></tr>";    
    }
    ?>
</table>