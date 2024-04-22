<?php
session_start();

// Membuat koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ukk_perpus";

// Membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Mengatur pengkodean karakter menjadi UTF-8
mysqli_set_charset($koneksi, 'utf8');

?>