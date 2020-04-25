  <?php
  session_start();
  // session_start() digunakan sebagai tanda kalau kita akan menggunakan session pada halaman ini
  //  session_start() harus diletakkan pada baris pertama.
  include("configtoko.php");

  // tampung data username dsn passwordnya
  $username = $_POST["username"];
  $password = $_POST["password"];

  if (isset($_POST["login_admin"])) {
    $sql = "select * from admin where username = '$username' and password = '$password'";
    // eksekusi query
    $query = mysqli_query($connect, $sql);
    $jumlah = mysqli_num_rows($query);
    // digunakan untuk menghitung jumlah data ahasil dary $query
    if ($jumlah > 0) {
      // jika jumlahnya lebih dari nol, artinya terdapat data admin yang sesuai dengan username dan password yang diinputkan
      // ini blok kode jika login berhasil
      // kita ubah hasil query ke array
      $admin = mysqli_fetch_array($query);

      // membuat session
      $_SESSION["id_admin"] = $admin["id_admin"];
      $_SESSION["nama"] = $admin["nama"];

      header("location:admin.php");
    }else {
      // jika nol, aritnya tidak ada data admin yg sesuai dengan username dan password yang diinputkan
      // ini blok kode jika loginnya gagal / salah
      header("location:login_admin.php");
    }
  }


  if (isset($_GET["logout"])) {
    // proses logout
    // menghapus data session yang telah dibuat.
    session_destroy();
    header("location:login_admin.php");
  }
 ?>