<?php

include('../function.php');

$listLapangan = readLapangan($conn);
$listBooking = readBooking($conn);
$listVouchers = readVouchers($conn);
$listPenyewa = readPenyewa($conn);
$listKonfirmasi = readKonfirmasi($conn);
$listExtraFasilitas = readExtraFasilitas($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel CRUD Bulutangkis</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .sidebar {
        position: sticky;
        top: 0;
        left: 0;
        height: 100vh;
        width: 200px;
        background-color: #f8f9fa;
        padding: 20px;
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-2 sidebar">
                <h4>Menu</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="#lapangan">Lapangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#booking">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#voucher">Voucher</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#penyewa">Penyewa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#konfirmasi">Konfirmasi Bayar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#fasilitas">Fasilitas</a>
                    </li>
                </ul>
            </div>
            <!-- Konten -->
            <div class="col-10">
                <div class="container mt-5">
                    <h1 class="text-center mb-4">Admin Panel CRUD Bulutangkis</h1>

                    <!-- Lapangan Section -->
                    <section id="lapangan">
                        <h2>Lapangan</h2>
                        <a href="addLapangan.php" class="btn btn-success mb-3">+ Add Lapangan</a>
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Lapangan</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor_baris = 1;
                                foreach($listLapangan as $lapangan){
                                ?>
                                <tr>
                                    <th scope="row"><?= $nomor_baris ?></th>
                                    <td><?= $lapangan['nama_lapangan'] ?></td>
                                    <td><?= $lapangan['harga_lapangan'] ?></td>
                                    <td><?= $lapangan['deskripsi_lapangan'] ?></td>
                                    <td>
                                        <a href="updateLapangan.php?id_lapangan=<?= $lapangan['id_lapangan'] ?>"
                                            class="link-warning"><i class="bi bi-pencil-square">Edit</i></a>
                                        <a href="deleteLapangan.php?id=<?= $lapangan['id_lapangan'] ?>"
                                            onclick="return confirm('Yakin Hapus?')" class="link-danger"><i
                                                class="bi bi-trash3">Delete</i></a>
                                    </td>
                                </tr>
                                <?php
                                $nomor_baris++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>

                    <section id="booking" class="mt-5">
                        <h2>Booking</h2>
                        <a href="addBooking.php" class="btn btn-success mb-3">+ Add Booking</a>
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pemesan</th>
                                    <th scope="col">Nama Lapangan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Waktu Mulai</th>
                                   
                                    <th scope="col">Lama</th>
                                    <th scope="col">Fasilitas</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
            $nomor_baris = 1;
            foreach($listBooking as $booking){
            ?>
                                <tr>
                                    <th scope="row"><?= $nomor_baris ?></th>
                                    <td><?= $booking['nama_pemesan'] ?></td>
                                    <td><?= $booking['nama_lapangan'] ?></td>
                                    <td><?= $booking['tanggal_main'] ?></td>
                                    <td><?= $booking['jam_mulai'] ?></td>
                                    <td><?= $booking['lama'] ?> jam</td>
                                    <td><?= $booking['nama_fasilitas'] ?></td>
                                    <!-- Assuming 'nama_fasilitas' contains the name of the facility -->
                                    <td><?= $booking['status_pembayaran'] ?></td>
                                    <td>
                                        <a href="updateBooking.php?id_booking=<?= $booking['id_booking'] ?>"
                                            class="link-warning"><i class="bi bi-pencil-square">Edit</i></a>
                                        <a href="deleteBooking.php?id=<?= $booking['id_booking'] ?>"
                                            onclick="return confirm('Yakin Hapus?')" class="link-danger"><i
                                                class="bi bi-trash3">Delete</i></a>
                                    </td>
                                </tr>
                                <?php
                                $nomor_baris++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>


                    <!-- Voucher Section -->
                    <section id="voucher" class="mt-5">
                        <h2>Voucher</h2>
                        <a href="addVoucher.php" class="btn btn-success mb-3">+ Add Voucher</a>
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Voucher</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Tanggal Berlaku</th>
                                    <th scope="col">Diskon</th>
                                    <th scope="col">code_voucher</th>
                            
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor_baris = 1;
                                foreach($listVouchers as $voucher){
                                ?>
                                <tr>
                                    <th scope="row"><?= $nomor_baris ?></th>
                                    <td><?= $voucher['nama_voucher'] ?></td>
                                    <td><?= $voucher['deskripsi_voucher'] ?></td>
                                    <td><?= $voucher['tanggal_berlaku'] ?></td>
                                    <td><?= $voucher['besar_diskon'] ?></td>
                                    <td><?= $voucher['code_voucher'] ?></td>
                                    <td>
                                        <a href="updateVoucher.php?id_voucher=<?= $voucher['id_voucher'] ?>"
                                            class="link-warning"><i class="bi bi-pencil-square">Edit</i></a>
                                        <a href="deleteVoucher.php?id=<?= $voucher['id_voucher'] ?>"
                                            onclick="return confirm('Yakin Hapus?')" class="link-danger"><i
                                                class="bi bi-trash3">Delete</i></a>
                                    </td>
                                </tr>
                                <?php
                                $nomor_baris++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>

                    <!-- Penyewa Section -->
                    <section id="penyewa" class="mt-5">
                        <h2>Penyewa</h2>
                        <a href="addPenyewa.php" class="btn btn-success mb-3">+ Add Penyewa</a>
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Penyewa</th>
                                    <th scope="col">No. Telepon</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor_baris = 1;
                                foreach($listPenyewa as $penyewa){
                                ?>
                                <tr>
                                    <th scope="row"><?= $nomor_baris ?></th>
                                    <td><?= $penyewa['nama_penyewa'] ?></td>
                                    <td><?= $penyewa['no_telepon_penyewa'] ?></td>
                                    
                                    <td>
                                        <a href="updatePenyewa.php?id_penyewa=<?= $penyewa['id_penyewa'] ?>"
                                            class="link-warning"><i class="bi bi-pencil-square">Edit</i></a>
                                        <a href="deletePenyewa.php?id=<?= $penyewa['id_penyewa'] ?>"
                                            onclick="return confirm('Yakin Hapus?')" class="link-danger"><i
                                                class="bi bi-trash3">Delete</i></a>
                                    </td>
                                </tr>
                                <?php
                                $nomor_baris++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>

                    <!-- Konfirmasi Bayar Section -->
                    <section id="konfirmasi" class="mt-5">
                        <h2>Konfirmasi Bayar</h2>
                        <a href="addKonfirmasiBayar.php" class="btn btn-success mb-3">+ Add Konfirmasi Bayar</a>
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">ID Booking</th>
                                    <th scope="col">Atas Nama</th>
                                    <th scope="col">Bukti</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor_baris = 1;
                                foreach($listKonfirmasi as $konfirmasi){
                                ?>
                                <tr>
                                    <th scope="row"><?= $nomor_baris ?></th>
                                    <td><?= $konfirmasi['id_booking'] ?></td>
                                    <td><?= $konfirmasi['atas_nama'] ?></td>
                                    <td><?= $konfirmasi['bukti'] ?></td>
                                    <td><?= $konfirmasi['total'] ?></td>
                                    <td>
                                        <a href="updateKonfirmasiBayar.php?id_konfirmasi=<?= $konfirmasi['id_konfirmasi'] ?>"
                                            class="link-warning"><i class="bi bi-pencil-square">Edit</i></a>
                                        <a href="deleteKonfirmasiBayar.php?id=<?= $konfirmasi['id_konfirmasi'] ?>"
                                            onclick="return confirm('Yakin Hapus?')" class="link-danger"><i
                                                class="bi bi-trash3">Delete</i></a>
                                    </td>
                                </tr>
                                <?php
                                $nomor_baris++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>

                    <!-- Fasilitas Section -->
                    <section id="fasilitas" class="mt-5">
                        <h2>Fasilitas</h2>
                        <a href="addExtraFasilitas.php" class="btn btn-success mb-3">+ Add Fasilitas</a>
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Fasilitas</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Harga per Jam</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $nomor_baris = 1;
                                foreach($listExtraFasilitas as $fasilitas){
                                ?>
                                <tr>
                                    <th scope="row"><?= $nomor_baris ?></th>
                                    <td><?= $fasilitas['nama_fasilitas'] ?></td>
                                    <td><?= $fasilitas['deskripsi_fasilitas'] ?></td>
                                    <td><?= $fasilitas['harga_per_jam'] ?></td>
                                    <td>
                                        <a href="updateExtraFasilitas.php?id_fasilitas=<?= $fasilitas['id_fasilitas'] ?>"
                                            class="link-warning"><i class="bi bi-pencil-square">Edit</i></a>
                                        <a href="deleteExtraFasilitas.php?id=<?= $fasilitas['id_fasilitas'] ?>"
                                            onclick="return confirm('Yakin Hapus?')" class="link-danger"><i
                                                class="bi bi-trash3">Delete</i></a>
                                    </td>
                                </tr>
                                <?php
                                $nomor_baris++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>