
<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_voucher = $_POST['nama_voucher'];
    $deskripsi_voucher = $_POST['deskripsi_voucher'];
    $tanggal_berlaku = $_POST['tanggal_berlaku'];
    $besar_diskon = $_POST['besar_diskon'];
    $stok = $_POST['stok'];

    if (addVoucher($conn, $nama_voucher, $deskripsi_voucher, $tanggal_berlaku, $besar_diskon, $stok)) {
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
    <title>Add Voucher</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Voucher</h1>
        <form action="addVoucher.php" method="post">
            <div class="form-group">
                <label for="nama_voucher">Nama Voucher</label>
                <input type="text" class="form-control" id="nama_voucher" name="nama_voucher" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_voucher">Deskripsi Voucher</label>
                <input type="text" class="form-control" id="deskripsi_voucher" name="deskripsi_voucher" required>
            </div>
            <div class="form-group">
                <label for="tanggal_berlaku">Tanggal Berlaku</label>
                <input type="date" class="form-control" id="tanggal_berlaku" name="tanggal_berlaku" required>
            </div>
            <div class="form-group">
                <label for="besar_diskon">Besar Diskon</label>
                <input type="number" class="form-control" id="besar_diskon" name="besar_diskon" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Voucher</button>
        </form>
    </div>
</body>
</html>
