<?php
require 'Conection.php';
// session_start();

// // Memeriksa koneksi database
// if (!$db) {
//   die("Koneksi database gagal: " . mysqli_connect_error());
// } else {
//   echo "Koneksi database berhasil!";
// }

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username'");

  if (mysqli_num_rows($result) != 1) {
    $error = true;
    $error_message = "Username atau password salah.";
  } else {
    $row = mysqli_fetch_assoc($result);

    if (password_verify($password, $row["password"])) {
      header("Location: index.php");
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Halaman Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style2.css" />

</head>

<body>
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#273036" fill-opacity="1" d="M0,256L24,218.7C48,181,96,107,144,69.3C192,32,240,32,288,53.3C336,75,384,117,432,160C480,203,528,245,576,245.3C624,245,672,203,720,197.3C768,192,816,224,864,240C912,256,960,256,1008,224C1056,192,1104,128,1152,128C1200,128,1248,192,1296,181.3C1344,171,1392,85,1416,42.7L1440,0L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z"></path></svg>

  <?php if (isset($error)) : ?>
    <p class="error-message"><?php echo $error_message; ?></p>
  <?php endif; ?>

  <div class="container">
    <form action="" method="post" class="login-form">ssssss
      <h2>Welcome</h2>
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Username" name="username" required />
      </div>
      <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required />
      </div>
      <button type="submit" name="login">Log In</button>
      <a href="regis.php" class="signup-button">Sign Up</a>
    </form>
  </div>
</body>

</html>
