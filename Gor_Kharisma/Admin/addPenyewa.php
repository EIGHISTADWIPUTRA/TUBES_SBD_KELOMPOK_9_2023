<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_penyewa = $_POST['nama_penyewa'];
    $no_telepon_penyewa = $_POST['no_telepon_penyewa'];
    $status_member = $_POST['status_member'];

    if (addPenyewa($conn, $nama_penyewa, $no_telepon_penyewa, $status_member)) {
        echo "
        <script>
            alert('Booking added successfully');
            window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error adding booking');
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
    <title>Add Penyewa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Penyewa</h1>
        <form action="addPenyewa.php" method="post">
            <div class="form-group">
                <label for="nama_penyewa">Nama Penyewa</label>
                <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" required>
            </div>
            <div class="form-group">
                <label for="no_telepon_penyewa">No Telepon Penyewa</label>
                <input type="text" class="form-control" id="no_telepon_penyewa" name="no_telepon_penyewa" required>
            </div>
            <div class="form-group">
                <label for="status_member">Status Member</label>
                <input type="text" class="form-control" id="status_member" name="status_member" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Penyewa</button>
        </form>
    </div>
</body>
</html>
