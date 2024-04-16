<?php
require 'koneksi.php';

if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Inisialisasi variabel pencarian dan filter genre
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$genreFilter = isset($_GET['genre']) ? $_GET['genre'] : '';

// Bangun kueri SQL dengan pencarian dan filter genre
$sql = "SELECT * FROM webtoon";
if (!empty($searchQuery)) {
    $sql .= " WHERE judul LIKE '%$searchQuery%'";
    if (!empty($genreFilter) && $genreFilter != 'Semua Genre') {
        $sql .= " AND genre='$genreFilter'";
    }
} elseif (!empty($genreFilter) && $genreFilter != 'Semua Genre') {
    $sql .= " WHERE genre='$genreFilter'";
}

// Jalankan kueri
$result = mysqli_query($koneksi, $sql);

// Periksa apakah ada hasil atau tidak
if ($result) {
    // Ambil hasil sebagai array asosiatif
    $webtoons = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    // Tampilkan pesan jika terjadi kesalahan saat menjalankan kueri
    echo "Error: " . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBTOONZ - Search Manhwa</title>
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
                <a href="admin_dashboard.php" class="search1"><i class="bi bi-x-lg"></i></a>
            </div>
        </div>
    </header>

    <section id="search" class="search">
        <div class="container-fluid">
            <h2>Hasil Pencarian</h2>
            
            <form action="search1.php" method="get" class="mb-4">
                <div class="input-group mt-5">
                    <input type="text" class="form-control" name="search" placeholder="Masukkan Judul Webtoon" value="<?php echo htmlspecialchars($searchQuery); ?>">
                    <select class="form-select " name="genre">
                        <option value="">Semua Genre</option>
                        <option value="fantasi" <?php echo $genreFilter == 'fantasi' ? 'selected' : ''; ?>>Fantasi</option>
                        <option value="romansa" <?php echo $genreFilter == 'romansa' ? 'selected' : ''; ?>>Romansa</option>
                        <option value="aksi" <?php echo $genreFilter == 'aksi' ? 'selected' : ''; ?>>Aksi</option>
                    </select>
                    <button type="submit" class="btn">Cari</button>
                </div>
            </form>
            <?php if (!empty($webtoons)) : ?>
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
            <?php else : ?>
                <p class="text-center">Tidak ada webtoon yang ditemukan.</p>
            <?php endif; ?>
        </div>
    </section>

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
