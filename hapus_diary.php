<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "project");

if (mysqli_connect_errno()) {
  echo "Koneksi database gagal: " . mysqli_connect_error();
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $query = "DELETE FROM diary WHERE id_user = $id";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    header("Location: index.php");
    exit();
  } else {
    echo "Error: " . mysqli_error($koneksi);
  }
}
?>
