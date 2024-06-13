<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_penyewa = $_GET['id'];

    if (deleteVoucher($conn, $id_penyewa)) {
        echo "
        <script>
            alert('Penyewa deleted successfully');
            window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error deleting penyewa');
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

