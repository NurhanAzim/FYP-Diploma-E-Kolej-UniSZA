<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="home.php">Sistem Permohonan Kolej Kediaman</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php if (isset($_SESSION['auth_user'])) : ?>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="application-view.php">Permohonan</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i><?= $_SESSION['auth_user']['username']; ?></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="student-changePass.php">Tukar Kata Laluan</a></li>
              <li><a class="dropdown-item" href="logout.php">Log Keluar</a></li>
            </ul>
        </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="student-login.php">Log Masuk</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="student-register.php">Daftar</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>