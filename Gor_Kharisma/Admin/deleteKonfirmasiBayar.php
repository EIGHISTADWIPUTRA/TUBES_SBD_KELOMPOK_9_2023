<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_konfirmasi = $_GET['id'];

    if (deleteKonfirmasi($conn, $id_konfirmasi)) {
        echo "
        <script>
            alert('Konfirmasi pemesanan deleted successfully');
            window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error deleting konfirmasi pemesanan');
            window.location='admin.php';
        </script>";
    }
} else {
    echo "
    <script>
        alert('Invalid request');
        window.location='admin.php';
    </script>";
}
?>
