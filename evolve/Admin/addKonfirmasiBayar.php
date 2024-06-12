<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_booking = $_POST['id_booking'];
    $atas_nama = $_POST['atas_nama'];
    $bukti = $_POST['bukti'];
    $total = $_POST['total'];

    if (addKonfirmasi($conn, $id_booking, $atas_nama, $bukti, $total)) {
        echo "
        <script>
            alert('Konfirmasi bayar added successfully');
            window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error adding konfirmasi bayar');
            window.location='admin.php';
        </script>";
    }
}

// Fetch options for select input using existing read function
$bookingOptions = readBooking($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Konfirmasi Bayar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Add Konfirmasi Bayar</h1>
        <form action="addKonfirmasiBayar.php" method="post">
            <div class="form-group">
                <label for="id_booking">ID Booking</label>
                <select class="form-control" id="id_booking" name="id_booking" required>
                    <option value="">Select Booking</option>
                    <?php foreach ($bookingOptions as $option) { ?>
                        <option value="<?= $option['id_booking'] ?>"><?= $option['id_booking'] ?> - <?= $option['nama_pemesan'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="atas_nama">Atas Nama</label>
                <input type="text" class="form-control" id="atas_nama" name="atas_nama" required>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="text" class="form-control" id="bukti" name="bukti" required>
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" class="form-control" id="total" name="total" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Konfirmasi Bayar</button>
        </form>
    </div>
</body>
</html>
