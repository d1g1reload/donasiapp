<div class="container-fluid">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Halo <?php echo $_SESSION['fullname'] ?>, Dashboard</h1>
        <a href="<?php echo BASE_URL_ADMIN ?>?page=report_all" target="blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

</div>

<div class="container">
 <?php if($_SESSION['id_role'] == 1) { ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Akumulasi Donasi</div>
                        
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo total_dana() ?></div>
                        
                        
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>

    <div class="row mt-5">
    
        <div class="col-md-4 pb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kategori</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo total_kategori() ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-md-4 pb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Posts</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo total_posts() ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-md-4 pb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo total_users() ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
 <?php } else  {  ?>
 
 
    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Donasi</div>
                       
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. <?php echo total_dana_user($_SESSION['id_user']) ?></div>
                       
                    </div>
                    
                    </div>
                </div>
            </div>  
        </div>
    </div>

   <?php } ?>
 
</div>