<?php
session_start();

require 'koneksi.php';

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['sudah_login'])) {
    // Jika belum, redirect ke halaman login
    header("Location: login.php");
    exit;
}

// Query untuk memuat data gambar
$query = "SELECT * FROM webtoon";
$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk menyimpan data gambar
$webtoons = [];

// Periksa apakah query berhasil dieksekusi
if ($result && mysqli_num_rows($result) > 0) {
    // Ambil data gambar dan simpan dalam array
    while ($row = mysqli_fetch_assoc($result)) {
        $webtoons[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBTOONZ</title>
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

    <header id="header" class="header">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="#" class="logo d-flex align-items-center me-auto me-lg-0">
                <i class="bi bi-postage-heart-fill"></i>
                <h1>WEBTOONZ</h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="admin_dashboard.php" class="active">Home</a></li>
                    <li><a href="akun1.php">Akun</a></li>
                </ul>
            </nav>

            <div class="header-social-links">
                <a href="search1.php" class="search"><i class="bi bi-search-heart"></i></a>
                <a href="tambah_manhwa.php" class="tambah"><i class="bi bi-plus-square-fill"></i></a>
                <a href="hapus_manhwa.php" class="hapus"><i class="bi bi-trash3-fill"></i></a>
            </div>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        </div>
    </header>

    <main id="main" data-aos="fade" data-aos-delay="1500">

        <section id="spotlight" class="spotlight">
            <div class="container-fluid">                
                <div class="row gy-4 justify-content-center">
                    <?php foreach ($webtoons as $webtoon) : ?>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="spotlight-item h-100">
                                <a href="detail_manhwa.php?id=<?php echo $webtoon['id_webtoon']; ?>">
                                    <img src="images/<?php echo $webtoon['nama_gambar']; ?>" class="img-fluid" alt="">
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Script JS File -->
    <script src="assets/js/script.js"></script>

    <script src="https://unpkg.com/scrollreveal"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVFQWjvN2E5mKMksz5ETcuLtKC5qv8zTTGfxIrD0s7b4Fm0AiIw4" crossorigin="anonymous"></script>
    
</body>
</html>
