<?php
// Koneksi ke database
$host = "localhost";
$user = "firza933_deco";
$pass = "mjUAZA2.L2sNwSj";
$db   = "firza933_064	";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Proses input dari form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama    = htmlspecialchars($_POST['nama']);
    $cabang  = htmlspecialchars($_POST['cabang']);
    $dewasa  = intval($_POST['dewasa']);
    $anak    = intval($_POST['anak']);
    $tanggal = $_POST['tanggal'];

    $hargaDewasa = 50000;
    $hargaAnak   = 30000;

    $total = ($dewasa * $hargaDewasa) + ($anak * $hargaAnak);

    // Simpan ke database
    $sql = "INSERT INTO pemesanan (nama, cabang, dewasa, anak, tanggal, total) 
            VALUES ('$nama', '$cabang', '$dewasa', '$anak', '$tanggal', '$total')";

    if (!mysqli_query($conn, $sql)) {
        die("Gagal menyimpan data: " . mysqli_error($conn));
    }
}

// Ambil semua data untuk ditampilkan
$data = mysqli_query($conn, "SELECT * FROM pemesanan ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tiket Akuarium</title>
  <link rel="stylesheet" href="proses.css">
</head>
<body>

  <div class="tiket">
    <h2>✅ Tiket Berhasil Dipesan</h2>
    <p><strong>Nama:</strong> <?= $nama ?></p>
    <p><strong>Cabang:</strong> <?= $cabang ?></p>
    <p><strong>Tiket Dewasa:</strong> <?= $dewasa ?> x Rp50.000</p>
    <p><strong>Tiket Anak:</strong> <?= $anak ?> x Rp30.000</p>
    <p><strong>Tanggal Kunjungan:</strong> <?= $tanggal ?></p>
    <p><strong>Total Bayar:</strong> <span style="color:lime">Rp<?= number_format($total, 0, ',', '.') ?></span></p>
  </div>

  <a href="index.html" class="btn-back">⬅ Kembali ke Form</a>

  <div class="tabel-container">
    <h3>📋 Daftar Semua Pemesanan</h3>
    <table>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Cabang</th>
        <th>Dewasa</th>
        <th>Anak</th>
        <th>Tanggal</th>
        <th>Total Bayar</th>
      </tr>
      <?php
      $no = 1;
      while ($row = mysqli_fetch_assoc($data)) {
        echo "<tr>
                <td>{$no}</td>
                <td>".htmlspecialchars($row['Nama'])."</td>
                <td>{$row['Cabang']}</td>
                <td>{$row['Dewasa']}</td>
                <td>{$row['Anak']}</td>
                <td>{$row['Tanggal']}</td>
                <td>Rp" . number_format($row['Total'], 0, ',', '.') . "</td>
              </tr>";
        $no++;
      }
      ?>
    </table>
  </div>

</body>
</html>
