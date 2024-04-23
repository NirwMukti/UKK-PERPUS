<?php
class SQLLogger {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function logAdminActivity($adminUsername, $activity) {
        // Escape the username and activity to prevent SQL injection
        $adminUsername = $this->db->real_escape_string($adminUsername);
        $activity = $this->db->real_escape_string($activity);

        // Menyiapkan statement sql
        $message = "Admin $adminUsername melakukan aktivitas: $activity.";
        $severity = 'info';
        $sql = "INSERT INTO logs (message, severity, created_at) VALUES ('$message', '$severity', NOW())";

        // Eksekusi dari kode syntax sql
        if ($this->db->query($sql) === TRUE) {
            echo "Log aktivitas admin berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $this->db->error;
        }
    }
}

// Contoh penggunaan dengan koneksi database yang sudah ada
$koneksi = new mysqli('localhost', 'root', '', 'ukk_perpus');
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

$logger = new SQLLogger($koneksi);

// Misalnya, jika admin dengan nama pengguna 'admin123' melakukan aktivitas 'Menambah buku'
$adminUsername = '';
$activity = 'Menambah buku';
$logger->logAdminActivity($adminUsername, $activity);
?>