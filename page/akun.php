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
        if(email_exists($email)){
            echo '<div class="alert alert-danger" role="alert">
                            Email anda sudah terdaftar
                        </div>';
        }

        elseif(empty($error)){
            send_email($email);
                registerUser($fullname,$phone,$email,$password);
//                 redirect(BASE_URL);
                echo '<div class="alert alert-success" role="alert">
                            Pendaftaran berhasil silahkan cek email anda.
                        </div>';
            
        }else{
            echo '<div class="alert alert-danger" role="alert">
                            Gagal Daftar!!
                        </div>';
        }
        
   }

   if(isset($_POST['login'])){
        if(isset($_POST['email']) && isset($_POST['password'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $query = query("SELECT * FROM users WHERE email='$email' ");
            $result = mysqli_fetch_array($query);
            $email = $result['email'];
            $user_status = $result['user_status'];
            
            if($email){
                loginUser($_POST['email'],$_POST['password']);
            }
            if($user_status == 1){
                echo '<div class="alert alert-danger" role="alert">
                            Akun anda belum di aktivasi, Silahkan cek email anda dan klik link aktivasi.
                        </div>';
            }elseif (!$email) {
                echo '<div class="alert alert-danger" role="alert">
                            Email anda belum terdaftar
                        </div>';
            }
            
            else{
                echo '<div class="alert alert-danger" role="alert">
                        Gagal Login
                    </div>';
            }

            
        }
   }

?>


<div class="container">
    <div class="row push-from-top">
        <div class="col-md-12">
            <h1 class="text-center">Akun</h1>
        </div>
    </div>
    <div class="row push-from-top">
        <div class="col-md-6 mb-3">
            <div class="card border-0 shadow-lg">
                <div class="card-title"><h1 class="text-center">Daftar</h1></div>
                <div class="card-body">
                    
                    <form method="post" autocomplete="off">
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control" name="fullname"
                            value="<?php echo isset($fullname) ? $fullname : '' ?>">
                            <p><?php echo isset($error['fullname']) ? $error['fullname'] : ''; ?></p>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email"
                            value="<?php echo isset($email) ? $email : '' ?>">
                            <p><?php echo isset($error['email']) ? $error['email'] : ''; ?></p>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">No Handphone</label>
                            <input type="text" class="form-control" name="phone"
                            value="<?php echo isset($phone) ? $phone : '' ?>">
                            <p><?php echo isset($error['phone']) ? $error['phone'] : ''; ?></p>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password">
                            <p><?php echo isset($error['password']) ? $error['password'] : ''; ?></p>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="register" class="btn btn-block bg-custom-primary text-white">Buat Akun</button>
                        </div>
                </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-lg">
                <div class="card-title"><h1 class="text-center">Login</h1></div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="login" class="btn btn-block bg-custom-primary text-white">Login</button>
                        </div>
                	</form>
                	<div class="text-center">
	                	<a href="<?php echo BASE_URL ?>?page=forgot&uid=<?php echo uniqid(true)?>">
                			Lupa Password
                		</a>
                	</div>

                	
                </div>
            </div>
        </div>
    </div>
</div>