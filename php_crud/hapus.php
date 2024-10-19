<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_php";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah 'id' ada di URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Sanitasi ID sebagai bilangan bulat

    // Menghapus data dari tabel berdasarkan ID
    $sql = "DELETE FROM tb_users WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php"); // Redirect ke halaman utama setelah data dihapus
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan di URL!";
}

$conn->close();
?>
