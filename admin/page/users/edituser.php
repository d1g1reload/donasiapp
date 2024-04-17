<?php 
    if(isset($_GET['edit'])){
        $id_user = $_GET['edit'];

        $query = query("SELECT * FROM users WHERE id_user='$id_user'");
        $data = mysqli_fetch_array($query);
        $fullname = $data['fullname'];
        $phone = $data['phone'];
        $email = $data['email'];
        
        if(isset($_POST['updateuser'])){
           
            $fullname = trim($_POST['fullname']);
            $phone = trim($_POST['phone']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $db_user_password = $data['password'];

            if(empty($password)){
                $hashpass = $db_user_password;
            }else{
                $hashpass = password_hash($password,PASSWORD_BCRYPT,array('cost'=>10));
            }
    
    
            $query = query("UPDATE users SET fullname='$fullname',
                                             phone='$phone',
                                             email='$email',
                                             password='$hashpass'
                                             WHERE id_user='$id_user' ");
            confirmQuery($query);
            if($query){
                redirect('?page=listusers');
            }
        }
    }

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Form Edit User</h1>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <a href="<?php echo BASE_URL_ADMIN ?>?page=listusers" class="btn btn-secondary mb-3"><i class="fa fa-arrow-left"></i> Kembali</a>
                    <form method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" name="fullname"
                            value="<?php echo $fullname ?>">
                            
                        </div>
                        <div class="form-group">
                            <label for="phone">No Handphone</label>
                            <input type="text" class="form-control" name="phone"
                            value="<?php echo $phone ?>">
                            
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email"
                            value="<?php echo $email ?>">
                            
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password">
                            
                        </div>
                        <div class="form-group">
                            <button name="updateuser" type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>