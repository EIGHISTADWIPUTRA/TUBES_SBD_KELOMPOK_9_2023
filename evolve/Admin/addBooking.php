<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal_booking = $_POST['tanggal_booking'];
    $jam_booking = $_POST['jam_booking'];
    $id_penyewa = $_POST['id_penyewa'];
    $id_lapangan = $_POST['id_lapangan'];
    $id_voucher = $_POST['id_voucher'] ?: 0; // Default to 0 if no voucher selected
    $tanggal_main = $_POST['tanggal_main'];
    $jam_mulai = $_POST['jam_mulai'];
    $lama = $_POST['lama'];
    $status_pembayaran = $_POST['status_pembayaran'];
    $id_fasilitas = $_POST['id_fasilitas'] ?: 0; // Default to 0 if no facility selected

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

// Fetch options for select inputs using existing read functions
$penyewaOptions = readPenyewa($conn);
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
    </script>
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
                <select class="form-control" id="id_penyewa" name="id_penyewa" required>
                    <option value="">Select Penyewa</option>
                    <?php foreach ($penyewaOptions as $option) { ?>
                        <option value="<?= $option['id_penyewa'] ?>"><?= $option['nama_penyewa'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="id_lapangan">ID Lapangan</label>
                <select class="form-control" id="id_lapangan" name="id_lapangan" required>
                    <option value="">Select Lapangan</option>
                    <?php foreach ($lapanganOptions as $option) { ?>
                        <option value="<?= $option['id_lapangan'] ?>"><?= $option['nama_lapangan'] ?></option>
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
                        <option value="<?= $option['id_fasilitas'] ?>"><?= $option['nama_fasilitas'] ?></option>
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
                <label for="lama">Lama</label>
                <input type="number" class="form-control" id="lama" name="lama" required>
            </div>
            <div class="form-group">
                <label for="status_pembayaran">Status Pembayaran</label>
                <input type="text" class="form-control" id="status_pembayaran" name="status_pembayaran" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Booking</button>
        </form>
    </div>
</body>
</html>
