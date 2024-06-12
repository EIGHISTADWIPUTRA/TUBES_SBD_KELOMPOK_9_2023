<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_fasilitas = $_GET['id'];

    if (deleteExtraFasilitas($conn, $id_fasilitas)) {
        echo "
        <script>
            alert('Extra fasilitas deleted successfully');
            window.location='admin.php';
        </script>";
    } else {
        echo "
        <script>
            alert('Error deleting extra fasilitas');
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
