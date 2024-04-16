<?php
session_start();

require 'koneksi.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    // Validasi level yang diperbolehkan
    $allowed_levels = ['admin', 'user'];
    if (!in_array($level, $allowed_levels)) {
        echo "<script>alert('Level pengguna tidak valid');</script>";
        header("Refresh:0");
        exit;
    }

    $sql = "SELECT * FROM pengguna WHERE email = '$email' AND password = '$password' AND level = '$level'";
    $result = mysqli_query($koneksi, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        // Ambil data pengguna
        $user_data = mysqli_fetch_assoc($result);

        // Set session id_user
        $_SESSION['id_user'] = $user_data['id_user'];

        // Set session sudah_login
        $_SESSION['sudah_login'] = true;

        // Redirect to appropriate page based on user level
        if ($user_data['level'] == 'admin') {
            header("Location: admin_dashboard.php");
        } elseif ($user_data['level'] == 'user') {
            header("Location: index.php");
        }

        // Set cookie if remember me is checked
        if (isset($_POST['rememberMe'])) {
            setcookie(
                'ingat_saya',
                'true',
                time() + (86400 * 7), // 1 minggu
                '/'
            );
        }
        exit;
    } else {
        echo "<script>alert('Email, password, atau role tidak tepat')</script>";
        header("Refresh:0");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
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
        </div>
    </header>

    <section class="login" id="login">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-lg-4">
                    <div class="card card-body login-form">
                        <h2 class="fs-3 mb-3 text-center">LOGIN</h2>
                        <form action="login.php" method="POST">
                            <div class="form-floating mb-3">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                <label for="email">Email</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                                <label for="password">Password</label>
                            </div>
                            <div class="form-group">
                                <label for="level">Role</label>
                                <select class="form-control" id="level" name="level">
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="true" name="rememberMe" id="rememberMe" >
                                <label class="form-check-label" for="rememberMe">Remember Me</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <p class="mt-3">Don't have an account? <a href="register.php">Register here</a></p>
                    </div>
                </div>
            </div>
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