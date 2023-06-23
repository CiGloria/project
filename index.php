<!DOCTYPE html>
<html>
<head>
  <title>Web Keluarga</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .container {
      margin-top: 50px;
      background-image: url('<?php echo get_random_background(); ?>');
      background-size: cover;
      background-position: center;
      min-height: 100vh;
      padding: 20px;
    }
  </style>
</head>
<body>
    
  <div class="container">
    <h2>Web Keluarga</h2>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="diary.php">Diary</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dokumen.php">Dokumen</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="album.php">Album Foto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="indek.php">Logout</a>
      </li>
    </ul>

    <div class="tab-content">
      <div id="diary" class="tab-pane fade show active">
        <h3>Diary</h3>
        <?php include 'diary.php'; ?>
      </div>
      <div id="dokumen" class="tab-pane fade">
        <h3>Dokumen</h3>
        <?php include 'dokumen.php'; ?>
      </div>
      <div id="album" class="tab-pane fade">
        <h3>Album Foto</h3>
        <?php include 'album.php'; ?>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

  <?php
  function get_random_background() {
    $backgrounds = [
      'cart.jpg',
      'batak-.jpg',
      'tar.jpg',
      // Tambahkan background lainnya di sini
    ];
    $random_index = array_rand($backgrounds);
    return $backgrounds[$random_index];
  }
  ?>
</body>
</html>
