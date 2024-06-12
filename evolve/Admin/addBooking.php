<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal_booking = $_POST['tanggal_booking'];
    $jam_booking = $_POST['jam_booking'];
    $id_penyewa = $_POST['id_penyewa'];
    $id_lapangan = $_POST['id_lapangan'];
    $id_voucher = $_POST['id_voucher'];
    $tanggal_main = $_POST['tanggal_main'];
    $jam_mulai = $_POST['jam_mulai'];
    $lama = $_POST['lama'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $id_fasilitas = $_POST['id_fasilitas'];

    if (addBooking($conn, $tanggal_booking, $jam_booking, $id_penyewa, $id_lapangan, $id_voucher, $tanggal_main, $jam_mulai, $lama, $status_pembayaran, $id_fasilitas)) {
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
    <title>Add Booking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Booking</h1>
        <form action="addBooking.php" method="post">
            <div class="form-group">
                <label for="tanggal_booking">Tanggal Booking</label>
                <input type="date" class="form-control" id="tanggal_booking" name="tanggal_booking" required>
            </div>
            <div class="form-group">
                <label for="jam_booking">Jam Booking</label>
                <input type="time" class="form-control" id="jam_booking" name="jam_booking" required>
            </div>
            <div class="form-group">
                <label for="id_penyewa">ID Penyewa</label>
                <input type="number" class="form-control" id="id_penyewa" name="id_penyewa" required>
            </div>
            <div class="form-group">
                <label for="id_lapangan">ID Lapangan</label>
                <input type="number" class="form-control" id="id_lapangan" name="id_lapangan" required>
            </div>
            <div class="form-group">
                <label for="id_voucher">ID Voucher</label>
                <input type="number" class="form-control" id="id_voucher" name="id_voucher">
            </div>
            <div class="form-group">
                <label for="tanggal_main">Tanggal Main</label>
                <input type="date" class="form-control" id="tanggal_main" name="tanggal_main" required>
            </div>
            <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
            </div>
            <div class="form-group">
                <label for="lama">Lama</label>
                <input type="number" class="form-control" id="lama" name="lama" required>
            </div>
            <div class="form-group">
                <label for="status_pembayaran">Status Pembayaran</label>
                <input type="text" class="form-control" id="status_pembayaran" name="status_pembayaran" required>
            </div>
            <div class="form-group">
                <label for="id_fasilitas">ID Fasilitas</label>
                <input type="number" class="form-control" id="id_fasilitas" name="id_fasilitas">
            </div>
            <button type="submit" class="btn btn-primary">Add Booking</button>
        </form>
    </div>
</body>
</html>