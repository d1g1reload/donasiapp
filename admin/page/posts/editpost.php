<?php 
    if(isset($_GET['edit'])){
        $id_post = $_GET['edit'];

        $query = query("SELECT * FROM posts WHERE id_post='$id_post'");
        $data = mysqli_fetch_array($query);

        $id_category = $data['id_category'];
        $post_title = $data['post_title'];
        $post_description = $data['post_description'];
        
    }
    if(isset($_POST['updatepost'])){
        
        $id_category = escape($_POST['id_category']);
        $post_title = escape($_POST['post_title']);
        $post_description = escape($_POST['post_description']);

        $post_image = $_FILES['post_image']['name'];
        $post_image_tmp = $_FILES['post_image']['tmp_name'];

        move_uploaded_file($post_image_tmp,"../assets/img/$post_image");

        if(empty($post_image)){
            $query = query("SELECT * FROM posts WHERE id_post='$id_post'");
            $data = mysqli_fetch_array($query);
            confirmQuery($data);
            $post_image = $data['post_image'];
        }


        $query = query("UPDATE posts SET id_category='$id_category', 
                                         post_title='$post_title',
                                         post_image= '$post_image',
                                         post_description='$post_description'
                                         WHERE id_post='$id_post' ");
        confirmQuery($query);
        if($query){
            redirect('?page=listposts');
        }
    }

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Form Edit Post</h1>
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
                                    <option value="<?php echo $row['id_category'] ?>" <?php echo ($id_category == $row['id_category']) ? 'selected'  : ''; ?>><?php echo $row['category_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Judul Post</label>
                            <input type="text" class="form-control" name="post_title" value="<?php echo $post_title ?>">
                        </div>
                        <div class="form-group">
                            <label for="image">Post Image</label>
                            <input type="file" name="post_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Post Description</label>
                            <textarea name="post_description" cols="30" rows="10" class="form-control"><?php echo $post_description ?></textarea>
                        </div>
                        <div class="form-group">
                            <button name="updatepost" type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>