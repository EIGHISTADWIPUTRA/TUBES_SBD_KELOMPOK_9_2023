<?php
include('../function.php');

if (isset($_GET['id_voucher'])) {
    $id_voucher = $_GET['id_voucher'];

    $query = "SELECT * FROM voucher WHERE id_voucher = $id_voucher";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $voucher = mysqli_fetch_assoc($result);
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
    $id_voucher = $_POST['id_voucher'];
    $nama_voucher = $_POST['nama_voucher'];
    $deskripsi_voucher = $_POST['deskripsi_voucher'];
    $tanggal_berlaku = $_POST['tanggal_berlaku'];
    $besar_diskon = $_POST['besar_diskon'];
    $stok = $_POST['stok'];

    if (updateVoucher($conn, $id_voucher, $nama_voucher, $deskripsi_voucher, $tanggal_berlaku, $besar_diskon, $stok)) {
        echo "
        <script>
          alert('Voucher updated successfully');
          window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
          alert('Error updating voucher');
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
    <title>Update Voucher</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Update Voucher</h1>
        <form action="updateVoucher.php?id_voucher=<?php echo $id_voucher; ?>" method="post">
            <input type="hidden" name="id_voucher" value="<?php echo $id_voucher; ?>">
            <div class="form-group">
                <label for="nama_voucher">Nama Voucher</label>
                <input type="text" class="form-control" id="nama_voucher" name="nama_voucher" value="<?php echo $voucher['nama_voucher']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_voucher">Deskripsi Voucher</label>
                <input type="text" class="form-control" id="deskripsi_voucher" name="deskripsi_voucher" value="<?php echo $voucher['deskripsi_voucher']; ?>" required>
            </div>
            <div class="form-group">
                <label for="tanggal_berlaku">Tanggal Berlaku</label>
                <input type="date" class="form-control" id="tanggal_berlaku" name="tanggal_berlaku" value="<?php echo $voucher['tanggal_berlaku']; ?>" required>
            </div>
            <div class="form-group">
                <label for="besar_diskon">Besar Diskon</label>
                <input type="number" class="form-control" id="besar_diskon" name="besar_diskon" value="<?php echo $voucher['besar_diskon']; ?>" required>
            </div>
            <div class="form-group">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" value="<?php echo $voucher['stok']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Voucher</button>
        </form>
    </div>
</body>
</html>
