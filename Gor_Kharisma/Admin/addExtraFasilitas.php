<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_fasilitas = $_POST['nama_fasilitas'];
    $deskripsi_fasilitas = $_POST['deskripsi_fasilitas'];
    $harga_per_jam = $_POST['harga_per_jam'];

    if (addExtraFasilitas($conn, $nama_fasilitas, $deskripsi_fasilitas, $harga_per_jam)) {
        echo "
        <script>
            alert('Extra fasilitas added successfully');
            window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error adding extra fasilitas');
            window.location='admin.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Extra Fasilitas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Extra Fasilitas</h1>
        <form action="addExtraFasilitas.php" method="post">
            <div class="form-group">
                <label for="nama_fasilitas">Nama Fasilitas</label>
                <input type="text" class="form-control" id="nama_fasilitas" name="nama_fasilitas" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_fasilitas">Deskripsi Fasilitas</label>
                <input type="text" class="form-control" id="deskripsi_fasilitas" name="deskripsi_fasilitas" required>
            </div>
            <div class="form-group">
                <label for="harga_per_jam">Harga Per Jam</label>
                <input type="number" class="form-control" id="harga_per_jam" name="harga_per_jam" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Extra Fasilitas</button>
        </form>
    </div>
</body>
</html>
