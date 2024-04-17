<?php 

    if(isset($_POST['add_image'])){
        $image_title = $_POST['image_title'];
        $image_file = uniqid() . $_FILES['image_file']['name'];
        $image_tmp = $_FILES['image_file']['tmp_name'];

        move_uploaded_file($image_tmp,"../assets/img/slide/$image_file");

        $query = query("INSERT INTO slides(image_title,image_file) VALUES('$image_title','$image_file')");
        if($query){
            redirect("?page=slider");
        }

    }

?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                <div class="card-title"><h3>Tambah Slide</h3></div>
                <form method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Upload Gambar</label>
                        <input type="file" name="image_file" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Judul Gambar</label>
                        <input type="text" name="image_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit" name="add_image">Tambah Gambar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                    <div class="card-body">
                    <div class="card-title"><h3>List Slide</h3></div>
                        <ul class="list-group">
                        <?php
                        $query = mysqli_query($connection, "SELECT * FROM slides");
                        while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <li class="list-group-item">
                            	<h5><?php echo $row['image_title'] ?></h5>
                            	<a href="?page=editSlide&sid=<?php echo $row['id_slide'] ?>" class="btn btn-warning">Edit</a>
                            	<a href="?page=slider&sid=<?php echo $row['id_slide'] ?>" class="btn btn-danger">Delete</a>
                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</div>

<?php
if(isset($_GET['sid'])){
    $sid = $_GET['sid'];

    $query = query("DELETE FROM slides WHERE id_slide='$sid'");
    redirect("?page=slider");
}

?>