<?php
session_start();

require 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    // Jika pengguna belum login, redirect ke halaman login
    header("Location: login.php");
    exit; // Pastikan untuk keluar dari skrip setelah melakukan redirect
}

// Ambil id_user dari sesi
$id_user = $_SESSION['id_user'];

// Query untuk mengambil data pengguna yang sedang login
$query = "SELECT * FROM pengguna WHERE id_user = $id_user";
$result = mysqli_query($koneksi, $query);

// Periksa apakah query berhasil dieksekusi
if ($result && mysqli_num_rows($result) > 0) {
    // Ambil data pengguna
    $pengguna = mysqli_fetch_assoc($result);
} else {
    // Handle jika data pengguna tidak ditemukan
    echo "Data pengguna tidak ditemukan.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBTOONZ - Akun</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">

    <!-- Style CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center  me-auto me-lg-0">
                <i class="bi bi-postage-heart-fill"></i>
                <h1>WEBTOONZ</h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="index.php" >Home</a></li>
                    <li><a href="library.php">Library</a></li>
                    <li><a href="akun.php" class="active">Akun</a></li>
                </ul>
            </nav>

            <div class="header-social-links">
                <a href="search.php" class="search"><i class="bi bi-search-heart"></i></a>
            </div>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header>

    <main id="main" data-aos="fade" data-aos-delay="1500">

        <section id="akun" class="akun">
            <div class="container">
                <div class="section-header">
                    <h2>Akunku</h2>
                </div>
                <div class="row gy-4 gx-lg-5">
                    <div class="col-lg-6">
                        <div class="akun-item">
                            <h3>Username</h3>
                            <h4><?= $pengguna['username']; ?></h4>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="akun-item">
                            <h3>Email</h3>
                            <h4><?= $pengguna['email']; ?></h4>
                        </div>
                    </div>
                </div>
                <div class="page-header d-flex align-items-center">
                    <div class="container position-relative">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-6 text-center">
                                <a class="cta-btn" href="logout.php">LOGOUT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer id="footer" class="footer">
        <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>WEBTOONZ</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="">Remanda Dheva</a>
        </div>
        </div>
    </footer>

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div id="preloader">
        <div class="line"></div>
    </div>

     <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/script.js"></script>

    <script src="https://unpkg.com/scrollreveal"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVFQWjvN2E5mKMksz5ETcuLtKC5qv8zTTGfxIrD0s7b4Fm0AiIw4" crossorigin="anonymous"></script>
    
</body>
</html>
