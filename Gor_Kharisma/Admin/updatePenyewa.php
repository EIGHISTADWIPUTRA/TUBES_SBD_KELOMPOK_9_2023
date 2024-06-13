<?php
include('../function.php');

if (isset($_GET['id_penyewa'])) {
    $id_penyewa = $_GET['id_penyewa'];

    $query = "SELECT * FROM penyewa WHERE id_penyewa = $id_penyewa";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $penyewa = mysqli_fetch_assoc($result);
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
    $id_penyewa = $_POST['id_penyewa'];
    $nama_penyewa = $_POST['nama_penyewa'];
    $no_telepon_penyewa = $_POST['no_telepon_penyewa'];
    $status_member = $_POST['status_member'];

    if (updatePenyewa($conn, $id_penyewa, $nama_penyewa, $no_telepon_penyewa, $status_member)) {
        echo "
        <script>
          alert('Penyewa updated successfully');
          window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
          alert('Error updating penyewa');
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
    <title>Update Penyewa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Update Penyewa</h1>
        <form action="updatePenyewa.php?id_penyewa=<?php echo $id_penyewa; ?>" method="post">
            <input type="hidden" name="id_penyewa" value="<?php echo $id_penyewa; ?>">
            <div class="form-group">
                <label for="nama_penyewa">Nama Penyewa</label>
                <input type="text" class="form-control" id="nama_penyewa" name="nama_penyewa" value="<?php echo $penyewa['nama_penyewa']; ?>" required>
            </div>
            <div class="form-group">
                <label for="no_telepon_penyewa">No Telepon Penyewa</label>
                <input type="text" class="form-control" id="no_telepon_penyewa" name="no_telepon_penyewa" value="<?php echo $penyewa['no_telepon_penyewa']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status_member">Status Member</label>
                <input type="text" class="form-control" id="status_member" name="status_member" value="<?php echo $penyewa['status_member']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Penyewa</button>
        </form>
    </div>
</body>
</html>
