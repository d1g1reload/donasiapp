<?php 
    if(isset($_POST['savekategori'])){
       
        $category_name = escape($_POST['category_name']);
        
        $query = query("INSERT INTO category (category_name) VALUES('$category_name') ");
        confirmQuery($query);
        if($query){
            redirect('?page=listkategori');
        }
    }

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Form Tambah Kategori</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <a href="<?php echo BASE_URL_ADMIN ?>?page=listkategori" class="btn btn-secondary mb-3"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <form method="post" autocomplete="off">
                       
                        <div class="form-group">
                            <label for="title">Nama Kategori</label>
                            <input type="text" class="form-control" name="category_name">
                        </div>
                        
                        <div class="form-group">
                            <button name="savekategori" type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>