<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama     = htmlspecialchars($_POST['nama']);
    $tempat   = htmlspecialchars($_POST['tempat']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $jumlah   = intval($_POST['jumlah']);
    $tanggal  = $_POST['tanggal'];

    $sql = "INSERT INTO pemesanan (nama, tempat, kategori, jumlah, tanggal) 
            VALUES ('$nama', '$tempat', '$kategori', '$jumlah', '$tanggal')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['nama']     = $nama;
        $_SESSION['tempat']   = $tempat;
        $_SESSION['kategori'] = $kategori;
        $_SESSION['jumlah']   = $jumlah;
        $_SESSION['tanggal']  = $tanggal;

        header("Location: proses.php");
        exit();
    } else {
        echo "Gagal menyimpan: " . mysqli_error($conn);
    }
}
?>
