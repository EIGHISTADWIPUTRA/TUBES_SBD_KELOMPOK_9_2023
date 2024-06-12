<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lapangan = $_POST['nama_lapangan'];
    $harga_lapangan = $_POST['harga_lapangan'];
    $deskripsi_lapangan = $_POST['deskripsi_lapangan'];

    if (addLapangan($conn, $nama_lapangan, $harga_lapangan, $deskripsi_lapangan)) {
        // Jika berhasil menambahkan lapangan, arahkan kembali ke halaman admin
        header("Location: admin.php");
        exit(); // Penting untuk menghentikan eksekusi script setelah header diarahkan
    } else {
        // Jika terjadi kesalahan, tampilkan pesan error
        echo "Error adding lapangan";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lapangan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Lapangan</h1>
        <form action="addLapangan.php" method="post">
            <div class="form-group">
                <label for="nama_lapangan">Nama Lapangan</label>
                <input type="text" class="form-control" id="nama_lapangan" name="nama_lapangan" required>
            </div>
            <div class="form-group">
                <label for="harga_lapangan">Harga Lapangan</label>
                <input type="number" class="form-control" id="harga_lapangan" name="harga_lapangan" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_lapangan">Deskripsi Lapangan</label>
                <input type="text" class="form-control" id="deskripsi_lapangan" name="deskripsi_lapangan" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Lapangan</button>
        </form>
    </div>
</body>
</html>
