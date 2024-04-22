<?php
class SQLLogger {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function log($message, $severity = 'info') {
        // Escape the message to prevent SQL injection
        $message = $this->db->real_escape_string($message);
        
        // Prepare the SQL statement
        $sql = "INSERT INTO logs (message, severity, created_at) VALUES ('$message', '$severity', NOW())";

        // Execute the SQL statement
        if ($this->db->query($sql) === TRUE) {
            echo "Log berhasil ditambahkan.";
        } else {
            echo "Error: " . $sql . "<br>" . $this->db->error;
        }
    }
}

// Contoh penggunaan dengan koneksi database yang sudah ada
$existing_db_connection = new mysqli('localhost', 'username', 'password', 'nama_database');
if ($existing_db_connection->connect_error) {
    die("Koneksi database gagal: " . $existing_db_connection->connect_error);
}

$logger = new SQLLogger($existing_db_connection);
$logger->log("Pesan log ini akan disimpan dalam database.");
