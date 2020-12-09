<?php
//Gede Bayu Budi Arta
session_start();

if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

//pagination
//config pagination
$jumlahDataPerHalaman = 5;
$jumlahData = count(query("SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
$awalData = ( $jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awalData, $jumlahDataPerHalaman");

//cari
if (isset($_POST["cari"]) ) {
    $mahasiswa = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro.min.css">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-colors.min.css">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-rtl.min.css">
    <link rel="stylesheet" href="https://cdn.metroui.org.ua/v4/css/metro-icons.min.css">
    <style>
    .tabel th, td{
        color: white;
    }
    @media print {
        .button {
            display:none;
        }
    }
    </style>
    <title>Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head>
<body class="h-vh-100 bg-brandColor2">
    <?php include 'nav.php'; ?>
    <br><br><br>
    <h1 align="center" style="color: white;">DAFTAR MAHASISWA</h1>
    <a class="button primary cell-4  offset-4 drop-shadow" href="tambah.php"><span class="mif-plus"></span> Tambah Data Mahasiswa</a>
    <br><br>
    
    <div class="form-group cell-6  offset-3">
        <input type="text" id="cari-value" name="keyword" placeholder="Cari dengan nama atau nim atau jurusan" autofocus autocomplete="off">
        <button class="button" id="tombol-cari" name="cari"><span class="mif-search"> Cari</button>
    </div>

    <div class="container">
    <table class="table row-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nim</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
    </thead>
    <tbody>
        
        <?php $i = 1; ?>
        <?php foreach ( $mahasiswa as $row) : ?>
        <tr class="row-hover">
            <td><?php echo $i; ?></td>
            <td>
                <?php if($row["taken"] != $_SESSION["user"]) : ?>
                    <a class="button info drop-shadow" href="pesan.php?id=<?php echo $row["id"]; ?>&user=<?php echo $_SESSION["user"]; ?>" onclick="return confirm('Pesan?');"><span class="mif-add mif-2x"></span> Pesan</a>
                <?php else : ?>
                    <a class="button primary drop-shadow" href="batal-pesan.php?id=<?php echo $row["id"];?>" onclick="return confirm('Batal Pesan?');"><span class="mif-done_all mif-2x"></span> Dipesan</a>
                <?php endif; ?>
                <a class="button success drop-shadow" href="ubah.php?id=<?php echo $row["id"]; ?>"><span class="mif-pencil mif-2x"></span> Edit</a>
                <a class="button alert drop-shadow" href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Yakin');"><span class="mif-bin mif-2x"></span>Hapus</a>
            </td>
            <td><img class="drop-shadow" src="img/<?php echo $row["gambar"]; ?>" alt="" width="50"></td>
            <td> <?php echo $row["nim"]; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["jurusan"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </tbody>
    </table>
    </div>
    <!-- PaGINATIOn -->
    <div class="cell-4  offset-4 ">
    <ul class="pagination alert">
        <?php if ( $halamanAktif > 1 ) : ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $halamanAktif - 1 ?>"><span class="mif-arrow-left"></span> Prev</a></li>
        <?php endif; ?>
        <?php for($i = 1; $i <= $jumlahHalaman; $i++) : ?>
            <?php if( $i == $halamanAktif ) : ?>
                <li class="page-item active"><a class="page-link" href="?halaman=<?php echo $i; ?>" style="font-weight: bold; color: yellow;"><?php echo $i; ?></a></li>
            <?php else : ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ( $halamanAktif < $jumlahHalaman ) : ?>
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $halamanAktif + 1 ?>">Next <span class="mif-arrow-right"></span></a></li>
        <?php endif; ?>
    </ul>
    </div>
    
	<div class="footer center">
	  <div class="form-group cell-10  offset-5">
		&copy; Copyright Bayubudiarta 2020.
	</div>
	
    <!-- SCRIPT -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.metroui.org.ua/v4/js/metro.min.js"></script>
    <script src="http://localhost/ummi_/js/ajax.js"></script>
</body>
</html>