<?php
    include("../layouts/Header.php");
    include("../config/db.php");

    // Cek session akses role
    // Only admin can access
    if (!in_array("admin", $_SESSION['role_akses'])) {
        echo "Kamu tidak punya akses";
        exit();
    }

    $sql = $conn->query("SELECT * FROM `tb_absen` JOIN tb_user ON tb_absen._id_user = tb_absen._id_user");

    if(!$sql){
        echo mysqli_error($conn);
    }
?>
<h1>Halaman Staff</h1>

<table class="w-[700px]">
    <thead class="p-2 bg-blue-500 text-white">
        <tr class="p-2">
          <th class="p-2">No</th>
          <th class="p-2">Nama</th>
          <th class="p-2">Absen</th>
          <th class="p-2">Tanggal & Jam</th>
        </tr>
</thead>
  <?php  $no = 1;
    while($data = mysqli_fetch_array($sql)) {  ?>       
    <tr class="p-1 border-b-2 border-gray-500">
        <td class="p-2 text-center"><?= $no++; ?></td>
        <td class="p-2 text-center"><?= $data['username']; ?></td>
        <?php if($data['tipe_absen'] == 'masuk') { ?>
            <td class="p-2 text-center"><p class="p-1 bg-green-500 text-white rounded-md"><?= $data['tipe_absen']; ?></p></td>
        <?php }else { ?>
            <td class="p-2 text-center"><p class="p-1 bg-red-500 text-white rounded-md"><?= $data['tipe_absen']; ?></p></td>
        <?php } ?>
        <td class="p-2 text-center"><?= $data['date_time']; ?></td>
    </tr>
    <?php }
    ?>
</table>