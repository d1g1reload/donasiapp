<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DonasiApp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

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
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Donasi</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Kontak</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="#">Akun</a>
      </li>

      
      
  </div>
</nav>

<!--CONTENT HERE-->
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
			 	 
			    <div class="carousel-item active">
			      <img class="d-block w-100 img-fluid" src="assets/img/1.jpg" style="height: 350px;">
                  <div class="carousel-caption d-none d-md-block">
                      <h6>Slide 1</h6>
                  </div>
                </div>
                <div class="carousel-item">
			      <img class="d-block w-100 img-fluid" src="assets/img/2.jpeg" style="height: 350px;">
                  <div class="carousel-caption d-none d-md-block">
                      <h6>Slide 2</h6>
                  </div>
                </div>
                <div class="carousel-item">
			      <img class="d-block w-100 img-fluid" src="assets/img/3.jpeg" style="height: 350px;">
                  <div class="carousel-caption d-none d-md-block">
                      <h6>Slide 3</h6>
                  </div>
                </div>
			    
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
            <a href="#" class="btn btn-lg text-white bg-custom-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
            </svg> 
            List Donasi</a>
        </div>
    </div>
    <div class="row push-from-top">
        
        <div class="col-md-4">
            <div class="card border-0 shadow-lg mb-3">
                <img src="assets/img/1.jpg" class="img-fluid" style="width:100%;height: 200px;" alt="slide-image">
                <div class="card-body">
                    <div id="box-card-title">
                        <a class="nav-link" href="#">
                            <h3 class="custom-card-title">Bencana 1...</h3>
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-custom-primary text-white">
                <p>
                        Dana Terkumpul <br>
                        Rp. 1000.000
                        <br>
                        <i>Tanggal Posting : 2020-12-12</i>      
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-lg mb-3">
                <img src="assets/img/2.jpeg" class="img-fluid" style="width:100%;height: 200px;" alt="slide-image">
                <div class="card-body">
                    <div id="box-card-title">
                        <a class="nav-link" href="#">
                            <h3 class="custom-card-title">Bencana 2...</h3>
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-custom-primary text-white">
                <p>
                        Dana Terkumpul <br>
                        Rp. 1000.000
                        <br>
                        <i>Tanggal Posting : 2020-12-12</i>      
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-lg mb-3">
                <img src="assets/img/3.jpeg" class="img-fluid" style="width:100%;height: 200px;" alt="slide-image">
                <div class="card-body">
                    <div id="box-card-title">
                        <a class="nav-link" href="#">
                            <h3 class="custom-card-title">Bencana 3...</h3>
                        </a>
                    </div>
                </div>
                <div class="card-footer bg-custom-primary text-white">
                <p>
                        Dana Terkumpul <br>
                        Rp. 1000.000
                        <br>
                        <i>Tanggal Posting : 2020-12-12</i>      
                    </p>
                </div>
            </div>
        </div>
        
   </div>
   
</div>

<div class="container">
    <div class="row push-from-top">
        <div class="col-md-12 text-center">
            <h1 class="text-center">Kategori Donasi</h1>
        </div>
   </div>

   <div class="row push-from-top text-center">
       
       <div class="col-md-4">
           <a href="#" class="btn btn-outline-primary btn-block mb-3">Kategori 1</a> 
       </div>
       <div class="col-md-4">
           <a href="#" class="btn btn-outline-primary btn-block mb-3">Kategori 2</a> 
       </div>
       <div class="col-md-4">
           <a href="#" class="btn btn-outline-primary btn-block mb-3">Kategori 3</a> 
       </div>
       
   </div>
</div>

<!--END CONTENT-->




<footer class="footer mt-auto py-3">
  <div class="container">
    <span class="text-white">Place sticky footer content here.</span>
  </div>
</footer>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</body>
</html>