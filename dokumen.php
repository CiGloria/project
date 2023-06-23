<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "project");

if (mysqli_connect_errno()) {
  echo "Koneksi database gagal: " . mysqli_connect_error();
}

// Fungsi untuk menampilkan dokumen
function tampilkanDokumen($koneksi)
{
  $query = "SELECT * FROM dokumen";
  $result = mysqli_query($koneksi, $query);

  if (mysqli_num_rows($result) > 0) {
    echo "<ul class='list-group'>";
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<li class='list-group-item'>" . $row['nama'] . " - <a href='hapus_dokumen.php?id=" . $row['id_user'] . "' class='btn btn-danger btn-sm'>Hapus</a></li>";
      echo "<img src='data:image/jpeg;base64," . base64_encode($row['dokumen_data']) . "' alt='Dokumen' class='img-thumbnail' />";
    }
    echo "</ul>";
  } else {
    echo "<p class='alert alert-info'>Tidak ada dokumen.</p>";
  }
}

// Fungsi untuk menambahkan dokumen
function tambahDokumen($koneksi, $nama, $dokumenData)
{
  $query = "INSERT INTO dokumen (nama, dokumen_data) VALUES ('$nama', '$dokumenData')";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<div class='alert alert-success'>Dokumen berhasil ditambahkan.</div>";
  } else {
    echo "<div class='alert alert-danger'>Error: " . mysqli_error($koneksi) . "</div>";
  }
}

// Fungsi untuk menghapus dokumen
function hapusDokumen($koneksi, $id)
{
  $query = "DELETE FROM dokumen WHERE id = $id";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<div class='alert alert-success'>Dokumen berhasil dihapus.</div>";
  } else {
    echo "<div class='alert alert-danger'>Error: " . mysqli_error($koneksi) . "</div>";
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["tambah_dokumen"])) {
    $nama = $_POST["nama"];
    $dokumenData = $_FILES["dokumen_data"]["tmp_name"];

    $dokumenData = addslashes(file_get_contents($dokumenData)); // Mengambil data dokumen dan melakukan escaping

    tambahDokumen($koneksi, $nama, $dokumenData);
  }
}

if (isset($_GET["hapus_dokumen"]) && !empty($_GET["id"])) {
    $id = $_GET["id"];
  
    hapusDokumen($koneksi, $id);
}
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document Management System</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
</head>

<body>
  <div class="container mt-5 bg-info">
    <div class="row">
      <div class="col-md-6">
        <a href="index.php" class="btn btn-primary">Home</a>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-6">
        <h4>Tambah Dokumen Baru</h4>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label>Nama Dokumen</label>
            <input type="text" name="nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label>File Dokumen</label>
            <input type="file" name="dokumen_data" class="form-control-file" required>
          </div>
          <button type="submit" name="tambah_dokumen" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-6">
        <h4>Daftar Dokumen</h4>
        <?php tampilkanDokumen($koneksi); ?>
      </div>
    </div>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
