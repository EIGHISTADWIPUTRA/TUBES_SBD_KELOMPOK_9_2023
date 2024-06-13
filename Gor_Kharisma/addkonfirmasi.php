<?php
include('function.php');

// Fetch id_booking and total from GET parameters
$id_booking = isset($_GET['id_booking']) ? $_GET['id_booking'] : '';
$total = isset($_GET['total']) ? $_GET['total'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_booking = $_POST['id_booking'];
    $atas_nama = $_POST['atas_nama'];
    $bukti = $_FILES['bukti']['name'];
    $total = $_POST['total'];

    // Determine the directory to store the uploaded file
    $target_dir = dirname(__FILE__) . "/uploads/";

    // Ensure the directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    $target_file = $target_dir . basename($_FILES["bukti"]["name"]);

    // Move the uploaded file
    if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
        try {
            echo "<script> alert('Upload bukti pembayaran sukses'); </script>";
            
            // Add the payment confirmation
            if (addKonfirmasi($conn, $id_booking, $atas_nama, $bukti, $total)) {
                echo "<script>
                    alert('Konfirmasi added successfully');
                    window.location='index.php';
                </script>";
            } else {
                echo "<script>
                    alert('Error adding konfirmasi');
                    window.location='index.php';
                </script>";
            }
        } catch (Exception $e) {
            echo "<script>
                alert('Terjadi kesalahan: " . $e->getMessage() . "');
                window.location='index.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Gagal mengunggah bukti pembayaran');
            window.location='index.php';
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
        <form action="addkonfirmasi.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_booking" value="<?= htmlspecialchars($id_booking) ?>">
         
            <div class="form-group">
                <label for="id_booking_display">ID Booking</label>
                <input type="text" class="form-control" id="id_booking_display" value="<?= htmlspecialchars($id_booking) ?>" readonly>
            </div>
            <div class="form-group">
                <label for="atas_nama">Atas Nama</label>
                <input type="text" class="form-control" id="atas_nama" name="atas_nama" required>
            </div>
            <div class="form-group">
                <label for="bukti">Bukti</label>
                <input type="file" class="form-control" id="bukti" name="bukti" required>
            </div>
            <div class="form-group">
                <label for="total_display">Total</label>
                <input type="number" class="form-control" id="total_display" value="<?= htmlspecialchars($total) ?>" readonly>
            </div>   
            <input type="hidden" name="total" value="<?= htmlspecialchars($total) ?>">
            <button type="submit" class="btn btn-primary">Add Konfirmasi Bayar</button>
        </form>
    </div>
</body>
</html>
