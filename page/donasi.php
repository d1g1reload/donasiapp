<div class="container">
    <div class="row push-from-top">
        <div class="col-md-12">
            <h1 class="text-center">List Donasi</h1>
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
                        <i>Tanggal Posting : <?php echo date('d-m-Y')?></i>
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