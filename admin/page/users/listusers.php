<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">List Users</h1>
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
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = query("SELECT * FROM users");
                                    while($row = mysqli_fetch_array($query)){
                                        $fullname = $row['fullname'];
                                        $email = $row['email'];
                                        
                                ?>
                                <tr>
                                    
                                    <td><?php echo $fullname ?></td>
                                    <td><?php echo $email ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" href="<?php echo BASE_URL_ADMIN ?>?page=detailuser&detail=<?php echo $row['id_user'] ?>"><i class="fa fa-eye"></i> Detail</a>
                                                <a class="dropdown-item" href="<?php echo BASE_URL_ADMIN ?>?page=edituser&edit=<?php echo $row['id_user'] ?>"><i class="fa fa-edit"></i> Edit</a>
                                                <a class="dropdown-item" href="<?php echo BASE_URL_ADMIN ?>?page=listusers&delete=<?php echo $row['id_user'] ?>"><i class="fa fa-trash"></i> Hapus</a>
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
    $id_user = $_GET['delete'];

    $query = query("DELETE FROM users WHERE id_user='$id_user'");
    redirect('?page=listusers');
}

?>