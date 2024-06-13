<?php
include('../function.php');

$id_konfirmasi = $_GET['id_konfirmasi'] ?? '';

if ($id_konfirmasi) {
    // Fetch existing data based on id_konfirmasi
    $query = "SELECT * FROM konfirmasi_bayar WHERE id_konfirmasi = $id_konfirmasi";
    $result = mysqli_query($conn, $query);
    $konfirmasi = mysqli_fetch_assoc($result);

    if (!$konfirmasi) {
        echo "
        <script>
            alert('Data tidak ditemukan pada database');
            window.location='admin.php';
        </script>";
        exit;
    }
} else {
    echo "
    <script>
        alert('Masukkan data id.');
        window.location='admin.php';
    </script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_konfirmasi = $_POST['id_konfirmasi'];
    $id_booking = $_POST['id_booking'];
    $atas_nama = $_POST['atas_nama'];
    $bukti = $_POST['bukti'];
    $total = $_POST['total'];

    if (updateKonfirmasi($conn, $id_konfirmasi, $id_booking, $atas_nama, $bukti, $total)) {
        echo "
        <script>
            alert('Konfirmasi updated successfully');
            window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error updating konfirmasi');
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
    <title>Update Konfirmasi Bayar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Update Konfirmasi Bayar</h1>
        <form action="updateKonfirmasiBayar.php?id_konfirmasi=<?php echo $id_konfirmasi; ?>" method="post">
            <input type="hidden" name="id_konfirmasi" value="<?php echo $konfirmasi['id_konfirmasi']; ?>">
            <div class="form-group">
                <label for="id_booking">ID Booking</label>
                <input type="number" class="form-control" id="id_booking" name="id_booking" value="<?php echo $konfirmasi['id_booking']; ?>" required>
            </div>
            <div class="form-group">
                <label for="atas_nama">Atas Nama</label>
                <input type="text" class="form-control" id="atas_nama" name="atas_nama" value="<?php echo $konfirmasi['atas_nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="text" class="form-control" id="bukti" name="bukti" value="<?php echo $konfirmasi['bukti']; ?>" required>
            </div>
            <div class="form-group">
                <label for="total">Total</label>
                <input type="number" class="form-control" id="total" name="total" value="<?php echo $konfirmasi['total']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Konfirmasi Bayar</button>
        </form>
    </div>
</body>
</html>
