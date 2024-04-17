<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">List Kategori</h1>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = query("SELECT * FROM category");
                                    while($row = mysqli_fetch_array($query)){
                                        $category_name = $row['category_name'];
                                        
                                ?>
                                <tr>
                                    
                                    <td><?php echo $category_name ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action button
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" href="<?php echo BASE_URL_ADMIN ?>?page=editkategori&edit=<?php echo $row['id_category'] ?>"><i class="fa fa-edit"></i> Edit</a>
                                                <a class="dropdown-item" href="<?php echo BASE_URL_ADMIN ?>?page=listkategori&delete=<?php echo $row['id_category'] ?>"><i class="fa fa-trash"></i> Hapus</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_GET['delete'])){
    $id_kategori = $_GET['delete'];

    $query = query("DELETE FROM category WHERE id_category='$id_kategori'");
    redirect('?page=listkategori');
}

?>