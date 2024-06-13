<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_penyewa = $_POST['nama_penyewa'];
    $no_telepon_penyewa = $_POST['no_telepon_penyewa'];

    // Check for duplicates
    if (checkDuplicatePenyewa($conn, $nama_penyewa, $no_telepon_penyewa)) {
        echo "
        <script>
            alert('Penyewa already exists');
            window.location='../index.php';
        </script>";
    } else {
        // Add penyewa if not a duplicate
        if (addPenyewa($conn, $nama_penyewa, $no_telepon_penyewa)) {
            echo "
            <script>
                alert('Booking added successfully');
                window.location='../index.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Error adding booking');
                window.location='../index.php';
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Registrasi </h1>
        <form action="registPenyewa.php" method="post">
            <div class="form-group">
                <label for="nama_penyewa">Nama Penyewa</label>
                <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" required>
            </div>
            <div class="form-group">
                <label for="no_telepon_penyewa">No Telepon Penyewa</label>
                <input type="text" class="form-control" id="no_telepon_penyewa" name="no_telepon_penyewa" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Penyewa</button>
        </form>
    </div>
</body>
</html>
