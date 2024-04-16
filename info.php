<?php
session_start();

require 'koneksi.php';

// Ambil nama gambar webtoon dari parameter URL
$nama_gambar = $_GET['gambar'] ?? null;

// Query untuk memuat data gambar webtoon berdasarkan nama gambar
$query = "SELECT * FROM webtoon WHERE nama_gambar = '$nama_gambar'";
$result = mysqli_query($koneksi, $query);

// Periksa apakah query berhasil dieksekusi dan apakah data ditemukan
if ($result && mysqli_num_rows($result) > 0) {
    $webtoon = mysqli_fetch_assoc($result);
} else {
    // Redirect ke halaman library jika data tidak ditemukan
    header("Location: library.php");
    exit;
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

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center  me-auto me-lg-0">
                <i class="bi bi-postage-heart-fill"></i>
                <h1>WEBTOONZ</h1>
            </a>

            <div class="header-social-links">
                <a href="library.php" class="search"><i class="bi bi-x-lg"></i></a>
            </div>
        </div>
    </header>

    <main id="main" data-aos="fade" data-aos-delay="1500">
        <section id="info" class="info">
            <div class="container">
                <h2>Detail Manhwa</h2>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="spotlight-item">
                            <img src="images/<?php echo $webtoon['nama_gambar']; ?>" class="img-fluid" alt="">
                        </div>
                        <div class="col-lg-8 content">
                            <h2><?php echo $webtoon['judul']; ?></h2>

                            <div class="row">
                                <div class="col-lg-6">
                                    <ul>
                                        <li><i class="bi bi-chevron-right"></i> <strong>Genre:</strong> <span><?php echo $webtoon['genre']; ?></span></li>
                                        <li><i class="bi bi-chevron-right"></i> <strong>Penulis:</strong> <span><?php echo $webtoon['penulis']; ?></span></li>
                                        <li><i class="bi bi-chevron-right"></i> <strong>Gambar:</strong> <span><?php echo $webtoon['gambar']; ?></span></li>
                                        <li><i class="bi bi-chevron-right"></i> <strong>Penerbit:</strong> <span><?php echo $webtoon['penerbit']; ?></span></li>
                                    </ul>
                                </div>
                            </div>

                            <h4>Sinopsis</h4>
                            <p><?php echo nl2br($webtoon['sinopsis']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
    
    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/script.js"></script>

    <script src="https://unpkg.com/scrollreveal"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVFQWjvN2E5mKMksz5ETcuLtKC5qv8zTTGfxIrD0s7b4Fm0AiIw4" crossorigin="anonymous"></script>
    
</body>
</html>
