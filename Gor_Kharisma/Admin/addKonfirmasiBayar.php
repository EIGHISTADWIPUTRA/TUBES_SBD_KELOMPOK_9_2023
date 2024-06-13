<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_booking = $_POST['id_booking'];
    $atas_nama = $_POST['atas_nama'];
    $total = $_POST['total'];

    // Directory to store uploaded files
    $target_dir = "../uploads/";

    // Ensure the directory exists
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Path of the file to be uploaded
    $target_file = $target_dir . basename($_FILES["bukti"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file is an actual image or fake image
    $check = getimagesize($_FILES["bukti"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "
        <script>
            alert('File is not an image.');
            window.location='admin.php';
        </script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["bukti"]["size"] > 500000) {
        echo "
        <script>
            alert('Sorry, your file is too large.');
            window.location='admin.php';
        </script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "
        <script>
            alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');
            window.location='admin.php';
        </script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "
        <script>
            alert('Sorry, your file was not uploaded.');
            window.location='admin.php';
        </script>";
    // If everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["bukti"]["tmp_name"], $target_file)) {
            $bukti = basename($_FILES["bukti"]["name"]);

            if (addKonfirmasi($conn, $id_booking, $atas_nama, $bukti, $total)) {
                echo "
                <script>
                    alert('Konfirmasi bayar added successfully');
                    window.location='admin.php';
                </script>";
            } else {
                echo "
                <script>
                    alert('Error adding konfirmasi bayar');
                    window.location='admin.php';
                </script>";
            }
        } else {
            echo "
            <script>
                alert('Sorry, there was an error uploading your file.');
                window.location='admin.php';
            </script>";
        }
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
        <form action="addKonfirmasiBayar.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="id_booking">ID Booking</label>
                <select class="form-control" id="id_booking" name="id_booking" required>
                    <option value="">Select Booking</option>
                    <?php foreach ($bookingOptions as $option) { ?>
                        <option value="<?= $option['id_booking'] ?>"><?= $option['id_booking'] ?> - <?= $option['nama_pemesan'] ?></option>
                    <?php } ?>
                </select>
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
                <label for="total">Total</label>
                <input type="number" class="form-control" id="total" name="total" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Konfirmasi Bayar</button>
        </form>
    </div>
</body>
</html>
