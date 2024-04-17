

<?php 
    if(!isset($_GET['email']) && !isset($_GET['token'])){
        redirect('index.php');
    }

    if(isset($_POST['update_password'])){
        $user_email = $_GET['email'];
        // $token = $_GET['token'];
        // $query = query("SELECT email,token FROM users WHERE token='$token'");

        if(isset($_POST['password']) && isset($_POST['confirmPassword']) ){
            if(isset($_POST['password']) === isset($_POST['confirmPassword'])){
                $password = escape($_POST['password']);
                $hashPassword = password_hash($password,PASSWORD_BCRYPT,array('cost'=>'10'));
                $query = query("UPDATE users SET token='',password='$hashPassword' WHERE email='$user_email' ");
                if($query){
                    redirect('index.php');
                }
            }
        }



    }

?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5 mb-5">
            <h1 class="text-center">Form Reset Password</h1>
            <form method="post">
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="input password">
                </div>
                <div class="form-group">
                    <input type="submit" name="update_password" class="btn btn-primary btn-block" value="Update Password">
                </div>

            </form>
        </div>
    </div>
</div>

