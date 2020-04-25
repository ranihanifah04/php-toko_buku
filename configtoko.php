<?php
//koneksi ke database
$host = "localhost"; //server local
$username = "root";
$password = "";
$db = "toko_buku";

//isi nama host, user mysql, password mysql, nama database mysql
$connect = mysqli_connect($host,$username,$password,$db);

//cek koneksi
if(mysqli_connect_errno()){
    //menampilkan pesan error ketika koneksi gagal
    echo mysqli_connect_errno();
}else{
}
?>
