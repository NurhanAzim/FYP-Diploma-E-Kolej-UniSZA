<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand ps-1" href="home.php">E-Kolej UniSZA</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if (isset($_SESSION['auth_user'])) : ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="home.php">Halaman Utama</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="application-view.php">Permohonan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="term.php">Terma & Syarat</a>
          </li>
          <!--<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="student-changePass.php">Tukar Kata Laluan</a></li>
            </ul>
          </li>-->
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">
              <i class="fas fa-user fa-fw"></i><?= $_SESSION['auth_user']['username']; ?></a>
          </li>
          <li class="nav-item nav-logout d-lg-block">
            <a class="nav-link" aria-current="page" href="logout.php">
              <i class="bi bi-power"></i>
            </a>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="student-login.php">Log Masuk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="student-register.php">Daftar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Kembali ke menu log masuk</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<section>