<?php
session_start();
if (!isset($_SESSION["id_customer"])) {
  header("location:login_customer.php");
}
// memamnggil file config.php
// agar tidak perlu membuat koneksi baru
include("configtoko.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Buku</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="https://kit.fontawesome.com/dc8a681ba8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="">
    <script type="text/javascript">
      Detail = (item) => {
        document.getElementById('kode_buku').value = item.kode_buku;
        document.getElementById("judul").innerHTML = item.judul;
        document.getElementById("penulis").innerHTML = "Penulis : " + item.penulis;
        document.getElementById("harga").innerHTML = "Harga : Rp " + item.harga;
        document.getElementById("stok").innerHTML = "Stok : " + item.stok;
        document.getElementById("jumlah_beli").vaue = "1";

        document.getElementById("image").src = "image/" + item.image;
      }
    </script>
    <style media="screen">
        .image{
       width:292px;
       height:192px;
     }
     .bg-navy{
       background: pink;
     }
     .img{
       width:50px;
       height:100px;
     }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-expand-md bg-navy navbar-dark stiky-top">
      <a href="#">
        <img src="gambar/logo.jpg" width="75" alt="">
      </a>

      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="menu">
        <span class="navbar navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav">
          <li class="nav-item"> <a href="tampilan_customer.php" class="nav-link">Home</a></li>
          <li class="nav-item"> <a href="#" class="nav-link">Contact</a></li>
          <li class="nav-item">
            <a href="cart.php" class="nav-link">
              Cart(<?php echo count($_SESSION["cart"]); ?>)
            </a>
          </li>
          <li class="nav-item"><a href="proses_login_customer.php?logout=true" class="nav-link">
                  <?php echo $_SESSION["nama"] ?> | Logout
                </a>
        </ul>
      </div>

      </nav>
    <?php
    // membuat perintah sql untuk menampilkan data siswa
    if (isset($_POST["cari"])) {
      // query jika pencarian
      $cari = $_POST["cari"];
      $sql = "select * from buku where judul like '%$cari%' or penulis like '%$cari%'";
    }else {
      // query jika tidak mencari
      $sql = "select * from buku";
    }

    // eksekusi sqlnya
    $query = mysqli_query($connect, $sql);
     ?>
     <br>
     <div class="container">
       <div class="card">
         <div class="card-header bg-dark">
           <h4 class="text-white">Keranjang Belanja Anda</h4>
         </div>
         <div class="card-body">
           <table class="table table-hover">
             <thead>
               <tr>
                 <th>No</th>
                 <th>Judul</th>
                 <th>Harga</th>
                 <th>Jumlah</th>
                 <th>Total</th>
                 <th>Option</th>
               </tr>
             </thead>
             <tbody>
               <?php $no = 1; ?>
               <?php foreach ($_SESSION["cart"] as $cart): ?>
                 <tr>
                   <td><?php echo $no ?></td>
                   <td><?php echo $cart["judul"]; ?></td>
                   <td>Rp <?php echo $cart["harga"]; ?></td>
                   <td><?php echo $cart["jumlah_beli"]; ?></td>
                   <td>Rp <?php echo $cart["jumlah_beli"]*$cart["harga"]; ?></td>
                   <td>
                     <a href="proses_cart.php?hapus=true&kode_buku=<?php echo $cart["kode_buku"]?>">
                       <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                     </a>
                   </td>
                 </tr>
               <?php $no++; endforeach; ?>
             </tbody>
           </table>
         </div>
         <div class="card-footer text-right">
           <a href="proses_cart.php?checkout=true">
               <button type="button" class="btn bg-success text-white">
               Checkout
             </button>
           </a>
         </div>
       </div>
     </div>
     <br>
    <div class="footer" align="center">
        &copy; Copyright by
         <a href="https://www.instagram.com/ranihnfh_/?hl=id" target="blank" class="footer">Rani</a>
    </div>
    <br>
  </body>
</html>