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

        // Prepare the SQL statement
        $message = "Admin $adminUsername melakukan aktivitas: $activity.";
        $severity = 'info';
        $sql = "INSERT INTO logs (message, severity, created_at) VALUES ('$message', '$severity', NOW())";

        // Execute the SQL statement
        if ($this->db->query($sql) === TRUE) {
            echo "Log aktivitas admin berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $this->db->error;
        }
    }
}

// Contoh penggunaan dengan koneksi database yang sudah ada
$existing_db_connection = new mysqli('localhost', 'root', '', 'ukk_perpus');
if ($existing_db_connection->connect_error) {
    die("Koneksi database gagal: " . $existing_db_connection->connect_error);
}

$logger = new SQLLogger($existing_db_connection);

// Misalnya, jika admin dengan nama pengguna 'admin123' melakukan aktivitas 'Menambah buku'
$adminUsername = '';
$activity = 'Menambah buku';
$logger->logAdminActivity($adminUsername, $activity);
?>