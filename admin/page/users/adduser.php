<?php 
    if(isset($_POST['register'])){
        $fullname = trim($_POST['fullname']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        $error = [
            'fullname' => '',
            'phone' => '',
            'email' => '',
            'password' => ''
        ];
        if($fullname == ''){
            $error['fullname'] = "Nama Lengkap tidak boleh kosong";
        }
        if($phone == ''){
            $error['phone'] = "No handphone tidak boleh kosong";
        }
        if(email_exists($email)){
            $error['email'] = "Email anda sudah terdaftar";
        }
        if($password == ''){
            $error['password'] = "Password tidak boleh kosong";
        }

        foreach($error as $key => $val){
            if(empty($val)){
                unset($error[$key]);
            }
        }

        if(empty($error)){
            registerUser($fullname,$phone,$email,$password);
            redirect('?page=listusers');
        }
    }

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">Form Tambah User</h1>
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
                            value="<?php echo isset($fullname) ? $fullname : '' ?>">
                            <p><?php echo isset($error['fullname']) ? $error['fullname'] : ''; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="phone">No Handphone</label>
                            <input type="text" class="form-control" name="phone"
                            value="<?php echo isset($phone) ? $phone : '' ?>">
                            <p><?php echo isset($error['phone']) ? $error['phone'] : ''; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email"
                            value="<?php echo isset($email) ? $email : '' ?>">
                            <p><?php echo isset($error['email']) ? $error['email'] : ''; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password">
                            <p><?php echo isset($error['password']) ? $error['password'] : ''; ?></p>
                        </div>
                        
                        <div class="form-group">
                            <button name="register" type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>