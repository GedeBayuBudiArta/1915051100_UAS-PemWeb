<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
include 'functions.php';

$pesan = pesan($_GET);
if($pesan > 0){
    echo "
        <script>
            alert('Berhasil memesan mahasiswa');
            document.location.href = 'index.php';
        </script>";
}else{
    echo "
        <script>
            alert('Mahasiswa sudah dipesan');
            document.location.href = 'index.php';
        </script>";
}


?>