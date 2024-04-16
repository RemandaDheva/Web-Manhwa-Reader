<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['sudah_login'])) {
    // Jika pengguna belum login, redirect ke halaman login
    header("Location: login.php");
    exit; // Pastikan untuk keluar dari skrip setelah melakukan redirect
}

require 'koneksi.php'; // Sertakan file koneksi

// Ambil id_user dari sesi
$id_user = $_SESSION['id_user'];

// Query untuk mengambil data favorit webtoon oleh pengguna tertentu
$query = "SELECT * FROM favorit WHERE id_user = $id_user";
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

// Query untuk mengambil data gambar webtoon yang ada di favorit
if (!empty($webtoon_ids)) {
    $webtoon_ids_string = implode(',', $webtoon_ids); 
    $query_webtoon = "SELECT * FROM webtoon WHERE id_webtoon IN ($webtoon_ids_string)";
    $result_webtoon = mysqli_query($koneksi, $query_webtoon);

    // Periksa apakah query berhasil dieksekusi
    if ($result_webtoon) {
        // Inisialisasi array untuk menyimpan data gambar webtoon
        $gambar_webtoon = [];

        // Ambil data gambar webtoon
        while ($row_webtoon = mysqli_fetch_assoc($result_webtoon)) {
            $gambar_webtoon[] = $row_webtoon['nama_gambar'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBTOONZ - Library</title>
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
                <a href="index.php" class="search"><i class="bi bi-x-lg"></i></a>
                <br>
                <a href="tambah.php" class="button-library"><i class="bi bi-plus-square-fill"></i></a>
                <br>
                <a href="delete.php" class="button-library"><i class="bi bi-trash3-fill"></i></a> 
            </div>
        </div>
    </header>

    <main id="main" data-aos="fade" data-aos-delay="1500">
        <section id="library" class="library">
            <div class="container-fluid">
                <h2>LIBRARY</h2>
                <div class="row gy-4 justify-content-center">
                    <?php if (!empty($gambar_webtoon)) : ?>
                        <?php foreach ($gambar_webtoon as $gambar) : ?>
                            <?php
                            // Ambil waktu kadaluwarsa dari database dan konversi ke timestamp
                            $query_timestamp = "SELECT waktu_tambah FROM favorit WHERE id_user = $id_user AND id_webtoon = (SELECT id_webtoon FROM webtoon WHERE nama_gambar = '$gambar')";
                            $result_timestamp = mysqli_query($koneksi, $query_timestamp);
                            $timestamp_row = mysqli_fetch_assoc($result_timestamp);
                            $timestamp_added = strtotime($timestamp_row['waktu_tambah']) + (60 * 60 * 24 * 3);

                            // Format ulang waktu kadaluwarsa ke dalam format tanggal dan waktu yang sesuai
                            $expiration_date = date('Y-m-d H:i:s', $timestamp_added);
                            ?>
                            <?php if (strtotime($expiration_date) > time()) : ?>
                                <div class="col-xl-3 col-lg-4 col-md-6">
                                    <div class="spotlight-item h-100">
                                        <a href="info.php?gambar=<?php echo $gambar; ?>">
                                            <img src="images/<?php echo $gambar; ?>" class="img-fluid" alt="">
                                        </a>
                                        <div class="countdown" data-timestamp="<?php echo $expiration_date; ?>"></div>
                                    </div>
                                </div>
                            <?php else : ?>
                                <?php
                                // Hapus entri dari tabel favorit jika waktu kadaluwarsa sudah tercapai
                                $query_delete = "DELETE FROM favorit WHERE id_user = $id_user AND id_webtoon = (SELECT id_webtoon FROM webtoon WHERE nama_gambar = '$gambar')";
                                mysqli_query($koneksi, $query_delete);
                                ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <div class="col">
                            <p class="text-center">Tidak ada webtoon yang ditambahkan ke favorit.</p>
                        </div>
                    <?php endif; ?>
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
