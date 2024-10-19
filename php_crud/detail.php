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

// Mendapatkan ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mendapatkan detail user berdasarkan ID
    $sql = "SELECT * FROM tb_users WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
    
    // Jika diminta gambar, kirim gambar sebagai respons
    if (isset($_GET['show_image'])) {
        header("Content-type: image/jpeg"); 
        echo $row['foto']; 
        exit; 
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 350px;
            width: 100%;
            padding: 20px;
            text-align: center;
        }
        .card-img-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        .card-img-top {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
        }
        .card-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .card-text {
            font-size: 1rem;
            color: #555;
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            font-size: 1rem;
            padding: 10px 20px;
            border-radius: 25px;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="card-img-container">
        
        <img src="detail.php?id=<?php echo $row['id']; ?>&show_image=1" class="card-img-top" alt="Foto User">
    </div>
    <div class="card-body">
        <h5 class="card-title"><?php echo $row['nama']; ?></h5>
        <p class="card-text"><strong>Jenis Kelamin:</strong> <?php echo $row['jenis_kelamin']; ?></p>
        <p class="card-text"><strong>No HP:</strong> <?php echo $row['nohp']; ?></p>
        <p class="card-text"><strong>Email:</strong> <?php echo $row['email']; ?></p>
        <p class="card-text"><strong>Alamat:</strong> <?php echo $row['alamat']; ?></p>
        <a href="index.php" class="btn btn-primary">Kembali</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
