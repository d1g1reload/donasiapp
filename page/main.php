<div class="container-fluid">
   <div class="row jumbotron">       
        <div class="col-md-6">
            <div class="text-center" id="item-box">
                <h1>“ SUDAHKAH ANDA <b>BERDONASI</b> HARI INI ” </h1>
                <a href="index.php?page=akun" class="btn btn-outline-success">Daftar Gratis</a>
                <a href="#" class="btn btn-primary">Mulai Donasi</a>    
            </div>
        </div>
        <div class="col-md-6">
        <div id="carouselExampleIndicators" class="carousel slide mt-3 d-none d-md-block" data-ride="carousel">
		    <ol class="carousel-indicators">
			    <?php 
			    	$no = 0;
					for($no;$no<3;$no++){
				?>
				    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $no ?>" class="<?php if($no == 0){echo 'active';}else{echo 'notactive';}?>"></li>
				<?php 
					}
				?>
			</ol>
			  <div class="carousel-inner">
			 	 <?php 
					$no = 0;
					$query = query("SELECT * FROM slides ORDER BY id_slide DESC limit 3 "); 
                    while($row = mysqli_fetch_array($query)){
                    $image = $row['image_file'];
				?>
			    <div class="carousel-item <?php if($no == 0){echo 'active';}else{echo 'notactive';}?>">
			      <img class="d-block w-100 img-fluid" src="assets/img/slide/<?php echo $row['image_file']?>" style="height: 350px;">
                  <div class="carousel-caption d-none d-md-block">
                      <h6><?php echo $row['image_title'] ?></h6>
                  </div>
                </div>
			    <?php 
					$no++;}
				?>
			  </div>
			  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
			  </a>
			  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  </a>
        </div>
       		
        </div>
   </div> 
</div>

<div class="container">
    <div class="row push-from-top">
        <div class="col-md-4">
            <a href="<?php echo BASE_URL; ?>?page=donasi" class="btn btn-lg text-white bg-custom-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
            </svg> 
            List Donasi</a>
        </div>
    </div>
    <div class="row push-from-top">
        <?php 
            $query = query("SELECT * FROM posts");
            if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_array($query)){
                $post_title = escape($row['post_title']);
                $post_content = escape($row['post_description']);
                $post_amount = $row['post_amount'];
                $image = $row['post_image'];
                $post_date = $row['post_date'];

        ?>
        <div class="col-md-4">
            <div class="card border-0 shadow-lg mb-3">
                <img src="<?php echo BASE_URL ?>assets/img/<?php echo $image ?> " class="img-fluid" style="width:100%;height: 200px;" alt="slide-image">
                <div class="card-body">
                    <div id="box-card-title">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>?page=detail&id_post=<?php echo $row['id_post'] ?>">
                            <h3 class="custom-card-title"><?php echo substr($post_title,0,50) ?>...</h3>
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-custom-primary text-white">
                <p>
                        Dana Terkumpul <br>
                        Rp. <?php echo number_format($post_amount,2) ?>
                        <br>
                        <i>Tanggal Posting : <?php echo $post_date ?></i>      
                    </p>
                </div>
            </div>
        </div>
        <?php } }else{
            echo '<div class="col-md-12 alert alert-danger" role="alert">
                    Tidak ada data
                </div>';   
        } 
        ?>
   </div>
   
</div>

<div class="container">
    <div class="row push-from-top">
        <div class="col-md-12 text-center">
            <h1 class="text-center">Kategori Donasi</h1>
        </div>
   </div>

   <div class="row push-from-top text-center">
       <?php  
            $query = query("SELECT * FROM category");
            while($row = mysqli_fetch_array($query)){
                $category_name = escape($row['category_name']);
            
       ?>
       <div class="col-md-4">
           <a href="index.php?page=kategori&id_category=<?php echo $row['id_category'] ?>" class="btn btn-outline-primary btn-block mb-3"><?php echo $category_name ?></a> 
       </div>
       <?php } ?>
   </div>
</div>

