<?php
session_start();
if (!isset($_SESSION["id_admin"])) {
  header("location:login_admin.php");
}
// memamnggil file config.php
// agar tidak perlu membuat koneksi baru
include("configtoko.php");
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script type="text/javascript">
      Add = () =>{
        document.getElementById('action').value = "insert";
        document.getElementById('id_customer').value = "";
        document.getElementById('alamat').value = "";
        document.getElementById('nama').value = "";
        document.getElementById('kontak').value = "";
        document.getElementById('username').value = "";
        document.getElementById('password').value = "";
      }
      Edit = (item) =>{
        document.getElementById('action').value = "update";
        document.getElementById('id_customer').value = item.id_customer;
        document.getElementById('nama').value = item.nama;
        document.getElementById('alamat').value = item.alamat;
        document.getElementById('kontak').value = item.kontak;
        document.getElementById('username').value = item.username;
        document.getElementById('password').value = item.password;
      }
    </script>
    <style media="screen">
        
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top" id="Home">
        

        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
            <span class="navbar navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="customer.php" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="admin.php" class="nav-link">Admin</a></li>
                <li class="nav-item"><a href="customer.php" class="nav-link">Customer</a></li>
                <li class="nav-item"><a href="buku.php" class="nav-link">Buku</a></li>
                <li class="nav-item"><a href="transaksi_2.php" class="nav-link">Transaksi</a></li>
                <li class="nav-item"><a href="proses_login_admin.php?logout=true" class="nav-link">
                  <?php echo $_SESSION["nama"] ?> | Logout
                </a>
              </li>
            </ul>
        </div>
    </nav>
    <?php
    // membuat perintah sql untuk menampilkan data siswa
    if (isset($_POST["cari"])) {
      // query jika pencarian
      $cari = $_POST["cari"];
      $sql = "select * from customer where id_customer like '%$cari%' or nama like '%$cari%' or alamat like '%$cari%' or
      kontak like '%$cari%' or username like '%$cari%' or password like '%$cari%'";
    }else {
      // query jika tidak mencari
      $sql = "select * from customer";
    }

    // eksekusi sqlnya
    $query = mysqli_query($connect, $sql);
     ?>
     <br>
     <br>
     <br>
     <div class="container" id="customer">
       <div class="card">
         <div class="card-header bg-dark text-white">
           <h4 align="center">Customer</h4>
         </div>
         <div class="card-body">
           <form action="customer.php" method="post">
             <input type="text" name="cari" class="form-control my-2" placeholder="Search..">
           </form>
           <table class="table table-bordered table-hover" border="1">
             <thead>
               <tr>
                 <th>ID Customer</th>
                 <th>Nama</th>
                 <th>Alamat</th>
                 <th>Kontak</th>
                 <th>Username</th>
                 <th>Password</th>
                 <th>Option</th>
               </tr>
             </thead>
             <tbody>
               <?php foreach ($query as $customer): ?>
                 <tr>
                   <td><?php echo $customer["id_customer"]; ?></td>
                   <td><?php echo $customer["nama"]; ?></td>
                   <td><?php echo $customer["alamat"]; ?></td>
                   <td><?php echo $customer["kontak"]; ?></td>
                   <td><?php echo $customer["username"]; ?></td>
                   <td><?php echo $customer["password"]; ?></td>
                   <td>
                     <button data-toggle="modal" data-target="#modal_customer" type="button" class="btn btn-sm btn-info"
                     onclick='Edit(<?php echo json_encode($customer); ?>)'>
                       Edit
                     </button>
                     <a href="proses_crud_customer.php?hapus=true&id_customer=<?php echo $customer["id_customer"];?>"
                       onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                       <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal_customer"
                       onclick="Hapus(<?php  ?>);">
                         Hapus
                       </button>
                     </a>
                   </td>
                 </tr>
               <?php endforeach; ?>
             </tbody>
           </table>
           <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modal_customer" onclick="Add();">
             Tambah Data
           </button>
         </div>
         <div class="card-footer bg-dark text-white">
           <h5 align="center">&copy; Rani Hanifah</h5>
         </div>
       </div>
       <div class="modal fade" id="modal_customer">
         <div class="modal-dialog">
           <div class="modal-content">
             <form action="proses_crud_customer.php" method="post" enctype="multipart/form-data">
               <div class="modal-header bg-primary text-white">
                 <h4>Form Customer</h4>
               </div>
               <div class="modal-body">
                 <input type="hidden" name="action" id="action">
                 ID Customer
                 <input type="number" name="id_customer" id="id_customer" class="form-control" required/>
                 Nama
                 <input type="text" name="nama" id="nama" class="form-control" required/>
                 Alamat
                 <input type="text" name="alamat" id="alamat" class="form-control" required/>
                 Kontak
                 <input type="text" name="kontak" id="kontak" class="form-control" required/>
                 Username
                 <input type="text" name="username" id="username" class="form-control" required/>
                 Password
                 <input type="text" name="password" id="password" class="form-control" required/>
               </div>
               <div class="modal-footer">
                 <button type="button" class="btn btn-primary" data-dismiss="modal">
                   Tutup
                 </button>
                 <button type="submit" name="save_customer" class="btn btn-primary">
                   Simpan
                 </button>
               </div>
             </form>
           </div>
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