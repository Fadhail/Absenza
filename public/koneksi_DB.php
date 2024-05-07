<?php
$host      = "localhost";
$user      = "root";
$pass      = "Xeroon*09";
$db        = "absenza";

$koneksi   = mysqli_connect($host,$user,$pass,$db);
if(!$koneksi){
    die("Gagal terkoneksi");
}else{
    echo "Koneksi berhasi";
}