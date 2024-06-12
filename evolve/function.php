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
    // Query untuk mengambil data booking dengan informasi tambahan
    $query = "SELECT booking.*, 
              voucher.nama_voucher AS nama_voucher,
              lapangan.nama_lapangan AS nama_lapangan,
              extra_fasilitas.nama_fasilitas AS nama_fasilitas,
              penyewa.nama_penyewa AS nama_pemesan
              FROM booking
              LEFT JOIN voucher ON booking.id_voucher = voucher.id_voucher
              LEFT JOIN lapangan ON booking.id_lapangan = lapangan.id_lapangan
              LEFT JOIN extra_fasilitas ON booking.id_fasilitas = extra_fasilitas.id_fasilitas
              LEFT JOIN penyewa ON booking.id_penyewa = penyewa.id_penyewa";
              
    // Eksekusi query
    $result = mysqli_query($conn, $query);
    $booking = []; // Inisialisasi array untuk menyimpan data booking

    // Cek apakah query berhasil dieksekusi
    if ($result) {
        // Loop melalui hasil query dan tambahkan ke dalam array booking
        while ($row = mysqli_fetch_assoc($result)) {
            $booking[] = $row;
        }
    }
    return array_reverse($booking); // Membalikkan urutan data
}
// Fungsi untuk menambah data ke tabel booking
function addBooking($conn, $tanggal_booking, $jam_booking, $id_penyewa, $id_lapangan, $id_voucher, $tanggal_main, $jam_mulai, $lama, $status_pembayaran, $id_fasilitas) {
    $query = "INSERT INTO booking (tanggal_booking, jam_booking, id_penyewa, id_lapangan, id_voucher, tanggal_main, jam_mulai, lama, status_pembayaran, id_fasilitas) 
              VALUES ('$tanggal_booking', '$jam_booking', '$id_penyewa', '$id_lapangan', '$id_voucher', '$tanggal_main', '$jam_mulai', '$lama', '$status_pembayaran', '$id_fasilitas')";
    return mysqli_query($conn, $query);
}

// Fungsi untuk menghapus data dari tabel booking
function deleteBooking($conn, $id_booking) {
    $query = "DELETE FROM booking WHERE id_booking = $id_booking";
    return mysqli_query($conn, $query);
}

// Fungsi untuk menghapus entri konfirmasi berdasarkan id_booking
function deleteKonfirmasiByBookingId($conn, $id_booking) {
    // Query untuk mengupdate id_booking menjadi 0 pada tabel konfirmasi_bayar
    $query = "UPDATE konfirmasi_bayar SET id_booking = 0 WHERE id_booking = $id_booking";

    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika berhasil, kembalikan true
        return true;
    } else {
        // Jika gagal, kembalikan false
        return false;
    }
}
// Fungsi untuk mengupdate data di tabel booking
function updateBooking($conn, $id_booking, $id_penyewa, $id_lapangan,$id_fasilitas,$id_voucher, $tanggal_main, $jam_mulai, $lama, $status_pembayaran) {
    $query = "UPDATE booking 
              SET tanggal_main = '$tanggal_main', id_penyewa = '$id_penyewa', id_lapangan = '$id_lapangan', id_voucher = '$id_voucher', tanggal_main = '$tanggal_main', jam_mulai = '$jam_mulai', lama = '$lama', status_pembayaran = '$status_pembayaran', id_fasilitas = '$id_fasilitas'
              WHERE id_booking = $id_booking";
    return mysqli_query($conn, $query);
}

// Fungsi untuk membaca data dari tabel extra_fasilitas
function readExtraFasilitas($conn) {
    $query = "SELECT * FROM extra_fasilitas";
    $result = mysqli_query($conn, $query);
    $extra_fasilitas = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $extra_fasilitas[] = $row;
        }
    }
    return $extra_fasilitas;
}

// Fungsi untuk menambah data ke tabel extra_fasilitas
function addExtraFasilitas($conn, $nama_fasilitas, $deskripsi_fasilitas, $harga_per_jam) {
    $query = "INSERT INTO extra_fasilitas (nama_fasilitas, deskripsi_fasilitas, harga_per_jam) 
              VALUES ('$nama_fasilitas', '$deskripsi_fasilitas', $harga_per_jam)";
    return mysqli_query($conn, $query);
}

// Fungsi untuk menghapus data dari tabel extra_fasilitas berdasarkan id_fasilitas
function deleteExtraFasilitas($conn, $id_fasilitas) {
    $query = "DELETE FROM extra_fasilitas WHERE id_fasilitas = $id_fasilitas";
    return mysqli_query($conn, $query);
}

// Fungsi untuk mengupdate data di tabel extra_fasilitas berdasarkan id_fasilitas
function updateExtraFasilitas($conn, $id_fasilitas, $nama_fasilitas, $deskripsi_fasilitas, $harga_per_jam) {
    $query = "UPDATE extra_fasilitas 
              SET nama_fasilitas = '$nama_fasilitas', deskripsi_fasilitas = '$deskripsi_fasilitas', harga_per_jam = $harga_per_jam 
              WHERE id_fasilitas = $id_fasilitas";
    return mysqli_query($conn, $query);
}
?>
