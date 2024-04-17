<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #0166DB !important;">
  <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
      <img src="assets/img/logo.png" alt="logo-capture"  width="260" height="77" class="d-inline-block align-top" >
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL; ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL; ?>?page=donasi">Donasi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL; ?>?page=kontak">Kontak</a>
      </li>
      <?php if(!isLoggedIn()) : ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo BASE_URL; ?>?page=akun">Akun</a>
      </li>
      <?php endif; ?>
      <?php if(isLoggedIn()) : ?>
      <li class="nav-item">
        <a class="nav-link" href="#">Halo, <?php echo $_SESSION['fullname'] ?></a>
      </li>
      <li class="nav-item mr-2">
        <a class="btn btn-primary" href="<?php echo BASE_URL_ADMIN?>">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="btn btn-secondary" href="lib/logout.php">Logout</a>
      </li>
      <?php endif; ?>
     </ul>
      
      
  </div>
</nav>