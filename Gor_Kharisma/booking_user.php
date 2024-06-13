<!-- booking_user.php -->

<?php
include('function.php');

// Fetch id_penyewa from the URL if available
$id_penyewa_selected = isset($_GET['id_penyewa']) ? $_GET['id_penyewa'] : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal_booking = $_POST['tanggal_booking'];
    $jam_booking = $_POST['jam_booking'];
    $id_penyewa = $_POST['id_penyewa'];
    $id_lapangan = $_POST['id_lapangan'];
    $id_voucher = $_POST['id_voucher'] ?: 0;
    $tanggal_main = $_POST['tanggal_main'];
    $jam_mulai = $_POST['jam_mulai'];
    $lama = $_POST['lama'];
    $id_fasilitas = $_POST['id_fasilitas'] ?: 0;

    // Calculate jam_selesai
    $jam_mulai_parts = explode(':', $jam_mulai);
    $hours = intval($jam_mulai_parts[0]);
    $minutes = intval($jam_mulai_parts[1]);

    $end_hours = ($hours + $lama) % 24;
    $jam_selesai = sprintf('%02d:%02d', $end_hours, $minutes);

    $total = $_POST['total'];
    $status_pembayaran = 'pending'; // Example status, adjust as needed

    if (addBooking($conn, $tanggal_booking, $jam_booking, $id_penyewa, $id_lapangan, $id_voucher, $tanggal_main, $jam_mulai, $lama, $status_pembayaran, $id_fasilitas, $jam_selesai)) {
        // Get the last inserted ID, assuming your database connection variable is named $conn
        $id_booking = mysqli_insert_id($conn);

        // Redirect with success message and parameters
        header("Location: addKonfirmasi.php?id_booking=$id_booking&total=$total");
        exit();
    } else {
        // Handle error
        echo "
        <script>
            alert('Error adding booking');
            window.location='index.php';
        </script>";
    }
}

