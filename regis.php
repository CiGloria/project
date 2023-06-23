<?php

require 'Conection.php';

if (isset($_POST["register"])) {
  $username = strtolower(stripslashes($_POST["username"]));
  $password = mysqli_real_escape_string($conn, $_POST["password"]);
  $password2 = mysqli_real_escape_string($conn, $_POST["password2"]);

  //check Unique Username
  $result = mysqli_query($conn, "SELECT username FROM login WHERE username = '$username'");
  if (mysqli_fetch_assoc($result)) {
    echo "<script>
                alert('Username sudah terdaftar!');
            </script>";
    die;
  }

  if ($password !== $password2) {
    echo "<script>
            alert('Konfirm Password tidak sesuai!');
            document.location.href='regis.php';
            </script>";
            
     die;
  }
  //Encryption Password
  $password = password_hash($password, PASSWORD_DEFAULT);
  //Register to Database
  mysqli_query($conn, "INSERT INTO login VALUES('','$username','$password')");

  if (mysqli_affected_rows($conn) > 0) {
    echo "<script>
                alert('Akun Berhasil Dibuat!');
            </script>";
    header("Location: indek.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Regristrasi</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
  <section class="vh-100" style="background-color: #eee;">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                  <form class="mx-1 mx-md-4" action="" method="post">
                    <div class="form-floating flex-fill mb-3">
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                        <label for="username">Username </label>
                      </div>
                    <div class="form-floating flex-fill mb-3">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                      <label for="password">Password</label>
                    </div>
                    <div class="form-floating flex-fill mb-3">
                      <input type="password" class="form-control" id="password2" name="password2" placeholder="Confirm Password" required>
                      <label for="password2">Confirm Password</label>
                    </div>
                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                      <button type="submit" name="register" class="btn btn-primary btn-lg">Register</button>
                    </div>

                  </form>

                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                  <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" alt="Trendy Pants and Shoes" class="w-100 rounded-t-5 rounded-tr-lg-0 rounded-bl-lg-5" />

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- <h1>Regristrasi Akun</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username : </label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password : </label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="password2">Konfirm Password : </label>
                <input type="password" name="password2" id="password2">
            </li>
            <li>
                <button type="submit" name="register">Register !</button>
            </li>
        </ul>
    </form> -->

</body>
</html>