<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



 if(!isset($_GET['uid'])){
     redirect('index.php');
 }

 if(isset($_POST['recoverPassword'])){
     $email = escape($_POST['email']);
     $length = 50;
     $token = bin2hex(openssl_random_pseudo_bytes($length));

     if(email_exists($email)){
         query("UPDATE users SET token='$token' WHERE email='$email' ");
         

         try{
             $mail = new PHPMailer(true);

             $mail->isSMTP();
             $mail->SMTPAuth = true;
             $mail->Host = SMTP_HOST;
             $mail->Username = SMTP_USERNAME;
             $mail->Password = SMTP_PASSWORD;
             $mail->Port = SMTP_PORT;
             $mail->CharSet = 'UTF-8';
             $mail->isHTML(true);

             $mail->setFrom('no-reply@gmail.com','noreply');

            $mail->addAddress($email);

            $mail->Subject = 'This is a test forgot password' ;

            $mail->Body = '
            <h1>Please click to reset your password</h1>
            <a href="http://localhost/lecture/webdonasi/?reset&email='.$email.'&token='.$token.' ">
            http://localhost/lecture/webdonasi/?reset&email='.$email.'&token='.$token.'
            </a>';
            $send = $mail->send();
            if($send){
                $emailSent = true;
            }else{
                $emailSent = "Email anda belum terdaftar";
            }
         }catch(Exception $e){
             echo 'Email tidak terkirim';
         }
     }
     
 }


?>
<div class="container">
    <div class="row mt-5 ">
        <div class="col-md-3">
            <a href="index.php" class="btn btn-secondary btn-block">Kembali</a>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <h1 class="text-center">Form Lupa Password</h1>
            
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <?php if(!isset($emailSent)) : ?>
                    <?php 
                    if(isset($_POST['recoverPassword'])){
                        if(!email_exists($email)){
                            echo 'email tidak terdaftar';
                        }    
                        
                    }
                    ?>
                    <form method="post" autocomplete="off">
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Input Email">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-outline-primary btn-block" name="recoverPassword" value="Reset Password">
                        </div>
                        <input type="hidden" class="hide" name="token" value="">

                    </form>
                    <?php else: ?>
                        <h1>please check email</h1>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>



