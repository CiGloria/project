<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "project");

if (mysqli_connect_errno()) {
  echo "Koneksi database gagal: " . mysqli_connect_error();
}

// Fungsi untuk menambahkan album foto
function tambahAlbum($koneksi, $judul, $deskripsi, $foto)
{
  // Mengambil informasi file foto
  $namaFoto = $foto['name'];
  $tmpFoto = $foto['tmp_name'];
  $ukuranFoto = $foto['size'];
  $errorFoto = $foto['error'];

  // Memeriksa apakah file foto berhasil diupload
  if ($errorFoto === UPLOAD_ERR_OK) {
    // Memindahkan file foto ke folder tujuan
    $tujuan = 'folder_tujuan/' . basename($namaFoto);
    if (!file_exists('folder_tujuan')) {
      mkdir('folder_tujuan', 0777, true);
    }
    if (move_uploaded_file($tmpFoto, $tujuan)) {
      // Menyimpan informasi album ke database
      $query = "INSERT INTO album (judul, deskripsi, foto) VALUES ('$judul', '$deskripsi', '$tujuan')";
      $result = mysqli_query($koneksi, $query);

      if ($result) {
        echo "<div class='alert alert-success'>Album foto berhasil ditambahkan.</div>";
      } else {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($koneksi) . "</div>";
      }
    } else {
      echo "<div class='alert alert-danger'>Error: Gagal mengupload foto.</div>";
    }
  } else {
    echo "<div class='alert alert-danger'>Error: Terjadi kesalahan pada file foto.</div>";
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["tambah_album"])) {
    $judul = $_POST["judul"];
    $deskripsi = $_POST["deskripsi"];
    $foto = $_FILES["foto"];

    tambahAlbum($koneksi, $judul, $deskripsi, $foto);
  }
}
?>

<!DOCTYPE html>
<html>
<head>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    body {
      background-color: gainsboro;
    }
  </style>
</head>
<body>

<div class="container">
  <!-- <h2 class="bg-secondary text-white p-3 mb-3">Web Keluarga</h2>
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link" href="diary.php">Diary</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="dokumen.php">Dokumen</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="album.php">Album Foto</a>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" href="index.php">Home</a>
    </li>
  </ul>

  <div>
    <h4>Tambah Album Foto Baru</h4>
    <form action="" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" required></textarea>
      </div>
      <div class="form-group">
        <label>Upload Foto</label>
        <input type="file" name="foto" class="form-control-file" required>
      </div>
      <button type="submit" name="tambah_album" class="btn btn-primary">Tambah</button>
    </form>
  </div>

  <div>
    <h4 class="bg-secondary text-white p-2">Album Foto</h4>
    <?php
    $query = "SELECT * FROM album";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='card' style='width: 18rem; display: inline-block; margin: 10px;'>";
        echo "<img src='" . $row['foto'] . "' class='card-img-top' alt='Foto'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>" . $row['judul'] . "</h5>";
        echo "<p class='card-text'>" . $row['deskripsi'] . "</p>";
        echo "<a href='hapus_album.php?id=" . $row['id_user'] . "' class='btn btn-danger'>Hapus</a>";
        echo "</div>";
        echo "</div>";
      }
    } else {
      echo "Tidak ada album foto.";
    }
    ?>
  </div>
</div>
</body>
</html>
