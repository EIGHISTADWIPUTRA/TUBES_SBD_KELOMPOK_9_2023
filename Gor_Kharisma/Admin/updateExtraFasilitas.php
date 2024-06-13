<?php
include('../function.php');

$id_fasilitas = $_GET['id_fasilitas'] ?? '';

if ($id_fasilitas) {
    // Fetch existing data based on id_fasilitas
    $query = "SELECT * FROM extra_fasilitas WHERE id_fasilitas = $id_fasilitas";
    $result = mysqli_query($conn, $query);
    $fasilitas = mysqli_fetch_assoc($result);

    if (!$fasilitas) {
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
    $id_fasilitas = $_POST['id_fasilitas'];
    $nama_fasilitas = $_POST['nama_fasilitas'];
    $deskripsi_fasilitas = $_POST['deskripsi_fasilitas'];
    $harga_per_jam = $_POST['harga_per_jam'];

    if (updateExtraFasilitas($conn, $id_fasilitas, $nama_fasilitas, $deskripsi_fasilitas, $harga_per_jam)) {
        echo "
        <script>
            alert('Extra fasilitas updated successfully');
            window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error updating extra fasilitas');
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
    <title>Update Extra Fasilitas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Update Extra Fasilitas</h1>
        <form action="updateExtraFasilitas.php?id_fasilitas=<?php echo $id_fasilitas; ?>" method="post">
            <input type="hidden" name="id_fasilitas" value="<?php echo $fasilitas['id_fasilitas']; ?>">
            <div class="form-group">
                <label for="nama_fasilitas">Nama Fasilitas</label>
                <input type="text" class="form-control" id="nama_fasilitas" name="nama_fasilitas" value="<?php echo $fasilitas['nama_fasilitas']; ?>" required>
            </div>
            <div class="form-group">
                <label for="deskripsi_fasilitas">Deskripsi Fasilitas</label>
                <input type="text" class="form-control" id="deskripsi_fasilitas" name="deskripsi_fasilitas" value="<?php echo $fasilitas['deskripsi_fasilitas']; ?>" required>
            </div>
            <div class="form-group">
                <label for="harga_per_jam">Harga Per Jam</label>
                <input type="number" class="form-control" id="harga_per_jam" name="harga_per_jam" value="<?php echo $fasilitas['harga_per_jam']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Extra Fasilitas</button>
        </form>
    </div>
</body>
</html>
