<?php
  if (isset($_POST["save_customer"])) {
    // isset digunakan untuk mengecek
    // apakah kita mengakses file ini. dikirimkan
    // data dengan nama "save_siswa" dg method $_POST

    // kita tampung  data yang dikirimkan
    $action = $_POST["action"];
    $id_customer = $_POST["id_customer"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $kontak = $_POST["kontak"];
    $user = $_POST["username"];
    $pass = $_POST["password"];

    // load file config.?php
    include("configtoko.php");

    // cek aksi
    if ($action == "insert") {
      // insert
      $sql = "insert into customer values ('$id_customer','$nama', '$alamat','$kontak','$user','$pass')";

      // eksekusi perintah
      mysqli_query($connect, $sql);
    }else if ($action == "update") {
      $sql = "update customer set nama = '$nama', alamat = '$alamat', kontak = '$kontak', username = '$user', password = '$pass' where id_customer = '$id_customer'";

      // eksekusi perintah
      mysqli_query($connect,$sql);
    }

    //redirect ke halaman siswa.php
    header("location:customer.php");
  }

  if (isset($_GET["hapus"])) {
    include("configtoko.php");
    $id_customer = $_GET["id_customer"];

    $sql = "delete from customer where id_customer='$id_customer'";

    mysqli_query($connect, $sql);
    // direct ke halaman data siswa
    header("location:customer.php");
  }
 ?>