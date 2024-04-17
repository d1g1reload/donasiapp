<?php 

if(isset($_GET['sid']))
{
    $sid = $_GET['sid'];
    $query = mysqli_query($connection, "SELECT * FROM slides WHERE id_slide='$sid'");
    $data = mysqli_fetch_array($query);
    
    
}

if(isset($_POST['update']))
{
    $image_title = $_POST['image_title'];
    $image_file = uniqid() . $_FILES['image_file']['name'];
    
    $image_file_tmp =  $_FILES['image_file']['tmp_name'];
    
    move_uploaded_file($image_file_tmp,"../assets/img/slide/$image_file");
    
    if(empty($image_file)){
        $query_image = mysqli_query($connection,"SELECT * FROM slides WHERE id_slide='$sid'");
        $data_image = mysqli_fetch_array($query_image);
        $image_file = $data_image['image_file'];
    }
    
    $update_slide = mysqli_query($connection, "UPDATE slides SET image_title='$image_title',image_file='$image_file'
                                            WHERE id_slide='$sid'");
    
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                <div class="card-title"><h3>Update Slide</h3></div>
                <form method="post" autocomplete="off" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Upload Gambar</label>
                        <input type="file" name="image_file" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Judul Gambar</label>
                        <input type="text" name="image_title" class="form-control" value="<?php echo $data['image_title']?>">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-warning btn-block" type="submit" name="update">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                    <div class="card-body">
                    <div class="card-title"><h3>Preview Slide</h3></div>
                        <ul class="list-group">
                        <?php
                        $query = mysqli_query($connection, "SELECT * FROM slides WHERE id_slide='$sid' ");
                        while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <li class="list-group-item">
                            	<h5><?php echo $row['image_title'] ?></h5>
                            	<img class="img-thumbnail img-fluid" alt="<?php echo $row['image_title'] ?>" src="../assets/img/slide/<?php echo $row['image_file'] ?>">

                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
        </div>
    </div>
</div>