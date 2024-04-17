<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">List Posts</h1>
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
                                    <th>User</th>
                                    <th>Judul</th>
                                    <th>Donasi</th>
                                    <th>Kategori</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $id_user = $_SESSION['id_user'];
                                    if($_SESSION['id_role'] == 1){
                                        $query = query("SELECT * FROM posts 
                                        INNER JOIN category ON category.id_category = posts.id_category
                                        INNER JOIN users ON users.id_user = posts.id_user");
                                    }else{
                                        $query = query("SELECT * FROM posts 
                                        INNER JOIN category ON category.id_category = posts.id_category
                                        INNER JOIN users ON users.id_user = posts.id_user
                                        WHERE posts.id_user='$id_user'");
                                    }
                                    while($row = mysqli_fetch_array($query)){
                                        
                                        $fullname = strtoupper($row['fullname']);
                                        $category_name = $row['category_name'];
                                        $title = $row['post_title'];
                                        $total_amount = number_format($row['post_amount']);

                                ?>
                                <tr>
                                    <td><?php echo $fullname ?></td>
                                    <td><?php echo $title ?></td>
                                    <td>Rp. <?php echo $total_amount ?></td>
                                    <td><?php echo $category_name ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action button
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" href="<?php echo BASE_URL_ADMIN ?>?page=detailpost&detail=<?php echo $row['id_post'] ?>"><i class="fa fa-eye"></i> Detail</a>
                                                <a class="dropdown-item" href="<?php echo BASE_URL_ADMIN ?>?page=editpost&edit=<?php echo $row['id_post'] ?>"><i class="fa fa-edit"></i> Edit</a>
                                                <a class="dropdown-item" href="<?php echo BASE_URL_ADMIN ?>?page=listposts&delete=<?php echo $row['id_post'] ?>"><i class="fa fa-trash"></i> Hapus</a>
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
    $id_post = $_GET['delete'];

    $query = query("DELETE FROM posts WHERE id_post='$id_post'");
    redirect('?page=listposts');
}

?>