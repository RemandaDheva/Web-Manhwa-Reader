<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['sudah_login'])) {
    // Jika pengguna belum login, redirect ke halaman login
    header("Location: login.php");
    exit; // Pastikan untuk keluar dari skrip setelah melakukan redirect
}

require 'koneksi.php'; // Sertakan file koneksi

// Query untuk mengambil data favorit webtoon oleh pengguna tertentu
$query = "SELECT * FROM webtoon";
$result = mysqli_query($koneksi, $query);

// Inisialisasi array untuk menyimpan id_webtoon yang ditambahkan ke favorit
$webtoon_ids = [];

// Periksa apakah query berhasil dieksekusi
if ($result) {
    // Ambil id_webtoon dan simpan dalam array
    while ($row = mysqli_fetch_assoc($result)) {
        $webtoon_ids[] = $row['id_webtoon'];
    }
}

// Inisialisasi array untuk menyimpan data gambar webtoon
$gambar_webtoon = [];

// Query untuk mengambil data gambar webtoon yang ada di favorit
if (!empty($webtoon_ids)) {
    $webtoon_ids_string = implode(',', $webtoon_ids); // Ubah array ke string untuk digunakan dalam query IN
    $query_webtoon = "SELECT * FROM webtoon WHERE id_webtoon IN ($webtoon_ids_string)";
    $result_webtoon = mysqli_query($koneksi, $query_webtoon);

    // Periksa apakah query berhasil dieksekusi
    if ($result_webtoon) {
        // Ambil data gambar webtoon
        while ($row_webtoon = mysqli_fetch_assoc($result_webtoon)) {
            $gambar_webtoon[] = $row_webtoon; // Menyimpan seluruh data webtoon, bukan hanya nama gambar
        }
    }
}

// Jika formulir disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah gambar webtoon dipilih
    if (!empty($_POST['id_webtoon'])) {
        // Loop untuk setiap id_webtoon yang dipilih
        foreach ($_POST['id_webtoon'] as $id_webtoon) {
            // Query untuk menghapus id_webtoon dari tabel favorit
            $query = "DELETE FROM webtoon WHERE id_webtoon = $id_webtoon";
            $result = mysqli_query($koneksi, $query);

            // Periksa apakah query berhasil dieksekusi
            if (!$result) {
                // Pesan kesalahan jika query tidak berhasil dieksekusi
                $error_message = "Gagal menghapus webtoon. Silakan coba lagi.";
                break;
            }
        }

        // Jika berhasil menghapus semua webtoon, redirect ke halaman library
        if (empty($error_message)) {
            header("Location: admin_dashboard.php");
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

            <a href="#" class="logo d-flex align-items-center  me-auto me-lg-0">
                <i class="bi bi-postage-heart-fill"></i>
                <h1>WEBTOONZ</h1>
            </a>

            <div class="header-social-links">
                <a href="admin_dashboard.php" class="search"><i class="bi bi-x-lg"></i></a>
            </div>
        </div>
    </header>

    <main id="main" data-aos="fade" data-aos-delay="1500">
        <section id="tambah" class="tambah">
            <div class="container">
                <div class="section-title">
                    <h2>Hapus Manhwa</h2>
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
                            <button type="submit" class="btn btn-primary mt-3">Hapus</button>
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
