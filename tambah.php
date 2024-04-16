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
$query = "SELECT * FROM webtoon w WHERE NOT EXISTS (
    SELECT 1 FROM favorit f WHERE f.id_user = {$_SESSION['id_user']} AND f.id_webtoon = w.id_webtoon)";
$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk menyimpan data gambar
$gambar_webtoon = [];

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ambil data gambar dan simpan dalam array
    while ($row = mysqli_fetch_assoc($result)) {
        $gambar_webtoon[] = $row;
    }
}

// Jika formulir disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil id_user dari sesi
    $id_user = $_SESSION['id_user'];

    // Periksa apakah gambar webtoon dipilih
    if (!empty($_POST['id_webtoon'])) {
        // Loop untuk setiap id_webtoon yang dipilih
        foreach ($_POST['id_webtoon'] as $id_webtoon) {
            // Query untuk menambahkan id_user dan id_webtoon ke tabel favorit
            // Query untuk menambahkan data webtoon ke favorit bersama dengan timestamp
            $query_add_favorite = "INSERT INTO favorit (id_user, id_webtoon) VALUES ($id_user, $id_webtoon)";
            $result_add_favorite = mysqli_query($koneksi, $query_add_favorite);

            // Periksa apakah query berhasil dieksekusi
            if ($result_add_favorite) {
                // Ambil timestamp saat ini
                $timestamp = date("Y-m-d H:i:s");
                // Query untuk menambahkan timestamp ke kolom waktu_tambah
                $query_add_timestamp = "UPDATE favorit SET waktu_tambah = '$timestamp' WHERE id_user = $id_user AND id_webtoon = $id_webtoon";
                $result_add_timestamp = mysqli_query($koneksi, $query_add_timestamp);

                // Periksa apakah query berhasil dieksekusi
                if (!$result_add_timestamp) {
                    // Pesan kesalahan jika query tidak berhasil dieksekusi
                    $error_message = "Gagal menambahkan timestamp. Silakan coba lagi.";
                }
            } else {
                // Pesan kesalahan jika query tidak berhasil dieksekusi
                $error_message = "Gagal menambahkan webtoon ke favorit. Silakan coba lagi.";
            }
        }

        // Jika berhasil menambahkan semua webtoon ke favorit, redirect ke halaman library
        if (empty($error_message)) {
            header("Location: library.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBTOONZ - Tambah ke Library</title>
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
        <section id="tambah" class="tambah">
            <div class="container">
                <div class="section-title">
                    <h2>Tambah Manhwa ke Library</h2>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <form action="" method="post" role="form">
                            <div class="row gy-4">
                                <?php foreach ($gambar_webtoon as $webtoon) : ?>
                                    <div class="col-md-4">
                                        <div class="spotlight-item h-100">
                                            <input type="checkbox" name="id_webtoon[]" value="<?php echo $webtoon['id_webtoon']; ?>">
                                            <img src="images/<?php echo $webtoon['nama_gambar']; ?>" class="img-fluid" alt="">
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Tambahkan ke Library</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer Section -->
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

    <!-- Main JS File -->
    <script src="assets/js/script.js"></script>

    <script src="https://unpkg.com/scrollreveal"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVFQWjvN2E5mKMksz5ETcuLtKC5qv8zTTGfxIrD0s7b4Fm0AiIw4" crossorigin="anonymous"></script>
</body>
</html>
