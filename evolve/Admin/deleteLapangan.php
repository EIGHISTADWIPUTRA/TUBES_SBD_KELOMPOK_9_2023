<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_lapangan = $_GET['id'];

    if (deleteLapangan($conn, $id_lapangan)) {
        echo "
        <script>
            alert('Lapangan deleted successfully');
            window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error deleting lapangan');
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
