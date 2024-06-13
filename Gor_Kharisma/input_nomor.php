<?php
include('function.php'); // Pastikan include function.php di sini

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $no_telepon = $_POST['no_telepon'];

    // Menggunakan fungsi checkPhoneNumber untuk memeriksa nomor telepon
    $id_penyewa = checkPhoneNumber($conn, $no_telepon);

    if ($id_penyewa) {
        // Jika nomor telepon ditemukan, arahkan ke form booking dengan ID penyewa
        header("Location: booking_user.php?id_penyewa=$id_penyewa");
    } else {
        // Jika nomor telepon tidak ditemukan, arahkan ke form penyewa
        header("Location: ActionUser/registPenyewa.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Phone Number</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Enter Phone Number</h1>
        <form action="input_nomor.php" method="post">
            <div class="form-group">
                <label for="no_telepon">Phone Number</label>
                <input type="text" class="form-control" id="no_telepon" name="no_telepon" required>
            </div>
            <button type="submit" class="btn btn-primary">Check Phone Number</button>
        </form>
    </div>
</body>
</html>