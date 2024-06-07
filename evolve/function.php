<?php

include('config.php');

// Fungsi untuk membaca data dari tabel voucher
function readVouchers($conn) {
    $query = "SELECT * FROM voucher";
    $result = mysqli_query($conn, $query);
    $vouchers = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $vouchers[] = $row;
        }
    }
    return $vouchers;
}

// Fungsi untuk menambah data ke tabel voucher
function addVoucher($conn, $nama_voucher, $deskripsi_voucher, $tanggal_berlaku, $besar_diskon, $stok) {
    $query = "INSERT INTO voucher (nama_voucher, deskripsi_voucher, tanggal_berlaku, besar_diskon, stok) 
              VALUES ('$nama_voucher', '$deskripsi_voucher', '$tanggal_berlaku', '$besar_diskon', $stok)";
    return mysqli_query($conn, $query);
}

// Fungsi untuk menghapus data dari tabel voucher berdasarkan id_voucher
function deleteVoucher($conn, $id_voucher) {
    $query = "DELETE FROM voucher WHERE id_voucher = $id_voucher";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mengupdate data di tabel voucher berdasarkan id_voucher
function updateVoucher($conn, $id_voucher, $nama_voucher, $deskripsi_voucher, $tanggal_berlaku, $besar_diskon, $stok) {
    $query = "UPDATE voucher 
              SET nama_voucher = '$nama_voucher', deskripsi_voucher = '$deskripsi_voucher', tanggal_berlaku = '$tanggal_berlaku', 
                  besar_diskon = '$besar_diskon', stok = $stok 
              WHERE id_voucher = $id_voucher";
    return mysqli_query($conn, $query);
}
// Fungsi untuk membaca data dari tabel penyewa
function readPenyewa($conn) {
    $query = "SELECT * FROM penyewa";
    $result = mysqli_query($conn, $query);
    $penyewa = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $penyewa[] = $row;
        }
    }
    return $penyewa;
}
// Fungsi untuk menambah data ke tabel penyewa
function addPenyewa($conn, $nama_penyewa, $no_telepon_penyewa, $status_member) {
    $query = "INSERT INTO penyewa (nama_penyewa, no_telepon_penyewa, status_member) 
              VALUES ('$nama_penyewa', '$no_telepon_penyewa', '$status_member')";
    return mysqli_query($conn, $query);
}

// Fungsi untuk menghapus data dari tabel penyewa berdasarkan id_penyewa
function deletePenyewa($conn, $id_penyewa) {
    $query = "DELETE FROM penyewa WHERE id_penyewa = $id_penyewa";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mengupdate data di tabel penyewa berdasarkan id_penyewa
function updatePenyewa($conn, $id_penyewa, $nama_penyewa, $no_telepon_penyewa, $status_member) {
    $query = "UPDATE penyewa 
              SET nama_penyewa = '$nama_penyewa', no_telepon_penyewa = '$no_telepon_penyewa', status_member = '$status_member' 
              WHERE id_penyewa = $id_penyewa";
    return mysqli_query($conn, $query);
}
// Fungsi untuk membaca data dari tabel lapangan
function readLapangan($conn) {
    $query = "SELECT * FROM lapangan";
    $result = mysqli_query($conn, $query);
    $lapangan = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $lapangan[] = $row;
        }
    }
    return $lapangan;
}

// Fungsi untuk menambah data ke tabel lapangan
function addLapangan($conn, $nama_lapangan, $harga_lapangan, $deskripsi_lapangan) {
    $query = "INSERT INTO lapangan (nama_lapangan, harga_lapangan, deskripsi_lapangan) 
              VALUES ('$nama_lapangan', $harga_lapangan, '$deskripsi_lapangan')";
    return mysqli_query($conn, $query);
}

