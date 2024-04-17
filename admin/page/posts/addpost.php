<?php 
    if(isset($_POST['savepost'])){
        $id_user = $_SESSION['id_user'];
        $id_category = escape($_POST['id_category']);
        $post_title = escape($_POST['post_title']);
        $post_description = escape($_POST['post_description']);

        $post_image = uniqid().$_FILES['post_image']['name'];
        $post_image_tmp = $_FILES['post_image']['tmp_name'];

        move_uploaded_file($post_image_tmp,"../assets/img/$post_image");


        $query = query("INSERT INTO posts (id_user,id_category,post_title,post_image,post_description,post_date)
                            VALUES('$id_user','$id_category','$post_title','$post_image','$post_description',now()) ");
        confirmQuery($query);
        if($query){
            redirect('?page=listposts');
        }
    }

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Form Tambah Post</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <a href="<?php echo BASE_URL_ADMIN ?>?page=listposts" class="btn btn-secondary mb-3"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <form method="post" autocomplete="off" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="category">Pilih Kategori</label>
                            <select name="id_category" class="form-control col-md-4">
                                <?php 
                                    $query = query("SELECT * FROM category");
                                    while($row = mysqli_fetch_array($query)){
                                ?>
                                    <option value="<?php echo $row['id_category'] ?>"><?php echo $row['category_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Judul Post</label>
                            <input type="text" class="form-control" name="post_title">
                        </div>
                        <div class="form-group">
                            <label for="image">Post Image</label>
                            <input type="file" name="post_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Post Description</label>
                            <textarea name="post_description" cols="30" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button name="savepost" type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>