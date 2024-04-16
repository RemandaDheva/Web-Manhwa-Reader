<?php

require 'koneksi.php';

// Periksa apakah parameter id_webtoon ada dalam URL
if(isset($_GET['id'])) {
    // Ambil id_webtoon dari URL
    $id_webtoon = $_GET['id'];

    // Query untuk mengambil data webtoon berdasarkan id_webtoon
    $query = "SELECT * FROM webtoon WHERE id_webtoon = $id_webtoon";
    $result = mysqli_query($koneksi, $query);

    // Periksa apakah query berhasil dieksekusi
    if($result) {
        // Ambil data webtoon sebagai array asosiatif
        $webtoon = mysqli_fetch_assoc($result);

        // Pastikan data webtoon ditemukan
        if($webtoon) {
         
            // Ekstrak data webtoon
            $judul = $webtoon['judul'];
            $nama_gambar = $webtoon['nama_gambar']; 
            $genre = $webtoon['genre'];
            $penulis = $webtoon['penulis'];
            $illust = $webtoon['gambar'];
            $penerbit = $webtoon['penerbit'];
            $sinopsis = $webtoon['sinopsis'];

            // Path gambar webtoon
            $image = "images/$nama_gambar";
        }
    } else {
        // Jika tidak ada hasil, beri nilai default
        $judul = 'Webtoon Tidak Ditemukan';
        $genre = '-';
        $penulis = '-';
        $illust = '-';
        $penerbit = '-';
        $sinopsis = 'Detail webtoon tidak tersedia.';
        $image = ''; // Tidak ada gambar yang ditampilkan
    }
} else {
    // Jika tidak ada parameter id_webtoon dalam URL
    $judul = 'Webtoon Tidak Ditemukan';
    $genre = '-';
    $penulis = '-';
    $illust = '-';
    $penerbit = '-';
    $sinopsis = 'Detail webtoon tidak tersedia.';
    $image = ''; // Tidak ada gambar yang ditampilkan
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBTOONZ - Detail Manhwa<?php echo $judul; ?></title> <!-- Tambahkan judul webtoon -->
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
            <a href="#" class="logo d-flex align-items-center me-auto me-lg-0">
                <i class="bi bi-postage-heart-fill"></i>
                <h1>WEBTOONZ</h1>
            </a>
            <div class="header-social-links">
                <a href="admin_dashboard.php" class="search"><i class="bi bi-x-lg"></i></a>
                <br> 
                <a href="edit_manhwa.php?id=<?php echo $id_webtoon; ?>" class="edit"><i class="bi bi-pencil-square"></i></a>
            </div>
        </div>
    </header>
    
    <main id="main" data-aos="fade" data-aos-delay="1500">
        <section id="detail" class="detail">
            <div class="container">
                <div class="row gy-4 justify-content-center">
                    <div class="col-lg-4">
                        <img src="<?php echo $image; ?>" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-8 content">
                        <h2><?php echo $judul; ?></h2>

                        <div class="row">
                            <div class="col-lg-6">
                                <ul>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Genre:</strong> <span><?php echo $genre; ?></span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Penulis:</strong> <span><?php echo $penulis; ?></span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Gambar:</strong> <span><?php echo $illust; ?></span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Penerbit:</strong> <span><?php echo $penerbit; ?></span></li>
                                </ul>
                            </div>
                        </div>

                        <h4>Sinopsis</h4>
                        <p class="py-3"><?php echo nl2br($sinopsis); ?></p>
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