// Fungsi untuk menghapus data dari tabel lapangan berdasarkan id_lapangan
function deleteLapangan($conn, $id_lapangan) {
    $query = "DELETE FROM lapangan WHERE id_lapangan = $id_lapangan";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mengupdate data di tabel lapangan berdasarkan id_lapangan
function updateLapangan($conn, $id_lapangan, $nama_lapangan, $harga_lapangan, $deskripsi_lapangan) {
    $query = "UPDATE lapangan 
              SET nama_lapangan = '$nama_lapangan', harga_lapangan = $harga_lapangan, deskripsi_lapangan = '$deskripsi_lapangan' 
              WHERE id_lapangan = $id_lapangan";
    return mysqli_query($conn, $query);
}

// Fungsi untuk membaca data dari tabel konfirmasi bayar
function readKonfirmasi($conn) {
    $query = "SELECT * FROM konfirmasi_bayar";
    $result = mysqli_query($conn, $query);
    $konfirmasi = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $konfirmasi[] = $row;
        }
    }
    return $konfirmasi;
}

// Fungsi untuk menambah data ke tabel konfirmasi bayar
function addKonfirmasi($conn, $id_booking, $atas_nama, $bukti, $total) {
    $query = "INSERT INTO konfirmasi_bayar (id_booking, atas_nama, bukti, total) 
              VALUES ($id_booking, '$atas_nama', '$bukti', $total)";
    return mysqli_query($conn, $query);
}

// Fungsi untuk menghapus data dari tabel konfirmasi bayar berdasarkan id_konfirmasi
function deleteKonfirmasi($conn, $id_konfirmasi) {
    $query = "DELETE FROM konfirmasi_bayar WHERE id_konfirmasi = $id_konfirmasi";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mengupdate data di tabel konfirmasi bayar berdasarkan id_konfirmasi
function updateKonfirmasi($conn, $id_konfirmasi, $id_booking, $atas_nama, $bukti, $total) {
    $query = "UPDATE konfirmasi_bayar 
              SET id_booking = $id_booking, atas_nama = '$atas_nama', bukti = '$bukti', total = $total 
              WHERE id_konfirmasi = $id_konfirmasi";
    return mysqli_query($conn, $query);
}
// Fungsi untuk membaca data dari tabel booking
function readBooking($conn) {
    $query = "SELECT * FROM booking";
    $result = mysqli_query($conn, $query);
    $booking = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $booking[] = $row;
        }
    }
    return array_reverse($booking); // Membalikkan urutan data
}

// Fungsi untuk menambah data ke tabel booking
function addBooking($conn, $tanggal_booking, $jam_booking, $id_penyewa, $id_lapangan, $id_voucher, $tanggal_main, $jam_mulai, $lama, $status_pembayaran) {
    $query = "INSERT INTO booking (tanggal_booking, jam_booking, id_penyewa, id_lapangan, id_voucher, tanggal_main, jam_mulai, lama, status_pembayaran) 
              VALUES ('$tanggal_booking', '$jam_booking', '$id_penyewa', '$id_lapangan', '$id_voucher', '$tanggal_main', '$jam_mulai', '$lama', '$status_pembayaran')";
    return mysqli_query($conn, $query);
}

// Fungsi untuk menghapus data dari tabel booking
function deleteBooking($conn, $id_booking) {
    $query = "DELETE FROM booking WHERE id_booking = $id_booking";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mengupdate data di tabel booking
function updateBooking($conn, $id_booking, $tanggal_booking, $jam_booking, $id_penyewa, $id_lapangan, $id_voucher, $tanggal_main, $jam_mulai, $lama, $status_pembayaran) {
    $query = "UPDATE booking 
              SET tanggal_booking = '$tanggal_booking', jam_booking = '$jam_booking', id_penyewa = '$id_penyewa', id_lapangan = '$id_lapangan', id_voucher = '$id_voucher', tanggal_main = '$tanggal_main', jam_mulai = '$jam_mulai', lama = '$lama', status_pembayaran = '$status_pembayaran' 
              WHERE id_booking = $id_booking";
    return mysqli_query($conn, $query);
}

?>
