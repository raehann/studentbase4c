<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Masuk</title>
</head>
<style>
    body {
  font-family: "Open Sans", sans-serif;
  color: #444444;
}

a {
  color: #1acc8d;
  text-decoration: none;
}

a:hover {
  color: #34e5a6;
  text-decoration: none;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  font-family: "Montserrat", sans-serif;
}
#footer {
  background: #010351;
  padding: 0 0 10px 0;
  color: #fff;
  font-size: 14px;
}
#footer .copyright {
  border-top: 1px solid #010479;
  text-align: center;
  padding-top: 1 0px;
}
</style>
<body>
<section class="bg-light p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-xxl-11">
        <div class="card border-light-subtle shadow-sm">
          <div class="row g-0">
            <div class="col-12 col-md-6">
              <img class="img-fluid rounded-start w-100 h-100 object-fit-cover" loading="lazy" src="assets/img/hero-login.jpg" alt="Welcome back you've been missed!">
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
              <div class="col-12 col-lg-11 col-xl-10">
                <div class="card-body p-3 p-md-4 p-xl-5">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-5">
                        <div class="text-center mb-4">
                          <h2 class="fw-bold"><i class="ri-login-circle-fill"></i> MASUK</h2>
                        </div>
                        <h4 class="text-center">Selamat Datang!</h4>
                        <?php
                          session_start();
                          if (isset($_SESSION['error'])) {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      ' . $_SESSION['error'] . '
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                              unset($_SESSION['error']); // Hapus pesan kesalahan dari session setelah ditampilkan
                          }
                          ?>
                      </div>
                    </div>
                  </div>
                  <form action="masuk-proses.php" method="POST">
                    <div class="row gy-3 overflow-hidden">
                      <div class="col-12">
                        <div class="form-floating mb-3">
                          <input type="text" class="form-control" name="nim" id="nim" placeholder="Username / NIM" required>
                          <label for="nim" class="form-label">Username / NIM</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-floating mb-3">
                          <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                          <label for="password" class="form-label">Password</label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                          <label class="form-check-label text-secondary" for="remember_me">
                            Biarkan saya tetap masuk
                          </label>
                        </div>
                      </div>
                      <div class="col-12">
                        <div class="d-grid">
                          <button class="btn btn-primary btn-lg" type="submit"><i class="ri-login-circle-line"></i> Masuk</button>
                        </div>
                      </div>
                    </div>
                  </form>
                  <div class="row">
                    <div class="col-12">
                      <div class="d-flex gap-2 gap-md-1 flex-column flex-md-row justify-content-md-center mt-5">
                        <p>Belum ada akun?<a href="daftar.php"> Buat akun disini!</a></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<footer id="footer">
    <div class="container">
      <div class="copyright text-center" style="padding: 10px; ">
        &copy; Copyright 2024 <strong><span>Kelompok 2 IMK</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer>
  <script src="assets/js/main.js"></script>
  <script src="https://unpkg.com/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>