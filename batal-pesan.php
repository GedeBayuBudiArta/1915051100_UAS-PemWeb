<?php
session_start();
if ( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
include 'functions.php';

$batal = batalPesan($_GET);
if($batal > 0){
    echo "
        <script>
            alert('Berhasil membatalkan pesanan');
            document.location.href = 'index.php';
        </script>";
}else{
    echo "
        <script>
            alert('Gagal membatalkan pesanan');
            document.location.href = 'index.php';
        </script>";
}


?>