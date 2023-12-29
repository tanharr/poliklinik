<?php
include_once("koneksi.php");

session_start();

if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] === 'dokter' && (!isset($_GET['page']) || !in_array($_GET['page'], ['dokter','pasien', 'periksa','detail_periksa','obat']))) {
        header('Location: index.php?page=dokter');
        exit;
    } elseif ($_SESSION['role'] === 'pasien' && (!isset($_GET['page']) || !in_array($_GET['page'], ['pasien','periksa']))) {
        header('Location: index.php?page=pasien');
        exit;
    }
}

if (isset($_GET['page']) && $_GET['page'] === 'periksa' && empty($_SESSION['role'])) {
    header('Location: index.php?page=periksa');
    exit;
}
?>


<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0"> 

    <!-- Bootstrap Online -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
    
    <title>Sistem Informasi Poliklinik</title>   <!--Judul Halaman-->
</head>
<body>
<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      Sistem Informasi Poliklinik
    </a>
    <button class="navbar-toggler"
    type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarNavDropdown"
    aria-controls="navbarNavDropdown" aria-expanded="false"
    aria-label="Toggle navigation">
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
            Data Master
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="index.php?page=dokter">
                Dokter
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="index.php?page=pasien">
                Pasien
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="index.php?page=obat">
                Obat
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="index.php?page=detail_periksa">
                Detail Periksa
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" 
          href="index.php?page=periksa">
            Periksa
          </a>
        </li>
      </ul>
      </div>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['username'])) {
                        echo '<a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>';
                    } else {
                        echo '<a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>';
                    }
                    ?>
                </li>
            </ul>
        </div>
    </div>
  </div>
</nav>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<main role="main" class="container">
    <?php
    if (isset($_GET['page'])) {
    ?>
        <h2><?php echo ucwords($_GET['page']) ?></h2>
    <?php
        include($_GET['page'] . ".php");
    } else {
        echo "Selamat Datang di Sistem Informasi Poliklinik Silakan untuk Login terlebih dahulu";
    }
    ?>
</main>
</body>
</html>