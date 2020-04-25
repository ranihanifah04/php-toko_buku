<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Customer</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <style media="screen">
      body{
          background-image: url(gambar/BUKU.jpg);
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
          background-attachment: fixed;
      }
      .padding{
        padding-top: 13%;
      }
    </style>
  </head>
  <body>
    <div class="container padding">
      <center>
      <div class="card col-sm-5">
        <div class="card-header bg-dark text-white">
          <h4>Login Customer</h4>
        </div>
        <div class="card-body">
          <form action="proses_login_customer.php" method="post">
            Username
            <input type="text" name="username" class="form-control my-3" required/>
            Password
            <input type="password" name="password" class="form-control my-3" required/>
            <button type="submit" name="login_customer" class="btn btn-block btn-dark">
              Login
            </button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>