<?php
session_start();

require 'koneksi.php'; // Assuming koneksi.php contains connection details to your database

// Check if user is logged in
if (!isset($_SESSION['sudah_login'])) {
  // Redirect to login if not logged in
  header("Location: login.php");
  exit;
}

// Handle form submission (if submitted)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $genre = $_POST['genre'];
    $penulis = $_POST['penulis'];
    $illustrator = $_POST['gambar']; 
    $penerbit = $_POST['penerbit'];
    $sinopsis = $_POST['sinopsis'];
    $gambar = $_FILES['nama_gambar']; 

    // Image validation (replace with your validation logic)
    // Check if image file is selected
    if ($gambar['error'] === UPLOAD_ERR_NO_FILE) {
        $error_msg = "Mohon pilih gambar cover.";
    } else {
        // Image validation (replace with your validation logic)
        if ($gambar['error'] === UPLOAD_ERR_OK) {
            $allowed_extensions = ['jpg', 'jpeg', 'png'];
            $extension = pathinfo($gambar['name'], PATHINFO_EXTENSION);
            if (!in_array($extension, $allowed_extensions)) {
                $error_msg = "File extension not allowed. Please upload only jpg, jpeg, or png images.";
            } else {
                // Generate unique filename to avoid conflicts
                $filename = uniqid() . '.' . $extension;
                $target_file = 'images/' . $filename;

                // Move uploaded image to images folder
                if (move_uploaded_file($gambar['tmp_name'], $target_file)) {
                    // Insert data into webtoon table if image upload is successful
                    $query = "INSERT INTO webtoon (judul, genre, penulis, gambar, penerbit, sinopsis, nama_gambar) VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($koneksi, $query);
                    mysqli_stmt_bind_param($stmt, "sssssss", $judul, $genre, $penulis, $illustrator, $penerbit, $sinopsis, $filename);

                    if (mysqli_stmt_execute($stmt)) {
                        $success_msg = "Manhwa berhasil ditambahkan!";
                    } else {
                        $error_msg = "Kesalahan database: " . mysqli_error($koneksi);
                        // Retain uploaded image for potential retry (optional based on your logic)
                    }
                } else {
                    $error_msg = "Gagal upload gambar.";
                }
            }
        } else {
            $error_msg = "Upload gambar gagal.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBTOONZ - Tambah Manhwa</title>
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
        <section class="insert" id="insert">
            <h2>Tambah Manhwa</h2>
            <hr>
            <?php if (isset($success_msg)): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success_msg; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($error_msg)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Manhwa</label>
                    <input type="text" name="judul" id="judul" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" name="genre" id="genre" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" name="penulis" id="penulis" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="gambar" class="form-label">Illustator</label>
                    <input type="text" name="gambar" id="gambar" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="penerbit" class="form-label">Penerbit</label>
                    <input type="text" name="penerbit" id="penerbit" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="sinopsis" class="form-label">Sinopsis</label>
                    <textarea name="sinopsis" id="sinopsis" class="form-control" rows="5" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="nama_gambar" class="form-label">Gambar Cover</label>
                    <input type="file" name="nama_gambar" id="nama_gambar" accept="image/jpg,image/jpeg,image/PNG" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Manhwa</button>
            </form>
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

