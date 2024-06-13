<?php
include('../function.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $id_booking = $_GET['id'];

    // Hapus entri terkait dari tabel konfirmasi_bayar
    if (deleteKonfirmasiByBookingId($conn, $id_booking)) {
        // Jika berhasil menghapus konfirmasi, lanjutkan menghapus booking
        if (deleteBooking($conn, $id_booking)) {
            echo "
            <script>
                alert('Booking deleted successfully');
                window.location='admin.php';
            </script>";
        } else {
            echo "
            <script>
                alert('Error deleting booking');
                window.location='admin.php';
            </script>";
        }
    } else {
        echo "
        <script>
            alert('Error deleting confirmation');
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