<?php 

    if(isset($_GET['detail'])){
        $id_user = $_GET['detail'];

        $query = query("SELECT * FROM users 
                        INNER JOIN roles ON roles.id_role = users.id_role
                        WHERE id_user='$id_user' ");
        $data = mysqli_fetch_array($query);

        $fullname = $data['fullname'];
        $phone = $data['phone'];
        $email = $data['email'];
        $role_name = $data['role_name'];
        $user_status = $data['user_status'];
        $user_registered = $data['user_registered'];
        if($user_status == 1){
            $user = '<span class="badge badge-danger">belum aktif</span>';
        }else{
            $user = '<span class="badge badge-primary">sudah aktif</span>';
        }

        if(isset($_POST['pending']) == '1' ){
            $query = query("UPDATE users SET user_status='2' WHERE id_user='$id_user' ");
            if($query){
                redirect('?page=listusers');
            }
        }
        if(isset($_POST['approve']) == 'approve' ){
            $query = query("UPDATE users SET user_status='1' WHERE id_user='$id_user' ");
            if($query){
                redirect('?page=listusers');
            }
        }
    }

?>

<div class="container">
    <div class="row">
        <di class="col-md-12">
            <h1 class="text-center">
                Detail User
            </h1>
        </di>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                <a href="<?php echo BASE_URL_ADMIN ?>?page=listusers" class="btn btn-secondary mb-3"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="col-md-3">Nama Lengkap</td>
                                <td>:</td>
                                <td><?php echo $fullname ?> </td>
                            </tr>
                            <tr>
                                <td class="col-md-3">No.Telepon</td>
                                <td>:</td>
                                <td><?php echo $phone ?> </td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Email</td>
                                <td>:</td>
                                <td><?php echo $email ?> </td>
                            </tr>
                            <tr>
                                <td class="col-md-3">Role</td>
                                <td>:</td>
                                <td><?php echo $role_name ?> </td>
                            </tr>
                            
                            <tr>
                                <td class="col-md-3">Tanggal Daftar</td>
                                <td>:</td>
                                <td><?php echo $user_registered ?> </td>
                            </tr>
                            <!-- <tr>
                                <td class="col-md-3">Poster</td>
                                <td>:</td>
                                <td>
                                    <img src="<?php //echo BASE_URL ?>/assets/img/<?php //echo $image ?> " class="img-fluid" alt="poster">
                                </td>
                            </tr> -->
                            <tr>
                                <td class="col-md-3">Status</td>
                                <td>:</td>
                                <td><?php echo $user ?> </td>
                            </tr>
                        
                            
                        </tbody>
                    </table>
                    </div>

                    <form method="post">
                        <?php 
                            if($user_status == '1'):
                        ?>
                        <div class="form-group">
                            <button type="submit" name="pending" class="btn btn-outline-primary btn-block">Approve User</button>
                        </div>
                        <?php else : ?>
                            <div class="form-group">
                                <button type="submit" name="approve" class="btn btn-outline-danger btn-block">Pending User</button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>