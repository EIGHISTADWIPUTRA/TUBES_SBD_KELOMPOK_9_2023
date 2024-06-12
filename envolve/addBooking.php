<?php
include('config.php');
include('function.php');

// Cek koneksi database
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$lapangan = readLapangan($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>evolve</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
    <!-- Tweaks for older IEs-->
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!-- body -->
<body class="main-layout">
<!-- loader  -->
<div class="loader_bg">
    <div class="loader"><img src="images/loading.gif" alt="#" /></div>
</div>
<!-- end loader -->
<!-- header -->
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>
<!-- end header inner -->
<!-- end header -->

<!-- Formulir Booking untuk Pengguna -->
<section class="booking_form">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Formulir Booking Lapangan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="process_booking.php">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="tanggal_main">Tanggal Main:</label>
                            <input type="date" id="tanggal_main" class="form-control" name="tanggal_main" required>
                        </div>
                        <div class="col-md-6">
                            <label for="jam_mulai">Jam Mulai:</label>
                            <input type="time" id="jam_mulai" class="form-control" name="jam_mulai" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lama">Lama Main (Jam):</label>
                            <input type="number" id="lama" class="form-control" name="lama" placeholder="Contoh: 2" required>
                        </div>
                        <div class="col-md-6">
                            <label for="status_pembayaran">Status Pembayaran:</label>
                            <select id="status_pembayaran" class="form-control" name="status_pembayaran" required>
                                <option value="">Pilih Status Pembayaran</option>
                                <option value="Lunas">Lunas</option>
                                <option value="Belum Lunas">Belum Lunas</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="nama_penyewa">Nama Penyewa:</label>
                            <input type="text" id="nama_penyewa" class="form-control" name="nama_penyewa" placeholder="Masukkan Nama Anda" required>
                        </div>
                        <div class="col-md-6">
                            <label for="no_telepon">Nomor Telepon:</label>
                            <input type="tel" id="no_telepon" class="form-control" name="no_telepon" placeholder="Masukkan Nomor Telepon Anda" required>
                        </div>
                        <div class="col-md-12">
                            <label for="lapangan">Pilih Lapangan:</label>
                            <select id="lapangan" class="form-control" name="id_lapangan" required>
                                <option value="">Pilih Lapangan</option>
                                <?php
                                foreach ($lapangan as $data) {
                                    echo "<option value='" . $data['id_lapangan'] . "'>" . $data['nama_lapangan'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<!--  footer -->
<footer>
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="cont">
                        <h3> <span class="multi">Free Multipurpose </span> <br> Responsive Landing Page 2019</h3>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is </p>
                    </div>
                    <form class="bottom_form">
                        <input class="enter" placeholder="Enter your email" type="text" name="Enter your email">
                        <button class="sub_btn">subscribe</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>© 2019 All Rights Reserved. Design by <a href="https://html.design/"> Free Html Templates</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
<!-- Javascript files-->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- sidebar -->
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
</body>
</html>