// Fetch options for select inputs using existing read functions
$readboking = readBooking($conn);
$lapanganOptions = readLapangan($conn);
$voucherOptions = readVouchers($conn);
$fasilitasOptions = readExtraFasilitas($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Booking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function toggleVoucherFasilitas() {
            var voucherSelect = document.getElementById('id_voucher');
            var fasilitasSelect = document.getElementById('id_fasilitas');
            var voucherYesNo = document.querySelector('input[name="voucher_yes_no"]:checked').value;
            var fasilitasYesNo = document.querySelector('input[name="fasilitas_yes_no"]:checked').value;

            voucherSelect.disabled = (voucherYesNo === 'no');
            fasilitasSelect.disabled = (fasilitasYesNo === 'no');

            if (voucherYesNo === 'no') {
                voucherSelect.value = 0;
            }
            if (fasilitasYesNo === 'no') {
                fasilitasSelect.value = 0;
            }
        }

        function calculateTotalAndEndTime() {
            var lapanganSelect = document.getElementById('id_lapangan');
            var fasilitasSelect = document.getElementById('id_fasilitas');
            var lamaInput = document.getElementById('lama');
            var totalInput = document.getElementById('total');
            var jamMulaiInput = document.getElementById('jam_mulai');
            var jamSelesaiInput = document.getElementById('jam_selesai');

            var hargaLapangan = parseFloat(lapanganSelect.options[lapanganSelect.selectedIndex].dataset.harga) || 0;
            var hargaFasilitas = parseFloat(fasilitasSelect.options[fasilitasSelect.selectedIndex].dataset.harga) || 0;
            var lama = parseFloat(lamaInput.value) || 0;

            var total = (hargaLapangan * lama) + (hargaFasilitas * lama);
            totalInput.value = total;

            var jamMulai = jamMulaiInput.value;
            if (jamMulai) {
                var parts = jamMulai.split(':');
                var hours = parseInt(parts[0]);
                var minutes = parseInt(parts[1]);
                var endHours = (hours + lama) % 24;
                var endTime = (endHours < 10 ? '0' : '') + endHours + ':' + (minutes < 10 ? '0' : '') + minutes;
                jamSelesaiInput.value = endTime;
            }
        }
    </script>
</head>
<body>
<div class="container mt-5">
    <h1>Jadwal yang Sudah Dibooking</h1>
    <div class="form-group">
                <label for="existingBookings">Lihat ebih Detai Untuk Jadwalnya Agar Wktu Main Anda Tidak Bertabrakan Dengan Jawdal Lainnya</label>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama </th>
                            <th>Tanggal Booking</th>
                            <th>Jam Booking</th>
                            <th>Tanggal Main</th>
                            <th>Jam Mulai</th>
                            <th>Lama (hours)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($readboking as $booking): ?>
                            <tr>
                                <td><?= $booking['nama_pemesan'] ?></td>
                                <td><?= $booking['tanggal_booking'] ?></td>
                                <td><?= $booking['jam_booking'] ?></td>
                                <td><?= $booking['tanggal_main'] ?></td>
                                <td><?= $booking['jam_mulai'] ?></td>
                                <td><?= $booking['lama'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            </div>
    <div class="container mt-5">
        <h1>Add Booking</h1>
        <form action="booking_user.php" method="post" oninput="calculateTotalAndEndTime()">
            <div class="form-group">
                <label for="tanggal_booking">Tanggal Booking</label>
                <input type="date" class="form-control" id="tanggal_booking" name="tanggal_booking" required>
            </div>
            <div class="form-group">
                <label for="jam_booking">Jam Booking</label>
                <input type="time" class="form-control" id="jam_booking" name="jam_booking" required>
            </div>
            <input type="hidden" id="id_penyewa" name="id_penyewa" value="<?= htmlspecialchars($id_penyewa_selected) ?>">
            <div class="form-group">
                <label for="id_lapangan">ID Lapangan</label>
                <select class="form-control" id="id_lapangan" name="id_lapangan" required>
                    <option value="">Select Lapangan</option>
                    <?php foreach ($lapanganOptions as $option) { ?>
                        <option value="<?= $option['id_lapangan'] ?>" data-harga="<?= $option['harga_lapangan'] ?>"><?= $option['nama_lapangan'] ?> - <?= $option['harga_lapangan'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Use Voucher?</label>
                <div>
                    <label><input type="radio" name="voucher_yes_no" value="yes" onclick="toggleVoucherFasilitas()" required> Yes</label>
                    <label><input type="radio" name="voucher_yes_no" value="no" onclick="toggleVoucherFasilitas()"> No</label>
                </div>
            </div>
            <div class="form-group">
                <label for="id_voucher">ID Voucher</label>
                <select class="form-control" id="id_voucher" name="id_voucher">
                    <option value="0">Select Voucher</option>
                    <?php foreach ($voucherOptions as $option) { ?>
                        <option value="<?= $option['id_voucher'] ?>"><?= $option['code_voucher'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Use Fasilitas?</label>
                <div>
                    <label><input type="radio" name="fasilitas_yes_no" value="yes" onclick="toggleVoucherFasilitas()" required> Yes</label>
                    <label><input type="radio" name="fasilitas_yes_no" value="no" onclick="toggleVoucherFasilitas()"> No</label>
                </div>
            </div>
            <div class="form-group">
                <label for="id_fasilitas">ID Fasilitas</label>
                <select class="form-control" id="id_fasilitas" name="id_fasilitas">
                    <option value="0">Select Fasilitas</option>
                    <?php foreach ($fasilitasOptions as $option) { ?>
                        <option value="<?= $option['id_fasilitas'] ?>" data-harga="<?= $option['harga_per_jam'] ?>"><?= $option['nama_fasilitas'] ?> - <?= $option['harga_per_jam'] ?></option>
                    <?php } ?>
                </select>
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
                <label for="lama">Lama (dalam jam)</label>
                <input type="number" class="form-control" id="lama" name="lama" required>
            </div>
            <div class="form-group">
                <label for="jam_selesai">Jam Selesai</label>
                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" readonly>
            </div>
            <input type="hidden" id="total" name="total">
            <button type="submit" class="btn btn-primary">Add Booking</button>
            <?php if (isset($id_penyewa_selected) && $id_penyewa_selected == 1): ?>
                <a href="Admin/admin.php" class="btn btn-secondary">Admin</a>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
