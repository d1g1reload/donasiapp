  <!-- Page Wrapper -->
  <div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo BASE_URL_ADMIN?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DonasiApp</div>
    </a>

    <li class="nav-item">
        <a class="nav-link" href="../index.php" target="blank">
            <i class="fas fa-fw fa-eye"></i>
            <span>View Web</span>
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item ">
        <a class="nav-link" href="<?php echo BASE_URL_ADMIN; ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data
    </div>

  

    <!-- Posts Data -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#post" aria-expanded="true" aria-controls="post">
            <i class="fas fa-fw fa-file"></i>
            <span>Posts</span>
        </a>
        <div id="post" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo BASE_URL_ADMIN ?>?page=addpost">Tambah Post</a>
                <a class="collapse-item" href="<?php echo BASE_URL_ADMIN ?>?page=listposts">List Post</a>
            </div>
        </div>
    </li>

    <!-- Category Data -->
    <?php if($_SESSION['id_role'] == 1) : ?>
      <!-- Slider Data -->
    <li class="nav-item ">
        <a class="nav-link" href="<?php echo BASE_URL_ADMIN; ?>?page=slider">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Slider</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kategori" aria-expanded="true" aria-controls="kategori">
            <i class="fas fa-fw fa-file"></i>
            <span>Kategori</span>
        </a>
        <div id="kategori" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo BASE_URL_ADMIN ?>?page=addkategori">Tambah Kategori</a>
                <a class="collapse-item" href="<?php echo BASE_URL_ADMIN ?>?page=listkategori">List Kategori</a>
            </div>
        </div>
    </li>

    <!-- User Data -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#user" aria-expanded="true" aria-controls="user">
            <i class="fas fa-fw fa-file"></i>
            <span>Users</span>
        </a>
        <div id="user" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo BASE_URL_ADMIN ?>?page=adduser">Tambah User</a>
                <a class="collapse-item" href="<?php echo BASE_URL_ADMIN ?>?page=listusers">List User</a>
            </div>
        </div>
    </li>
    <?php endif; ?>

     <!-- Divider -->
     <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Payments
    </div>

    <!-- User Data -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#payment" aria-expanded="true" aria-controls="payment">
            <i class="fas fa-fw fa-file"></i>
            <span>Payments List</span>
        </a>
        <div id="payment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?php echo BASE_URL_ADMIN ?>?page=listpayment">List Payment</a>
                <a class="collapse-item" href="<?php echo BASE_URL_ADMIN ?>?page=pendingpayment">Pending Payment</a>
            </div>
        </div>
    </li>
    


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->


<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>



            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Alerts -->
            <?php if($_SESSION['id_role'] == 1) { ?>
                <li class="nav-item dropdown no-arrow mx-1">
                    
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bell fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <?php 
                            $query = query("SELECT COUNT(*) AS 'total' FROM payments
                                            WHERE payments.status_payment='pending' ");
                            $total = mysqli_fetch_array($query);
                            
                            
                        ?>
                        <span class="badge badge-danger badge-counter"><?php echo $total['total'] ?></span>
                    </a>
                   
                <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                        <h6 class="dropdown-header">
                            Notifikasi Pending Pembayaran
                        </h6>
                        <?php 
                            $query = query("SELECT * FROM payments
                                            INNER JOIN posts ON posts.id_post=payments.id_post
                                            INNER JOIN users ON users.id_user=payments.id_user
                                            WHERE payments.status_payment='pending' ");
                            while($data = mysqli_fetch_array($query)){
                                $payment_date = $data['payment_date'];
                                $post_title = $data['post_title'];

                            
                        ?>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo BASE_URL_ADMIN ?>?page=detailpayment&detail=<?php echo $data['id_payment'] ?>">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500"><?php echo $payment_date ?> / <?php echo $data['fullname'] ?> </div>
                                    
                                    <span class="font-weight-bold">
                                        
                                        <?php echo $post_title ?>
                                        
                                    </span>
                                </div>
                            </a>
                        <?php } ?>
                        <a class="dropdown-item text-center small text-gray-500" href="<?php echo BASE_URL_ADMIN ?>?page=pendingpayment">Tampilkan Semua</a>
                    </div>
                </li>
 				<?php }  ?>
 				
                      

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['fullname'] ?></span>
                        <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?name=<?php echo $_SESSION['fullname'] ?>">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?php echo BASE_URL_ADMIN ?>?page=detailuser&detail=<?php echo $_SESSION['id_user'] ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                        </a>
                       
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../lib/logout.php">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
         