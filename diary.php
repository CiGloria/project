<?php
// Koneksi ke database
$koneksi = mysqli_connect("localhost", "root", "", "project");

if (mysqli_connect_errno()) {
  echo "Koneksi database gagal: " . mysqli_connect_error();
}

// Fungsi untuk menampilkan diary
function tampilkanDiary($koneksi)
{
  $query = "SELECT * FROM diary";
  $result = mysqli_query($koneksi, $query);

  if (mysqli_num_rows($result) > 0) {
    echo "<table class='table table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Judul</th>";
    echo "<th>Tanggal</th>";
    echo "<th>Isi</th>";
    echo "<th>Aksi</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['id_user'] . "</td>";
      echo "<td>" . $row['judul'] . "</td>";
      echo "<td>" . $row['tanggal'] . "</td>";
      echo "<td>" . $row['isi'] . "</td>";
      echo "<td><a href='hapus_diary.php?id=" . $row['id_user'] . "' class='btn btn-danger'>Hapus</a></td>";
      echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
  } else {
    echo "Tidak ada diary.";
  }
}

// Fungsi untuk menambahkan diary
function tambahDiary($koneksi, $judul, $tanggal, $isi)
{
  $isi = mysqli_real_escape_string($koneksi, $isi); // Melakukan escapting pada nilai $isi

  $query = "INSERT INTO diary (judul, tanggal, isi) VALUES ('$judul', '$tanggal', '$isi')";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<div class='alert alert-success'>Diary berhasil ditambahkan.</div>";
  } else {
    echo "<div class='alert alert-danger'>Error: " . mysqli_error($koneksi) . "</div>";
  }
}

// Fungsi untuk menghapus diary
function hapusDiary($koneksi, $id)
{
  $query = "DELETE FROM diary WHERE id = $id";
  $result = mysqli_query($koneksi, $query);

  if ($result) {
    echo "<div class='alert alert-success'>Diary berhasil dihapus.</div>";
  } else {
    echo "<div class='alert alert-danger'>Error: " . mysqli_error($koneksi) . "</div>";
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["tambah_diary"])) {
    $judul = $_POST["judul"];
    $tanggal = $_POST["tanggal"];
    $isi = $_POST["isi"];

    tambahDiary($koneksi, $judul, $tanggal, $isi);
  }
}

if (isset($_GET["hapus_diary"]) && isset($_GET["id"])) {
    $id = $_GET["id"];
  
    hapusDiary($koneksi, $id);
  }
  
?>

<div>
  <h4>Tambah Diary Baru</h4>
  <form action="" method="POST">
    <div class="form-group">
      <label>Judul</label>
      <input type="text" name="judul" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Tanggal</label>
      <input type="date" name="tanggal" class="form-control" required>
    </div>
    <div class="form-group">
      <label>Isi</label>
      <textarea name="isi" class="form-control" required></textarea>
    </div>
    <button type="submit" name="tambah_diary" class="btn btn-primary">Tambah</button>
  </form>
</div>

<div>
  <h4>Daftar Diary</h4>
  <?php tampilkanDiary($koneksi); ?>
</div>


