<?php
include('../function.php');

if (isset($_GET['id_booking'])) {
    $id_booking = $_GET['id_booking'];

    $query = "SELECT * FROM booking WHERE id_booking = $id_booking";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $booking = mysqli_fetch_assoc($result);
    } else {
        echo "
        <script>
          alert('Data tidak ditemukan pada database');
          window.location='admin.php';
        </script>";
        return;
    }
} else {
    echo "
    <script>
      alert('Masukkan data id.');
      window.location='admin.php';
    </script>";
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_booking = $_POST['id_booking'];
    $id_penyewa = $_POST['id_penyewa'];
    $id_lapangan = $_POST['id_lapangan'];
    $id_fasilitas = $_POST['id_fasilitas'];
    $id_voucher = $_POST['id_voucher'];
    $tanggal_main = $_POST['tanggal_booking'];
    $jam_mulai = $_POST['jam_mulai'];
    $lama = $_POST['durasi_booking'];
    $status_pembayaran = $_POST['status_pembayaran'];

    if (updateBooking($conn, $id_booking, $id_penyewa, $id_lapangan,$id_fasilitas,$id_voucher, $tanggal_main, $jam_mulai, $lama, $status_pembayaran)) {
        echo "
        <script>
          alert('Booking updated successfully');
          window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
          alert('Error updating booking');
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
    <title>Update Booking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Update Booking</h1>
        <form action="updateBooking.php?id_booking=<?php echo $id_booking; ?>" method="post">
            <input type="hidden" name="id_booking" value="<?php echo $id_booking; ?>">
            <div class="form-group">
                <label for="id_penyewa">ID Penyewa</label>
                <input type="number" class="form-control" id="id_penyewa" name="id_penyewa" value="<?php echo $booking['id_penyewa']; ?>" required>
            </div>
            <div class="form-group">
                <label for="id_lapangan">ID Lapangan</label>
                <input type="number" class="form-control" id="id_lapangan" name="id_lapangan" value="<?php echo $booking['id_lapangan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="id_voucher">ID Voucher</label>
                <input type="number" class="form-control" id="id_voucher" name="id_voucher" value="<?php echo $booking['id_voucher']; ?>" required>
            </div>
            <div class="form-group">
                <label for="id_fasilitas">ID Fasilitas</label>
                <input type="number" class="form-control" id="id_fasilitas" name="id_fasilitas" value="<?php echo $booking['id_fasilitas']; ?>" required>
            </div>
           
            <div class="form-group">
                <label for="tanggal_booking">Tanggal Booking</label>
                <input type="date" class="form-control" id="tanggal_booking" name="tanggal_booking" value="<?php echo $booking['tanggal_booking']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="<?php echo $booking['jam_mulai']; ?>" required>
            </div>
            <div class="form-group">
                <label for="durasi_booking">Durasi Booking</label>
                <input type="number" class="form-control" id="durasi_booking" name="durasi_booking" value="<?php echo $booking['lama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status_pembayaran">Status_Pembayaran</label>
                <input type="text" class="form-control" id="status_pembayaran" name="status_pembayaran" value="<?php echo $booking['status_pembayaran']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Booking</button>
        </form>
    </div>
</body>
</html>
