<?php
include('../function.php');

if (isset($_GET['id_lapangan'])) {
    $id_lapangan = $_GET['id_lapangan'];

    $query = "SELECT * FROM lapangan WHERE id_lapangan = $id_lapangan";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $lapangan = mysqli_fetch_assoc($result);
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
    $id_lapangan = $_POST['id_lapangan'];
    $nama_lapangan = $_POST['nama_lapangan'];
    $harga_lapangan = $_POST['harga_lapangan'];
    $deskripsi_lapangan = $_POST['deskripsi_lapangan'];

    if (updateLapangan($conn, $id_lapangan, $nama_lapangan, $harga_lapangan, $deskripsi_lapangan)) {
        echo "
        <script>
          alert('Lapangan updated successfully');
          window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
          alert('Error updating lapangan');
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
    <title>Update Lapangan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Update Lapangan</h1>
        <form action="updateLapangan.php?id_lapangan=<?php echo $id_lapangan; ?>" method="post">
            <input type="hidden" name="id_lapangan" value="<?php echo $id_lapangan; ?>">
            <div class="form-group">
                <label for="nama_lapangan">Nama Lapangan</label>
                <input type="text" class="form-control" id="nama_lapangan" name="nama_lapangan" value="<?php echo $lapangan['nama_lapangan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_lapangan">Harga Lapangan</label>
                <input type="number" class="form-control" id="harga_lapangan" name="harga_lapangan" value="<?php echo $lapangan['harga_lapangan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_lapangan">Deskripsi Lapangan</label>
                <input type="text" class="form-control" id="deskripsi_lapangan" name="deskripsi_lapangan" value="<?php echo $lapangan['deskripsi_lapangan']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Lapangan</button>
        </form>
    </div>
</body>
</html>
